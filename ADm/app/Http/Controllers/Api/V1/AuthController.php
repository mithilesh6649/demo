<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendVerificationMailJob;
use App\Jobs\ForgotPasswordEmailJob;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\LoginRequest;
use App\Services\SendMobileOTP;
use Illuminate\Http\Request;
use App\Models\Verification;
use App\Models\Reverification;
use App\Models\User;
use DB;

class AuthController extends Controller
{
    protected $successResponse = [
        'success' => true,
        'status' => 200,
        'data' => 'Successful',
        'error' => false
    ];

    protected $errorResponse = [
        'success' => false,
        'status' => 400,
        'data' => "Something going wrong",
        'error' => true,
    ];

    protected $status = 400;

    protected $data = [];

    protected $error = true;

    protected $success = false;

    protected $message = '';

    /**
     * Fnc _register register the user record
     *
     * RegisterRequest class validat the incoming request
     * Dispatching the work in the queue for sending verification mail
     *
     * @return ApiResponse
     *
     */
    public function _register(RegisterRequest $request)
    {
        $this->data = new \stdClass();

        if (User::withTrashed()->where(['email' => $request->email, 'email_verified' => 1])->exists()) {

            $this->message = "Email already exists";

        } else {

            if ($user = User::updateOrCreate(
                [
                    'email' => $request->email,
                ],[
                    'terms_and_conditions' => $request->terms_and_conditions,
                    'device_token' => $request->deviceToken,
                    'device_type' => $request->deviceType,
                    'password' => $request->password,
                    'gender' => $request->gender,
                    'name' => $request->name,
            ])) {

                $this->data = [
                    'email' => $user->email,
                    'name' => $user->name,
                    'userId' => $user->id,
                ];

                $this->error = false;
                $this->status = 200;
                $this->success = true;

                dispatch(new SendVerificationMailJob($this->data));
            }
        }

        return response()->json([
            'success' => $this->success,
            'status' => $this->status,
            'data' => $this->data,
            'message' => $this->message,
            'error' => $this->error,
        ], $this->status);
    }

    /**
     * Fnc _login authorize the user for login
     *
     *
     */
    public function _login(LoginRequest $request)
    {
        \Log::info(['Hello ']);
        $this->data = new \stdClass();

        if ($request->login_type == "email") {

            if($user = User::whereEmail($request->email)->first()) {

                if (!$user->email_verified) {

                    $this->message = "User not found";

                } else {

                    if(auth()->attempt(['email' => $request->email, 'password' => $request->password])) {

                        $user = auth()->user();

                        if ( $request->deviceToken != null ) {

                            auth()->user()->update(['device_token' => $request->deviceToken, 'device_type' => $request->deviceType]);
                        }

                        $this->error = false;
                        $this->status = 200;
                        $this->success = true;
                        $this->data = [
                            'user' => $user,
                            'token' => $user->createToken('API Token')->accessToken,
                        ];

                    } else {

                        $this->message = "Password not matched";
                    }
                }
            } else {

                $this->message = "User not found";
            }

        } else {

            $user = User::where('phone_number', $request->phone_number)->first();

            if ($user) {

                $user->device_token = request()->deviceToken;
                $user->device_type = request()->deviceType;

                if ($user->phone_verified){

                    $user = User::where('phone_number', $request->phone_number)->first();
                    $user->login_otp = $this->generateOTP();

                    $user->save();

                    $otpData['otp'] = $user->login_otp;
                    $otpData['otp_message_slug'] = config('common.phone_otp_message_slug.user_login');

                } else {

                    $user->save();

                    $verfication = Verification::updateOrCreate([
                        'username' => $request->phone_number,
                    ],[
                        'expiry_at' => now()->addDays(config('common.email_verification_expiry_time_in_days')),
                        'random_string' => $this->generateRandomString(),
                        'otp' => $this->generateOTP()
                    ]);

                    $otpData['otp'] = $verfication->otp;
                    $otpData['otp_message_slug'] = config('common.phone_otp_message_slug.new_user_registration');

                }
            } else {

                $otpData['otp'] = $this->registerUser($request);
                $otpData['otp_message_slug'] = config('common.phone_otp_message_slug.new_user_registration');
            }

            $otpData['phone_number'] = $request->country_code.$request->phone_number;

            SendMobileOTP::sendOTPToPhoneNumber($otpData);

            $this->error = false;
            $this->status = 200;
            $this->success = true;
            $this->data = [
                'user' => $request->all(),
            ];
        }

        return response()->json([
            'success' => $this->success,
            'status' => $this->status,
            'data' => $this->data,
            'message' => $this->message,
            'error' => $this->error,
        ], $this->status);
    }

    public function _verifyOTP(Request $request)
    {
        $this->data = new \stdClass();

        if ($request->verify_type == "email") {

            if ($user = User::whereEmail($request->email)->first()) {

                $userEmailVerification = Verification::whereUsername($request->email)->first();

                if ($userEmailVerification) {

                    if ($userEmailVerification->otp == $request->otp || config('app.env') === "local") {

                        $user->email_verified = 1;
                        $user->email_verified_at = now();

                        if ($request->deviceToken != null) {

                            $user->device_token = $request->deviceToken;
                            $user->device_type = $request->deviceType;
                        }

                        if ($user->save()) {

                            $userEmailVerification->delete();

                            $this->error = false;
                            $this->status = 200;
                            $this->success = true;
                            $this->data = [
                                'user' => $user,
                                'token' => $user->createToken('API Token')->accessToken,
                            ];
                        }
                    } else {

                        $this->message = "OTP Not Matched";
                    }
                }
            } else {

                $this->status = 404;
                $this->message = "User Not Found";
            }
        } else if ($request->verify_type == "phone") {

            if ($user = User::where('phone_number', $request->phone_number)->first()) {

                if ($user->phone_verified) {

                    if ($user->login_otp == $request->otp) {

                        $this->error = false;
                        $this->status = 200;
                        $this->success = true;
                        $this->data = [
                            'user' => $user,
                            'token' => $user->createToken('API Token')->accessToken
                        ];

                        $user->login_otp = null;
                        $user->save();
                    } else {

                        $this->message = "OTP not matched";
                    }
                } else {

                    if ($verificationInfo = Verification::where('username', $request->phone_number)->first()) {

                        if ($verificationInfo->otp == $request->otp) {

                            $user = User::where('phone_number', $request->phone_number)->first();
                            $user->phone_verified = 1;
                            $user->phone_verified_at = now();

                            $user->save();

                            $verificationInfo->delete();

                            $this->error = false;
                            $this->status = 200;
                            $this->success = true;
                            $this->data = [
                                'user' => $user,
                                'token' => $user->createToken('API Token')->accessToken
                            ];
                        } else {

                            $this->message = "OTP not matched";
                        }
                    }
                }
            }
        }

        return response()->json([
            'success' => $this->success,
            'status' => $this->status,
            'data' => $this->data,
            'error' => $this->error,
            'message' => $this->message,
        ], $this->status);
    }

    private function registerUser($request)
    {
        User::create([
            'country_code' => $request->country_code,
            'device_token' => $request->device_token,
            'phone_number' => $request->phone_number,
            'device_type' => $request->deviceType,
            'device_token' => $request->deviceToken
        ]);

        $verfication = Verification::updateOrCreate([
            'username' => $request->phone_number,
        ],[
            'expiry_at' => now()->addDays(config('common.email_verification_expiry_time_in_days')),
            'random_string' => $this->generateRandomString(),
            'otp' => $this->generateOTP()
        ]);

        return $verfication->otp;
    }

    /**
     * Fnc _resendOTP trigger to resend the OTP in email
     * Create SendVerificationMailJob Job
     *
     * @return APIResponse
     */
    public function _resendOTP(Request $request)
    {
        $this->data = new \stdClass();

        if ($request->resend_type == "email") {

            if($user = User::whereEmail($request->email)->first()) {

                $this->data = [
                    'email' => $user->email,
                    'name' => $user->name,
                    'userId' => $user->id,
                ];

                dispatch(new SendVerificationMailJob($this->data));

                $this->error = false;
                $this->status = 200;
                $this->success = true;

            } else {

                $this->status = 401;
                $this->message = 'Email not found';
            }
        } else if ($request->resend_type == "phone") {

            $user = User::where('phone_number', $request->phone_number)->first();

            if ($user->phone_verified) {

                $user = User::where('phone_number', $request->phone_number)->first();
                $user->login_otp = $this->generateOTP();

                $user->save();

                $otpData['otp'] = $user->login_otp;
                $otpData['otp_message_slug'] = config('common.phone_otp_message_slug.user_login');

            } else {

                $verfication = Verification::updateOrCreate([
                    'username' => $request->phone_number,
                ],[
                    'expiry_at' => now()->addDays(config('common.email_verification_expiry_time_in_days')),
                    'random_string' => $this->generateRandomString(),
                    'otp' => $this->generateOTP()
                ]);

                $otpData['otp'] = $verfication->otp;
                $otpData['otp_message_slug'] = config('common.phone_otp_message_slug.new_user_registration');
            }

            $otpData['phone_number'] = $request->country_code.$request->phone_number;

            SendMobileOTP::sendOTPToPhoneNumber($otpData);

            $this->error = false;
            $this->status = 200;
            $this->success = true;
            $this->data = [
                'user' => $request->all(),
            ];
        }

        return response()->json([
            'status' => $this->status,
            'success' => $this->success,
            'data' => $this->data,
            'message' => $this->message,
            'error' => $this->error
        ], $this->status);
    }

    public function _forgotPassowrd(Request $request)
    {
        $this->data = new \stdClass();

        if ($request->isMethod('POST')) {

            if ($request->has('email')) {

                if ($user = User::where('email', $request->email)->first()) {

                    $data['url'] = URL::signedRoute('forgot.password', ['ue' => encrypt($request->email)]);
                    $data['email'] = $request->email;
                    $data['name'] = ($user->name) ? $user->name : "";

                    dispatch(new ForgotPasswordEmailJob($data));

                    $this->status = 200;
                    $this->success = true;
                    $this->message = 'Email successfully sent';
                    $this->error = false;

                } else {

                    $this->message = "Email not found";
                    $this->status = 401;
                }
            } else {

                $this->message = "Please provide email";

            }
        }

        return response()->json([
            'status' => $this->status,
            'success' => $this->success,
            'data' => $this->data,
            'message' => $this->message,
            'error' => $this->error
        ], $this->status);
    }

    /**
     * Fnc _viewforgotPassowrd verify the request of Signed URL and
     * redirects to reset password view
     *
     * abort 401|404 for unauthorised URL
     */
    public function _viewforgotPassowrd(Request $request)
    {
        if ($request->isMethod('GET')) {

            if (! $request->hasValidSignature()) {
                abort(401);
            }

            $email = decrypt($request->ue);

            if (User::where('email', $email)->exists()) {

                $token = encrypt($this->generateRandomString(90));

                DB::table('forgot_passwords')->updateOrInsert([
                        'email' => $email
                    ],[
                        'token' =>$token
                    ]);

                return view('auth.passwords.reset-password')->with(['token' => $token]);
            }

            abort(404);
        }
    }

    /**
     * Function: _setNewPassword
     * Functionality: Set new Password for user
     * Detailed: It will set new password for user
     */
    public function _setNewPassword(Request $request)
    {
        if($forgotPassInfo = DB::table('forgot_passwords')->where('token', $request->reset_token)->first()) {

            if($user = User::where('email', $forgotPassInfo->email)->first()) {

                $user->password = $request->new_password;

                if ($user->save()) {

                    DB::table('forgot_passwords')->where('token', $request->reset_token)->delete();

                return redirect()->back()->with('success', 'Password successfully reset. You can Login in app with your new password');
                }
            }

            return redirect()->back()->with('error', 'User not found');
        }

        return redirect()->back()->with('error', 'Token mismatched or Link Expired');
    }

    /**
     * Fnc logout will logout the user from the current app
     * Revoke its token
     *
     */
    public function logout()
    {
        $user = auth()->user()->token();
        $user->revoke();

        return response()->json([ 'status' => 200, 'success' => true, 'message' => 'Successfully logged out', 'error' => false], 200);
    }

    public function _reVerifyEmailOrPhone(Request $request)
    {
        $message = "Please provide otp";

        if ($request->has('otp')) {

            if ($reVerificationInfo = auth()->user()->reVerification) {

                if ($reVerificationInfo->otp == $request->otp && $request->token == $reVerificationInfo->token && $reVerificationInfo->user_id == auth()->id() || config('app.env') === "local") {

                    $columnKey = (is_numeric($reVerificationInfo->new_username)) ? 'phone_number' : 'email';
                    $verifiedTimestampKey = ($columnKey == "phone_number") ? 'phone_verified_at' : 'email_verified_at';
                    $columnVerified = ($columnKey == "phone_number") ? 'phone_verified' : 'email_verified';
                    $user = auth()->user();

                    $user->country_code = $reVerificationInfo->country_code;
                    $user->{$columnKey} = $reVerificationInfo->new_username;
                    $user->{$columnVerified} = 1;
                    $user->{$verifiedTimestampKey} = now();

                    if ($user->save()) {

                        $reVerificationInfo->delete();

                        return response()->json([
                            'status' => 200,
                            'success' => true,
                            'message' => 'Profile updated successfully',
                            'data' => auth()->user()->userProfile(),
                            'error' => false
                        ], 200);
                    }
                } else {

                    $message = "OTP not matched";
                }
            } else {

                $message = "Not found";
            }
        }

        return response()->json([ 'status' => 400, 'success' => false, 'message' => $message, 'error' => true], 400);
    }

    /**
     * Function: _deleteUserAccount
     * Funcionality: It will SOFT delete the User and its data.
     * Method: Delete
     */
    public function _deleteUserAccount()
    {
        $userAction = \App\Models\UserAction::firstOrCreate(['user_id' => auth()->id(), 'user_guard' => 'users', 'status_id' => \DB::table('statuses')->where('slug', 'account_deleted')->value('id')], ['action_by' => auth()->id(), 'action_time' => now()]);

        $user = auth()->delete();

        if ($user->delete()) {

            $user = $user->token();
            $user->revoke();

            return response()->json([ 'status' => 200, 'success' => true, 'message' => "Account successfully deleted", 'error' => false], 200);
        }

        return response()->json([ 'status' => 400, 'success' => false, 'message' => "Something went wrong", 'error' => true], 400);
    }
}
