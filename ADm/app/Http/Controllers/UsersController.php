<?php

namespace App\Http\Controllers\Api\V1;

use App\CustomFacades\GoPayFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\PasswordReset;
use App\Models\Feedback;
use App\Models\ContactUs;
use App\Models\PaymentTransaction;
use App\Models\Favourite;
use App\Models\ChatHead;
use App\Models\Message;
use App\Models\Notification;
use App\Models\UserRating;
use App\Models\BlockedUser;
use App\Models\TransactionLimit;
use Validator,Response,Auth,Session,Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use App\Mail\SendEmailVerificationLink;
use App\Mail\SendResetPasswordLink;
use Silamoney\Client\Api\SilaApi;
use Silamoney\Client\Domain\AchType;
use Illuminate\Support\Facades\Http;
use Silamoney\Client\Domain\SearchFilters;
use App\Events\MessageSentEvent;
use App\Models\MoneyTransfer;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
use QrCode;

class UsersController extends Controller
{
    public function __construct()
    {

    }

    function login(Request $request)
    {
        
        try {
            $validator = Validator::make($request->all(), [
                'email_or_phone' => 'required',
                'password'    => 'required',
                'deviceType'  => 'required', //ios, android
                // 'deviceToken' => 'required'
            ]);
            if ($validator->fails()) {
                $error = [
                    'status' => 400,
                    'message' => $validator->errors()->first(),
                ];
                return response()->json($error, 400);
            }
            if(is_numeric($request->get('email_or_phone'))){
                $user = User::where('status', '1')->Where('phone_number', $request->email_or_phone)->first();

                // added later
                if( \Auth::attempt(['phone_number'=>$request->email_or_phone, 'password'=>$request->password]) ) {
                    $user = \Auth::user();

                    $token = $user->createToken($user->phone_number.'-'.now());

                    if($request->has('voip_token') && $request->voip_token!=""){
                        $user->voip_token = $request->voip_token;
                    }
                    if($request->has('deviceToken') && $request->deviceToken!=""){
                        $user->device_token = $request->deviceToken;
                    }
                    $user->device_type = $request->deviceType;
                    $user->save();

                    $response = [
                        'success' => true,
                        'status' => 200,
                        'message' => 'Logged in successfully!',
                        'data' => [
                            'user' => $user,
                            'access_token' => $token->accessToken,
                        ]
                    ];
                    return response()->json($response,200);
                }else{
                    $response = [
                        'status' => 400,
                        'message' => 'Invalid email/Phone or password!'
                    ];
                    return response()->json($response,400);
                }
                // added later
            }
            elseif (filter_var($request->get('email_or_phone'), FILTER_VALIDATE_EMAIL)) {
                $user = User::where('status', '1')->Where('email', $request->email_or_phone)->first();
                // added later
                if( \Auth::attempt(['email'=>$request->email_or_phone, 'password'=>$request->password]) ) {
                    $user = \Auth::user();

                    $token = $user->createToken($user->email.'-'.now());

                    if($request->has('voip_token') && $request->voip_token!=""){
                        $user->voip_token = $request->voip_token;
                    }
                    if($request->has('deviceToken') && $request->deviceToken!=""){
                        $user->device_token = $request->deviceToken;
                    }
                    $user->device_type = $request->deviceType;
                    $user->save();

                    $response = [
                        'success' => true,
                        'status' => 200,
                        'message' => 'Logged in successfully!',
                        'data' => [
                            'user' => $user,
                            'access_token' => $token->accessToken,
                        ]
                    ];
                    return response()->json($response,200);
                }else{
                    $response = [
                        'status' => 400,
                        'message' => 'Invalid email/Phone or password!'
                    ];
                    return response()->json($response,400);
                }
                // added later
            } else{
                $response = [
                    'status' => 400,
                    'message' => 'Invalid email/Phone or password!'
                ];
                return response()->json($response,400);
            }
            return response()->json($response, 400);
        } catch (\Exception $e) {
            $error = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($error, 400);
        }
    }

    function logOut(Request $request){
        try {
            $request->user()->token()->revoke();

            $user = Auth::user();
            $user->update(['is_online'=>0,'device_token'=>null]);

            return response()->json([
                'status' => 200,
                'message' => 'Successfully logged out'
            ],200);

        } catch (\Exception $e) {
            $error = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($error, 400);
        }
    }

    function registration(Request $request){
        try{
            $validator   = Validator::make($request->all(), [
                'firstName'   => 'required',
                'lastName'    => 'required',
                'phoneNumber' => 'required|unique:users,phone_number,'.$request->phoneNumber,
                'email'       => 'required|unique:users,email,'.$request->email,
                'password'    => 'required|confirmed',
                'deviceType'  => 'required', //ios, android
            ]);
            if ($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $profilePicture = '';
            if(!empty($request->profilePicture)){
                $array = explode('data:image', $request->profilePicture);
                $folderPath = public_path()."/userProfilePicture/";
                foreach ($array as $arr) {
                    if($arr!='' && $arr!=null){
                        $explodes = explode('base64,', $arr);
                        $base_64 = $explodes[1];
                        $extension = explode('/', $explodes[0])[1];
                        $image_type = explode(';', $extension)[0];
                        $image_base64 = base64_decode($base_64);
                        $file = $folderPath . uniqid() . '.'.$image_type;
                        file_put_contents($file, $image_base64);
                        $profilePicture = explode($folderPath, $file)[1];
                    }
                }
            }
            $User = new User;
            $User->first_name      = $request->firstName;
            $User->last_name       = $request->lastName;
            $User->phone_number    = $request->phoneNumber;
            if($request->has('countryCode')){
                $User->country_code    = $request->countryCode;
                $User->phone_number_with_country_code = $request->countryCode.$request->phoneNumber;
            }
            $User->email           = $request->email;
            $User->password        = Hash::make($request->password);
            $User->profile_picture = $profilePicture;
            $User->otp             = 123456; //rand(100000, 999999);
            $User->device_type     = $request->deviceType;

            if($request->has('deviceToken') && $request->deviceToken!=""){
                $User->device_token    = $request->deviceToken;
            }

            if($request->has('voip_token') && $request->voip_token!=""){
                $User->voip_token    = $request->voip_token;
            }

            $User->save();
            $token = $User->createToken($User->email.'-'.now());
            if(!empty($User->id)){
                $success = [
                    'success'  => true,
                    'status' => 200,
                    'message' => 'user registration successful',
                    'data' => [
                        'user' => User::find($User->id),
                        'access_token' => $token->accessToken,
                    ],
                ];
                return response()->json($success, 200);
            }
        } catch (\Exception $e) {
            $error = [
                'message' => $e->getMessage().' on line no. '.$e->getLine().' in file '.$e->getFile(),
                'status' => 400,
            ];
            return response()->json($error, 400);
        }
    }

    function verifyOtp(Request $request){
        try{
            $validator   = Validator::make($request->all(), [
                'phoneNumber' => 'required',
                'countryCode' => 'required',
                'otp'         => 'required'
            ]);
            if ($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = User::Where('phone_number', $request->phoneNumber)->first();
            if (empty($user)) {
                $error = [
                    'message' => 'Phone number not exist.',
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }else{
                if($user->otp==$request->otp){
                    $token = $user->createToken($user->phone_number.'-'.now());
                    $response = [
                        'success' => true,
                        'message' => 'Otp verified successfully',
                        'data' => [
                            'user' => $user,
                            'access_token' => $token->accessToken,
                        ]
                    ];
                    $user->update(['otp'=>null]);
                    return response()->json($response);
                }else{
                    $error = [
                        'message' => 'Otp does not match.',
                        'status' => 400,
                    ];
                    return response()->json($error, 400);
                }
            }
        } catch (\Exception $e) {
            $error = [
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
                'status' => 400,
            ];
            return response()->json($error, 400);
        }
    }


    public function updateProfile(Request $request){


        try{
            $validator   = Validator::make($request->all(), [
                'firstName'    => 'required',
                'lastName'    => 'required',
               // 'phoneNumber' => 'required|unique:users,phone_number,'.Auth::user()->id,
                // 'countryCode' => 'required',
                'email'       => 'required|unique:users,email,'.Auth::user()->id,
            ]);
            if ($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = Auth::user();
            $user->first_name = $request->firstName;
            $user->last_name = $request->lastName;
            //$user->phone_number    = $request->phoneNumber;
            // if($request->has('countryCode')){
            //     $user->country_code    = $request->countryCode;
            //     $user->phone_number_with_country_code = $request->countryCode.$request->phoneNumber;
            // }
            $user->email = $request->email;
            if(!empty($request->profilePicture)){
                // unlink earlier image
                $image_name = $user->profile_picture;
                if($image_name){
                    if(file_exists( public_path("/userProfilePicture/".$image_name))){
                        unlink(public_path("/userProfilePicture/".$image_name));
                    }
                }
                // unlink earlier image
                $array = explode('data:image', $request->profilePicture);
                $folderPath = public_path()."/userProfilePicture/";
                foreach ($array as $arr) {
                    if($arr!='' && $arr!=null){
                        $explodes = explode('base64,', $arr);
                        $base_64 = $explodes[1];
                        $extension = explode('/', $explodes[0])[1];
                        $image_type = explode(';', $extension)[0];
                        $image_base64 = base64_decode($base_64);
                        $file = $folderPath . uniqid() . '.'.$image_type;
                        file_put_contents($file, $image_base64);

                        $profilePicture = explode($folderPath, $file)[1];

                        $user->profile_picture = $profilePicture;
                    }
                }
            }
            $updatePersonResponse = null ;
            if (GoPayFacade::isKycDone()) {
                $newPostRequest = [
                    "firstName" => $user->first_name ,
                    "lastName" => $user->last_name,
                    "email" => $user->email
                ];

                $updatePersonResponse = Http::withHeaders([
                    'sd-api-key' => env('SOLID_API_KEY'),
                    'sd-person-id' => Auth::user()->person->person_id,
                    ])
                    ->withBody(json_encode( $newPostRequest ), 'application/json')
                    ->patch(env('SOLID_API_URL').'v1/person/'.Auth::user()->person->person_id);

                    $updatePersonResponse = json_decode($updatePersonResponse);
                    if( isset($updatePersonResponse->code) && ( $updatePersonResponse->code == "EC_PERSON_UPDATE_ERROR" ) ) {

                        $error = [
                                'status' => 'Error Occured !',
                                'message' => "Your Kyc has been approved,you can no longer update first name , last name ",
                                'success' => false,
                                'e_code' => 'USR113'
                            ];
                            return response()->json($error, 400);
                       }

                     }


                $finalResponse =  DB::transaction(function () use ($user , $updatePersonResponse) {

                    $user->save();
                    if ($updatePersonResponse !=null) {
                        Person::where('person_id' , $updatePersonResponse->id)->update([
                            'firstName' => $updatePersonResponse->firstName,
                            'lastName' => $updatePersonResponse->lastName,
                            'email' => $updatePersonResponse->email
                        ]);
                    }

                    return response()->json(['status' => 'transfer' ,'message' => 'Profile Updated','success' => true ], 200);

                });

        }

        catch (\Exception $e) {
            $error = [
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
                'status' => 400,
            ];
            return response()->json($error, 400);
        }
        return $finalResponse;
    }


    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => ['required'],
            'new_password' => ['required','min:6'],
            'confirm_password' => ['required','same:new_password'],

        ]);
        if($validator->fails()) {
            $error = [
                'message' => $validator->errors()->first(),
                'status' => 400,
            ];
            return response()->json($error, 400);
        }
        try{
            $userid = Auth::user()->id;
            if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                $arr = array("status" => 400, "message" => "Check your old password.");
                return response()->json($arr,400);
            } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                $arr = array("status" => 400, "message" => "Please enter a password which is not similar to the current password.");
                return response()->json($arr,400);
            } else {
                User::where('id', $userid)->update(['password' => Hash::make($request->new_password)]);
                $arr = array("status" => 200, "message" => "Password updated successfully.");
                return response()->json($arr,200);
            }
        }catch(\Exception $e){
            $response = [
                'status' => 400,
                'message' => $e->getMessage().' in line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($response,400);
        }
    }

    public function getUserData(){
        try{
            $user = Auth::user();
            $res = [
                'status' => 200,
                'data' => [
                    'user' => $user
                ],
            ];
            return response()->json($res,200);
        }catch(\Exception $e){
            $response = [
                'status' => 400,
                'message' => $e->getMessage().' in line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($response,400);
        }
    }

    public function forgotPassword(Request $request){
       try{
            $email = $request->email;
            $user = User::where('email',$email)->first();
            if(!$user){
                $res = [
                    'status' => 400,
                    'message' => 'User does not exist',
                ];
                return response()->json($res,400);
            }




            $token = $this->generateRandomString();
            $password_reset = new \App\Models\PasswordReset;
            $password_reset->email = $email;
            $password_reset->token = $token;
            $password_reset->save();
            $url = route('reset-password',$token);
            $mail_data = [
                'subject' => 'Reset Password Link',
                'name' => $user->first_name.' '.$user->last_name,
                'url' => $url,
            ];
            Mail::to($email)->send(new SendResetPasswordLink($mail_data));
            $res = [
                'status' => 200,
                'message' => 'Reset Password link sent!',
            ];
            return response()->json($res,200);

       }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no. '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
       }
    }

    public function resetPassword($token){
        return view('reset-password')->with('token',$token);
    }

    public function setNewPassword(Request $request){
        $token = $request->reset_token;
        $password = Hash::make($request->new_password);
        $password_reset = PasswordReset::where('token',$token)->first();
        if($password_reset){
            $user = User::where('email',$password_reset->email)->first();
            if($user){
                $user->password = $password;
                if($user->save()){

                    return redirect()->back()->with('success','Password Changed Successfully!');
                }
            }else{
                return redirect()->back()->with('error','User not found!');
            }
        }else{
            return redirect()->back()->with('error','Something went wrong!');
        }
    }


    public function submitFeedback(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'rating' => ['required'],
                'message' => ['required'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $feedback = new Feedback;
            $feedback->user_id = Auth::user()->id;
            $feedback->rating = $request->rating;
            $feedback->message = $request->message;
            if($feedback->save()){
                $res = [
                    'status' => 200,
                    'message' => 'Feedback submitted successfully!',
                ];
                return response()->json($res,200);
            }else{
                $res = [
                    'status' => 400,
                    'message' => 'Something went wrong!',
                ];
                return response()->json($res,400);
            }
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function contactUs(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'first_name' => ['required'],
                'email' => ['required','email'],
                'message' => ['required'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $contact_us = new ContactUs;
            $contact_us->user_id = Auth::user()->id;
            $contact_us->first_name = $request->first_name;
            $contact_us->email = $request->email;
            $contact_us->message = $request->message;
            if($contact_us->save()){
                $res = [
                    'status' => 200,
                    'message' => 'Query submitted successfully!',
                ];
                return response()->json($res,200);
            }else{
                $res = [
                    'status' => 400,
                    'message' => 'Something went wrong!',
                ];
                return response()->json($res,400);
            }
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }


    public function requestKyc(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'userName' => array(
                    'required',
                    'regex:/(^[-a-zA-Z0-9_\.]+$)/u'
                ),
                'firstName' => ['required'],
                'lastName' => ['required'],
                'streetAddress1' => ['required'],
                'streetAddress2' => ['required'],
                'city' => ['required'],
                'state' => ['required','max:2'],
                'postalCode' => ['required','max:9','min:5'],
                'phone' => ['required'],
                'email' => ['required'],
                'socialSecurityNumber' => array(
                    'required',
                    'regex:/(^(?!666|000|9\\d{2})\\d{3}-(?!00)\\d{2}-(?!0{4})\\d{4}$)/u'
                ),
                'birthDate' => ['required'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = Auth::user();
            // check handle
            if($user->is_registered_with_sila==0){
                $checkHandle = app('App\Http\Controllers\Silamoney\UserRegistration')->checkHandle($request->userName);
                if($checkHandle['status']=='FAILURE'){
                    $res = [
                        'status' => 400,
                        'message' => "User name already taken!",
                    ];
                    return response()->json($res,400);
                }
            }
            // check handle
            // register user
            if($user->is_registered_with_sila==0){
                $response = app('App\Http\Controllers\Silamoney\UserRegistration')->silaRegister(urldecode($request->userName),urldecode($request->firstName),urldecode($request->lastName),urldecode($request->streetAddress1),urldecode($request->streetAddress2),urldecode($request->city),urldecode($request->state),urldecode($request->postalCode),urldecode($request->phone),urldecode($request->email),urldecode($request->socialSecurityNumber),urldecode($request->birthDate));

                return $response;
            }else{
                // if($user->is_kyc_done==0){
                //     $userHandle = Crypt::decryptString($user->userHandle);
                //     $userPrivateKey = Crypt::decryptString($user->userPrivateKey);
                //     $response = app('App\Http\Controllers\Silamoney\UserRegistration')->sendKycRequest($userHandle,$userPrivateKey);
                //     return $response;
                // }else{
                    $res = [
                        'status' => 200,
                        'message' => 'You have already requested for KYC!',
                    ];
                    return response()->json($res,200);
                // }

            }
            // register user
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function checkKycStatus(){
        $response = app('App\Http\Controllers\Silamoney\UserRegistration')->checkKyc();
        return $response;
    }


    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function plaidLinkToken(){
        try{
            $user = Auth::user();
            $response = Http::post('https://sandbox.plaid.com/link/token/create', [
                "client_id" => "61c15e1cf7e762001b324301",
                "secret" => "29a3cc11f0e25607131f0097e41d5c",
                "user" => array(
                    "client_user_id" => Crypt::decryptString($user->userHandle)
                ),
                "client_name" => "Plaid App",
                "country_codes" => ["US"],
                "language" => "en",
                "products" => ["auth"]
            ]);
            $res = [
                'status' => 200,
                'data' => json_decode($response),
            ];
            return response()->json($res,200);
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function plaidLinkAcessToken(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'public_token' => ['required'],
                'account_id' => ['required'],
                'account_name' => ['required'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $public_token = $request->public_token;
            $account_id = $request->account_id;
            $account_name = $request->account_name;
            // check if account already linked
            $appHandle = 'gopay_dev';
            $privateKey = 'afcae12e49a8bf1b9a4c57fb1a9e9d1627a756f1a6effc9e99719e7f53466ab2';
            $client = SilaApi::fromDefault($appHandle, $privateKey);
            $user = Auth::user();
            $userHandle = Crypt::decryptString($user->userHandle);
            $userPrivateKey = Crypt::decryptString($user->userPrivateKey);
            $walletAddress = Crypt::decryptString($user->walletAddress);
            $response = $client->getAccounts($userHandle, $userPrivateKey);
            $accounts = $response->getData();
            if(count($accounts)){
                foreach($accounts as $account){
                    if($account->accountName==$account_name){
                        $res = [
                            'status' => 400,
                            'message' => 'Account already linked!',
                        ];
                        return response()->json($res,400);
                    }
                }
            }
            // check if account already linked
            $response = Http::post('https://sandbox.plaid.com/item/public_token/exchange', [
                "client_id" => "61c15e1cf7e762001b324301",
                "secret" => "29a3cc11f0e25607131f0097e41d5c",
                "public_token" => $public_token
            ]);
            if(isset($response['access_token'])){
                return $this->plaidLinkProcessorToken($response['access_token'],$account_id,$account_name);
            }else{
                $res = [
                    'status' => 400,
                    'message' => $response['error_message'],
                    // 'data' => json_decode($response),
                ];
                return response()->json($res,400);
            }
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function plaidLinkProcessorToken($accessToken,$accountId,$accountName){
        try{
            $response = Http::post('https://sandbox.plaid.com/processor/token/create', [
                "client_id" => "61c15e1cf7e762001b324301",
                "secret" => "29a3cc11f0e25607131f0097e41d5c",
                "access_token" => $accessToken,
                "account_id" => $accountId,
                "processor" => "sila_money"
            ]);
            if($response->getStatusCode()==200){
                $response = json_decode($response);
                return $this->linkAccount($response->processor_token,$accountId,$accountName);
                // $res = [
                //     'status' => 200,
                //     'data' => json_decode($response),
                // ];
                // return response()->json($res,200);
            }else{
                $response = json_decode($response);
                $res = [
                    'status' => 400,
                    'data' => $response->error_message,
                ];
                return response()->json($res,400);
            }
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function linkAccount($processorToken,$accountId,$accountName){
        try{
            $appHandle = 'gopay_dev';
            $privateKey = 'afcae12e49a8bf1b9a4c57fb1a9e9d1627a756f1a6effc9e99719e7f53466ab2';
            $client = SilaApi::fromDefault($appHandle, $privateKey);
            $user = Auth::user();
            $userHandle = Crypt::decryptString($user->userHandle);
            $accountName = $accountName;
            $plaidToken = $processorToken;
            $accountId = $accountId;
            $userPrivateKey = Crypt::decryptString($user->userPrivateKey);
            $response = $client->linkAccount($userHandle, $userPrivateKey, $plaidToken, $accountName, $accountId);
            if($response->getStatusCode()==200){
                $res = [
                    'status' => $response->getStatusCode(),
                    'message' => 'Bank account linked successfully!'
                ];
            }else{
                $res = [
                    'status' => $response->getStatusCode(),
                    'message' => $response->getData()->message,
                    'data' => $response->getData(),
                ];
            }
            return response()->json($res,$response->getStatusCode());
            // print_r($response);die;
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }


    public function getAccounts(Request $request){
        try{
            $appHandle = 'gopay_dev';
            $privateKey = 'afcae12e49a8bf1b9a4c57fb1a9e9d1627a756f1a6effc9e99719e7f53466ab2';
            $client = SilaApi::fromDefault($appHandle, $privateKey);
            $user = Auth::user();
            if($user->is_registered_with_sila==0){
                $res = [
                    'status' => 400,
                    'message' => 'Please complete your KYC!',
                ];
                return response()->json($res,400);
            }
            $userHandle = Crypt::decryptString($user->userHandle);
            $userPrivateKey = Crypt::decryptString($user->userPrivateKey);
            $response = $client->getAccounts($userHandle, $userPrivateKey);
            $accounts = $response->getData();
            if(count($accounts)==0){
                $res = [
                    'status' => 400,
                    'message' => 'No account added!',
                ];
                return response()->json($res,400);
            }
            $res = [
                'status' => $response->getStatusCode(),
                'data' => $accounts,
            ];
            return response()->json($res,$response->getStatusCode());
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function getWallets(Request $request){
        try{
            $appHandle = 'gopay_dev';
            $privateKey = 'afcae12e49a8bf1b9a4c57fb1a9e9d1627a756f1a6effc9e99719e7f53466ab2';
            $client = SilaApi::fromDefault($appHandle, $privateKey);
            $user = Auth::user();
            if($user->is_registered_with_sila==0){
                $res = [
                    'status' => 400,
                    'message' => 'Please complete your KYC!',
                ];
                return response()->json($res,400);
            }
            $userHandle = Crypt::decryptString($user->userHandle);
            $userPrivateKey = Crypt::decryptString($user->userPrivateKey);
            $response = $client->getWallet($userHandle, $userPrivateKey);
            $res = [
                'status' => $response->getStatusCode(),
                'data' => [
                    'sila_balance' => $response->getData()->sila_balance/100,
                    'blockchain_address' => Crypt::encryptString($response->getData()->wallet->blockchain_address),
                    // 'data' => $response->getData()
                ],
            ];
            return response()->json($res,$response->getStatusCode());
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }


    public function addMoneyToWallet(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'amount' => ['required'],
                'account_name' => ['required'],
                'description' => ['max:100'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = \Auth::user();
            if($user->is_registered_with_sila==0){
                $res = [
                    'status' => 400,
                    'message' => 'Please complete your KYC!',
                ];
                return response()->json($res,400);
            }
            $appHandle = 'gopay_dev';
            $privateKey = 'afcae12e49a8bf1b9a4c57fb1a9e9d1627a756f1a6effc9e99719e7f53466ab2';
            $client = SilaApi::fromDefault($appHandle, $privateKey);
            $userHandle = Crypt::decryptString($user->userHandle);
            $userPrivateKey = Crypt::decryptString($user->userPrivateKey);
            $walletAddress = Crypt::decryptString($user->walletAddress);
            $amount = ($request->amount)*100;
            $accountName = $request->account_name;
            $descriptor = $request->description?$request->description:'Sila Test'; // Optional
            $businessUuid = 'a9f38290-ce34-42db-95ab-630ebba6084a'; // Optional
            $processingType = AchType::SAME_DAY(); // Optional. Currently supported values are STANDARD (default if not set) and SAME_DAY
            $response = $client->issueSila($userHandle, $amount, $accountName, $userPrivateKey, $descriptor,$businessUuid,$processingType);
            if($response->getStatusCode()==200){
                $res = [
                    'status' => $response->getStatusCode(), // 200
                    // $response->getData()->getReference(); // Random reference number
                    // $response->getData()->getStatus(); // SUCCESS
                    'message' => $response->getData()->getMessage() // Transaction submitted to processing queue.
                    // $response->getData()->getDescriptor(); // Transaction Descriptor.
                    // $response->getData()->getTransactionId(); // The transaction id.
                ];
            }else{
                if($response->getData()->message=='Bad request.'){
                    $res = [
                        'status' => $response->getStatusCode(),
                        'message' => $response->getData()->message,
                        'data' => $response->getData()->validation_details,
                    ];
                }else{
                    $res = [
                        'status' => $response->getStatusCode(),
                        'message' => $response->getData()->message,
                        // 'data' => $response->getData(),
                    ];
                }
            }
            return response()->json($res,$response->getStatusCode());
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function searchUsersWallet(Request $request){
        try{
            $appHandle = 'gopay_dev';
            $privateKey = 'afcae12e49a8bf1b9a4c57fb1a9e9d1627a756f1a6effc9e99719e7f53466ab2';
            $client = SilaApi::fromDefault($appHandle, $privateKey);
            $phone_number = $request->phone_number;
            if(\Auth::user()->is_registered_with_sila==0){
                $res = [
                    'status' => 400,
                    'message' => 'Please complete your KYC!',
                ];
                return response()->json($res,400);
            }
            if($request->has('search_term') && isset($request->search_term)){
                // explode for first name and last name
                $search_terms = explode(' ',$request->search_term);
                $first_name = $search_terms[0];
                $last_name = '';
                if(count($search_terms)>=2){
                    $last_name = $search_terms[1];
                }
                // explode for first name and last name
                if($last_name!=''){
                    $users = User::where(function($query) use($request){
                        $query->where('phone_number','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query2) use($request){
                        $query2->where('phone_number_with_country_code','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query3) use($request){
                        $query3->where('email','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query4) use($first_name){
                        $query4->where('first_name','LIKE','%'.$first_name.'%');
                    })->orWhere(function($query5) use($last_name){
                        $query5->where('last_name','LIKE','%'.$last_name.'%');
                    })->get();
                }else{
                    $users = User::where(function($query) use($request){
                        $query->where('phone_number','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query2) use($request){
                        $query2->where('phone_number_with_country_code','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query3) use($request){
                        $query3->where('email','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query4) use($first_name){
                        $query4->where('first_name','LIKE','%'.$first_name.'%');
                    })->orWhere(function($query5) use($first_name){
                        $query5->where('last_name','LIKE','%'.$first_name.'%');
                    })->get();
                }
                // $users = User::where('phone_number','LIKE','%'.$phone_number.'%')->where('phone_number','!=',\Auth::user()->phone_number)->get();
                if($users->count()){
                    $res = [];
                    foreach($users as $user){
                        if($user->is_registered_with_sila==1){
                            // $userHandle = Crypt::decryptString($user->userHandle);
                            // $userPrivateKey = Crypt::decryptString($user->userPrivateKey);
                            // $response = $client->getWallet($userHandle, $userPrivateKey);
                            // if($response->getData()->status!="FAILURE"){
                            if($user->walletAddress!="" && $user->walletAddress!=null){
                                $object = new \stdClass;
                                $object->user_id = $user->id;
                                $object->name = $user->first_name.' '.$user->last_name;
                                $object->email = $user->email;
                                $object->phone_number = $user->phone_number;
                                $object->profile_picture = $user->profile_picture;
                                $object->userHandle = $user->userHandle;
                                $object->walletAddress = $user->walletAddress;
                                $res[] = $object;
                            }
                        }
                    }
                    $response = [
                        'status' => 200,
                        'data' => $res,
                    ];
                    return response()->json($response,200);
                }else{
                    $res = [
                        'status' => 200,
                        'message' => 'Not data found!',
                        'data' => []
                    ];
                    return response()->json($res,200);
                }
            }else{
                $yourHandle = \Auth::user()->userHandle;
                $yourAddress = \Auth::user()->walletAddress;
                $transactions = \App\Models\PaymentTransaction::where(['userHandle'=>$yourHandle,'walletAddress'=>$yourAddress])->groupBy('destinationAddress')->get();
                if($transactions->count()){
                    $res = [];
                    foreach($transactions as $transaction){
                        $user = User::where('userHandle',$transaction->destinationHandle)->first();
                        $object = new \stdClass;
                        $object->user_id = $user->id;
                        $object->name = $user->first_name.' '.$user->last_name;
                        $object->email = $user->email;
                        $object->phone_number = $user->phone_number;
                        $object->profile_picture = $user->profile_picture;
                        $object->userHandle = $transaction->destinationHandle;
                        $object->walletAddress = $transaction->destinationAddress;
                        $res[] = $object;
                    }
                    $response = [
                        'status' => 200,
                        'data' => $res,
                    ];
                    return response()->json($response,200);
                }else{
                    $res = [
                        'status' => 200,
                        'message' => 'Not data found!',
                        'data' => []
                    ];
                    return response()->json($res,200);
                }

            }
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function transferMoney(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'amount' => ['required'],
                'userHandle' => ['required'],
                'walletAddress' => ['required'],
                'description' => ['max:100'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = \Auth::user();
            if($user->is_registered_with_sila==0){
                $res = [
                    'status' => 400,
                    'message' => 'Please complete your KYC!',
                ];
                return response()->json($res,400);
            }
            $appHandle = 'gopay_dev';
            $privateKey = 'afcae12e49a8bf1b9a4c57fb1a9e9d1627a756f1a6effc9e99719e7f53466ab2';
            $client = SilaApi::fromDefault($appHandle, $privateKey);
            $userHandle = Crypt::decryptString($user->userHandle);
            $userPrivateKey = Crypt::decryptString($user->userPrivateKey);
            $walletAddress = Crypt::decryptString($user->walletAddress);
            $destination = Crypt::decryptString(urldecode($request->userHandle));
            $amount = urldecode($request->amount)*100;
            $destinationAddress = Crypt::decryptString(urldecode($request->walletAddress)); // Optional
            $destinationWalletName = 'the_wallet_name'; // Optional
            $descriptor = $request->description?urldecode($request->description):"Sila transfer"; // Optional
            $businessUuid = 'a9f38290-ce34-42db-95ab-630ebba6084a'; // Optional
            $processingType = AchType::SAME_DAY();

            // check if limit crossed
            $limit = TransactionLimit::first();
            $current_transactions = PaymentTransaction::where('userHandle',$user->userHandle)->get();

            $sum = 0;
            foreach($current_transactions as $current_transaction){
                if(strtotime($current_transaction->transaction_time) >= strtotime(\Carbon\Carbon::now()->subDay($limit->days)) && strtotime($current_transaction->transaction_time) <= strtotime(\Carbon\Carbon::now())){

                    $sum += $current_transaction->amount;
                }
            }

            $days_or_hours = $limit->days <= 3 ? ($limit->days*24).' hours' : $limit->days.' days';

            if($sum >= $limit->amount){
                $res = [
                    'status' => 200,
                    'message' => 'You can not transfer more than $'.$limit->amount.' within '.($days_or_hours),
                ];
                return response()->json($res,200);
            }else{
                $after_transfer_amount = $sum + urldecode($request->amount);
                if($after_transfer_amount > $limit->amount){
                    $res = [
                        'status' => 200,
                        'message' => 'You can not transfer more than $'.$limit->amount.' within '.($days_or_hours),
                    ];
                    return response()->json($res,200);
                }
            }
            // check if limit crossed

            $response = $client->transferSila($userHandle, $destination, $amount, $userPrivateKey, $destinationAddress, $destinationWalletName, $descriptor,$businessUuid,$processingType);

            if($response->getStatusCode()==200){
                $res = [
                    'status' => $response->getStatusCode(),
                    'message' => $response->getData()->getMessage(),
                    'descriptor' => $response->getData()->getDescriptor(),
                ];
                $payment_transaction = new \App\Models\PaymentTransaction;
                $payment_transaction->transactionId = $response->getData()->getTransactionId();
                $payment_transaction->userHandle = $user->userHandle;
                $payment_transaction->walletAddress = $user->walletAddress;
                $payment_transaction->destinationHandle = urldecode($request->userHandle);
                $payment_transaction->destinationAddress = urldecode($request->walletAddress);
                $payment_transaction->amount = urldecode($request->amount);
                $payment_transaction->description = $descriptor;
                $payment_transaction->statusCode = $response->getStatusCode();
                $payment_transaction->status = $response->getData()->getStatus();
                $payment_transaction->message = $response->getData()->getMessage();
                $payment_transaction->response = json_encode($response);
                $payment_transaction->transaction_time = date('Y-m-d\TH:i:s.ZZZ\Z', time());
                if($payment_transaction->save()){
                    $sender = User::where('userHandle',$user->userHandle)->first();
                    $receiver = User::where('userHandle',urldecode($request->userHandle))->first();
                    // send notification
                    $title = "Money Received";
                    $message = $sender->first_name." sent you $".urldecode($request->amount).".";

                    // save notification
                    $notification = new Notification;
                    $notification->title = $title;
                    $notification->message = $message;
                    $notification->sender_id = $sender->id;
                    $notification->receiver_id = $receiver->id;
                    $notification->type = 'money_received';
                    $notification->notification_time = date('Y-m-d\TH:i:s.ZZZ\Z', time());
                    $notification->save();
                    // save notification

                    $new_notification_count = Notification::where(['receiver_id'=>$receiver->id,'status'=>0])->count();

                    $data = [
                        'sender_id' => $sender->id,
                        'sender_name' => $sender->first_name.' '.$sender->last_name,
                        'sender_image' => $sender->profile_picture,
                        'receiver_id' => $receiver->id,
                        'notification_type' => 'money_received',
                        'type' => 'money_received',
                        'new_notification_count' => $new_notification_count,
                    ];

                    if($receiver->notification_enabled==1 && $receiver->device_token!="" && $receiver->device_token!=null){
                        if($receiver->device_type=='1' || $receiver->device_type==1){
                            $this->pushnotification($receiver->device_token, $title, $message, null, $data);
                        }else{
                            $this->iosPushNotification($receiver->device_token, $title, $message, $data);
                        }
                    }
                    // send notification

                    $msg_time = date('Y-m-d\TH:i:s.ZZZ\Z', time());
                    if($request->has('chat_id') && $request->chat_id!=null && $request->chat_id!=''){
                        //nothing
                    }else{
                        $if_chat_head_exist = ChatHead::where(function($query) use ($sender,$receiver){
                            $query->where('sender_id',$sender->id)
                           ->where('receiver_id',$receiver->id);
                        })->orWhere(function($query2) use ($sender,$receiver){
                            $query2->where('sender_id',$receiver->id)
                           ->where('receiver_id',$sender->id);
                        })->first();
                        if($if_chat_head_exist){
                            $message = new Message;
                            $message->sender_id = $sender->id;
                            $message->receiver_id = $receiver->id;
                            $message->chat_head_id = $if_chat_head_exist->id;
                            $message->message = urldecode($request->amount);
                            $message->message_type = 3;
                            $message->message_date = $msg_time;
                            $message->save();
                            $res['chat_id'] = $message->id;
                        }else{
                            $chat_head = new ChatHead;
                            $chat_head->sender_id = $sender->id;
                            $chat_head->receiver_id = $receiver->id;
                            if($chat_head->save()){
                                $message = new Message;
                                $message->sender_id = $sender->id;
                                $message->receiver_id = $receiver->id;
                                $message->chat_head_id = $chat_head->id;
                                $message->message = urldecode($request->amount);
                                $message->message_type = 3;
                                $message->message_date = $msg_time;
                                $message->save();
                                $res['chat_id'] = $message->id;
                            }
                        }
                    }
                }
            }else{
                if($response->getData()->message=='Bad request.'){
                    $res = [
                        'status' => 400,
                        'message' => $response->getData()->message,
                        'data' => $response->getData()->validation_details,
                    ];
                }else{
                    $res = [
                        'status' => 400,
                        'message' => $response->getData()->message,
                    ];
                }
            }
            return response()->json($res,$response->getStatusCode());
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function transactionHistory(Request $request){
        try{
            $appHandle = 'gopay_dev';
            $privateKey = 'afcae12e49a8bf1b9a4c57fb1a9e9d1627a756f1a6effc9e99719e7f53466ab2';
            $client = SilaApi::fromDefault($appHandle, $privateKey);
            $user = Auth::user();
            if($user->is_registered_with_sila==0){
                $res = [
                    'status' => 400,
                    'message' => 'Please complete your KYC!',
                ];
                return response()->json($res,400);
            }
            $userHandle = $user->userHandle;
            $userPrivateKey = $user->userPrivateKey;
            $type = $request->type?$request->type:0; //0=>all,1=>sent,2=>received
            if(isset($request->search_term)){
                $search_terms = explode(' ',$request->search_term);
                $first_part = $search_terms[0];
                if(count($search_terms)>=2){
                    $last_part = $search_terms[1];
                    // $users_handle = User::where('first_name','LIKE',$first_part.'%')->where('last_name','LIKE',$last_part.'%')->pluck('userHandle');
                    $users_handle = User::where(function($query) use($request){
                        $query->where('phone_number','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query2) use($request){
                        $query2->where('phone_number_with_country_code','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query3) use($request){
                        $query3->where('email','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query4) use($first_part){
                        $query4->where('first_name','LIKE','%'.$first_part.'%');
                    })->orWhere(function($query5) use($last_part){
                        $query5->where('last_name','LIKE','%'.$last_part.'%');
                    })->pluck('userHandle');
                }else{
                    // $users_handle = User::where('first_name','LIKE',$first_part.'%')->Orwhere('last_name','LIKE',$first_part.'%')->pluck('userHandle');
                    $users_handle = User::where(function($query) use($request){
                        $query->where('phone_number','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query2) use($request){
                        $query2->where('phone_number_with_country_code','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query3) use($request){
                        $query3->where('email','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query4) use($request){
                        $query4->where('first_name','LIKE','%'.$request->search_term.'%');
                    })->orWhere(function($query5) use($request){
                        $query5->where('last_name','LIKE','%'.$request->search_term.'%');
                    })->pluck('userHandle');
                }
                if($type==0){
                    $transactions = PaymentTransaction::with('sender','receiver','user')->select('id','userHandle','destinationAddress','destinationHandle','amount','description','statusCode','status','message','created_at','transaction_time')
                        ->where(function($query) use ($userHandle,$users_handle){
                            $query->where('userHandle',$userHandle)
                           ->whereIn('destinationHandle',$users_handle);
                        })->orWhere(function($query2) use ($userHandle,$users_handle){
                            $query2->where('destinationHandle',$userHandle)
                           ->whereIn('userHandle',$users_handle);
                        })->orderBy('created_at','DESC')->paginate(10);
                }elseif($type==1){
                    $transactions = PaymentTransaction::with('sender','receiver','user')->select('id','userHandle','destinationAddress','destinationHandle','amount','description','statusCode','status','message','created_at','transaction_time')
                        ->where(function($query) use ($userHandle,$users_handle){
                            $query->where('userHandle',$userHandle)
                           ->whereIn('destinationHandle',$users_handle);
                        })->orderBy('created_at','DESC')->paginate(10);
                }elseif($type==2){
                    $transactions = PaymentTransaction::with('sender','receiver','user')->select('id','userHandle','destinationAddress','destinationHandle','amount','description','statusCode','status','message','created_at','transaction_time')
                        ->Where(function($query2) use ($userHandle,$users_handle){
                            $query2->where('destinationHandle',$userHandle)
                           ->whereIn('userHandle',$users_handle);
                        })->orderBy('created_at','DESC')->paginate(10);
                }
                $res = [
                    'status' => 200,
                    'data' => $transactions,
                ];
                return response()->json($res,200);
            }else{
                if($type==0){
                    $transactions = PaymentTransaction::with('sender','receiver','user')->select('id','userHandle','destinationAddress','destinationHandle','amount','description','statusCode','status','message','created_at','transaction_time')
                        ->where(function($query) use ($userHandle){
                            $query->where('userHandle',$userHandle);
                        })->orWhere(function($query2) use ($userHandle){
                            $query2->where('destinationHandle',$userHandle);
                        })->orderBy('created_at','DESC')->paginate(10);
                }elseif($type==1){
                    $transactions = PaymentTransaction::with('sender','receiver','user')->select('id','userHandle','destinationAddress','destinationHandle','amount','description','statusCode','status','message','created_at','transaction_time')
                        ->where(function($query) use ($userHandle){
                            $query->where('userHandle',$userHandle);
                        })->orderBy('created_at','DESC')->paginate(10);
                }elseif($type==2){
                    $transactions = PaymentTransaction::with('sender','receiver','user')->select('id','userHandle','destinationAddress','destinationHandle','amount','description','statusCode','status','message','created_at','transaction_time')
                        ->Where(function($query2) use ($userHandle){
                            $query2->where('destinationHandle',$userHandle);
                        })->orderBy('created_at','DESC')->paginate(10);
                }
                $res = [
                    'status' => 200,
                    'data' => $transactions,
                ];
                return response()->json($res,200);
            }
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function getAccountBalance(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'accountName' => ['required']
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = Auth::user();
            if($user->is_registered_with_sila==0){
                $res = [
                    'status' => 400,
                    'message' => 'Please complete your KYC!',
                ];
                return response()->json($res,400);
            }
            $appHandle = 'gopay_dev';
            $privateKey = 'afcae12e49a8bf1b9a4c57fb1a9e9d1627a756f1a6effc9e99719e7f53466ab2';
            $client = SilaApi::fromDefault($appHandle, $privateKey);
            $userHandle = Crypt::decryptString($user->userHandle);
            $userPrivateKey = Crypt::decryptString($user->userPrivateKey);
            $accountName = $request->accountName;
            $response = $client->getAccountBalance($userHandle, $userPrivateKey, $accountName);
            if($response->getStatusCode()==200){
                $res = [
                    'status' => 200,
                    'data' => $response->getData(),
                ];
            }else{
                $res = [
                    'status' => $response->getStatusCode(),
                    'message' => $response->getData()->message,
                ];
            }
            return response()->json($res,$response->getStatusCode());
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function redeemBalance(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'accountName' => ['required'],
                'amount' => ['required'],
                'description' => ['max:100'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = Auth::user();
            if($user->is_registered_with_sila==0){
                $res = [
                    'status' => 400,
                    'message' => 'Please complete your KYC!',
                ];
                return response()->json($res,400);
            }
            $appHandle = 'gopay_dev';
            $privateKey = 'afcae12e49a8bf1b9a4c57fb1a9e9d1627a756f1a6effc9e99719e7f53466ab2';
            $client = SilaApi::fromDefault($appHandle, $privateKey);
            $userHandle = Crypt::decryptString($user->userHandle);
            $userPrivateKey = Crypt::decryptString($user->userPrivateKey);
            $accountName = $request->accountName;
            $amount = ($request->amount)*100;
            $descriptor = $request->description?$request->description:"wallet to account";
            $businessUuid = 'a9f38290-ce34-42db-95ab-630ebba6084a'; // optional
            $processingType = AchType::SAME_DAY(); // Optional. Currently supported values are STANDARD (default if not set) and SAME_DAY
            $response = $client->redeemSila($userHandle, $amount, $accountName, $userPrivateKey, $descriptor, $businessUuid, $processingType);
            if($response->getStatusCode()==200){
                $res = [
                    'status' => $response->getStatusCode(),
                    'message' => $response->getData()->getMessage(),
                    'descriptor' => $response->getData()->getDescriptor(),
                ];
            }else{
                if($response->getData()->message=='Bad request.'){
                    $res = [
                        'status' => $response->getStatusCode(),
                        'message' => $response->getData()->message,
                        'data' => $response->getData()->validation_details,
                    ];
                }else{
                    $res = [
                        'status' => $response->getStatusCode(),
                        'message' => $response->getData()->message,
                    ];
                }
            }
            return response()->json($res,$response->getStatusCode());
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function checkWalletByPhone(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'phone_number' => ['required'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = User::where('phone_number_with_country_code',$request->phone_number)->orWhere('phone_number',$request->phone_number)->first();
            if($user){
                if($user->is_registered_with_sila==1 && $user->is_kyc_done==1){
                    $res = [
                        'status' => 200,
                        'message' => 'User found!',
                        'data' => $user,
                    ];
                    return response()->json($res,200);
                }else{
                    $res = [
                        'status' => 400,
                        'message' => 'User has not done KYC yet!',
                    ];
                    return response()->json($res,400);
                }
            }else{
                $res = [
                    'status' => 400,
                    'message' => 'User is not registered with GoPay!',
                ];
                return response()->json($res,400);
            }


        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function getUserById(Request $request){
        try{

            $validator = Validator::make($request->all(), [
                'user_id' => ['required'],
            ]);

            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }

            $user = User::find($request->user_id);
            $currentUser = Auth::user();


            if($user){
                if($user->is_registered_with_sila==1 && $user->is_kyc_done==1){

                    $transactions = PaymentTransaction::where(function($query) use ($user,$currentUser){
                            $query->where('userHandle',$user->userHandle)
                           ->where('destinationHandle',$currentUser->userHandle);
                        })->orWhere(function($query2) use ($user,$currentUser){
                            $query2->where('destinationHandle',$user->userHandle)
                           ->where('userHandle',$currentUser->userHandle);
                        })->count();

                    $user['transaction_count'] = $transactions;

                    $res = [
                        'status' => 200,
                        'message' => 'User found!',
                        'data' => $user,
                        // 'data' => [
                        //     'user' => $user,
                        //     'transactions_count' => $transactions,
                        // ],
                    ];
                    return response()->json($res,200);
                }else{
                    $res = [
                        'status' => 400,
                        'message' => 'User has not done KYC yet!',
                    ];
                    return response()->json($res,400);
                }
            }else{
                $res = [
                    'status' => 400,
                    'message' => 'User not found!',
                ];
                return response()->json($res,400);
            }


        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function markUserAsFavourite(Request $request){
        try{

            $validator = Validator::make($request->all(), [
                'user_id' => ['required'],
                'custom_name' => ['required'],
            ]);

            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }

            $check_if_already_added = Favourite::where('user_id',Auth::user()->id)->where('favourite_user_id',$request->user_id)->first();

            if($check_if_already_added){

                $check_if_already_added->delete();
                $res = [
                    'status' => 200,
                    'message' => "User removed from favourites!",
                ];
                return response()->json($res,200);

            }else{
                $favourite = new Favourite;
                $favourite->user_id = Auth::user()->id;
                $favourite->favourite_user_id = $request->user_id;
                $favourite->custom_name = $request->custom_name;

                // image
                if(!empty($request->custom_image)){

                    $array = explode('data:image', $request->custom_image);
                    $folderPath = public_path()."/userProfilePicture/";
                    foreach ($array as $arr) {
                        if($arr!='' && $arr!=null){
                            $explodes = explode('base64,', $arr);
                            $base_64 = $explodes[1];
                            $extension = explode('/', $explodes[0])[1];
                            $image_type = explode(';', $extension)[0];
                            $image_base64 = base64_decode($base_64);
                            $file = $folderPath . uniqid() . '.'.$image_type;
                            file_put_contents($file, $image_base64);
                            $profilePicture = explode($folderPath, $file)[1];

                            $favourite->custom_image = $profilePicture;
                        }
                    }
                }
                // image

                if($favourite->save()){
                    $res = [
                        'status' => 200,
                        'message' => "User added to favourites!",
                    ];
                    return response()->json($res,200);
                }else{
                    $res = [
                        'status' => 400,
                        'message' => "Something went wrong!",
                    ];
                    return response()->json($res,400);
                }
            }

        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function getFavourites(){
        try{

            $favourites = Favourite::where('user_id',Auth::user()->id)->with('user')->get();

            foreach( $favourites as $fav )
            {
                $fav->user->walletAccountNumber = GoPayFacade::walletAccountByUserId( $fav->user->id );
            }


            $res = [
                'status' => 200,
                'data' => $favourites,
            ];

            return response()->json($res,200);

        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function getChatByUser(Request $request){
        try{

            $validator = Validator::make($request->all(), [
                'user_id' => ['required'],
            ]);

            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }

            $user = User::find($request->user_id);

            if($user){

                Message::where(['receiver_id'=>Auth::user()->id,'sender_id'=>$user->id,'is_read'=>0])->update(['is_read'=>1]);

                $messages = Message::where(function($query) use ($user){
                            $query->where('sender_id',$user->id)
                           ->where('receiver_id',Auth::user()->id);
                        })->orWhere(function($query2) use ($user){
                            $query2->where('sender_id',Auth::user()->id)
                           ->where('receiver_id',$user->id);
                        })->orderBy('id','DESC')->paginate(20);


                $latest_messages = array_values($messages->reverse()->toArray());
                $walletAccountNumber = GoPayFacade::getWalletAccountNumber( $user );
                $user->walletAccountNumber = $walletAccountNumber;
                $res = [
                    'status' => 200,
                    'data' => [
                        'user' => $user,
                        'chats' => $latest_messages,
                    ],
                ];
                return response()->json($res,200);
            }else{
                $res = [
                    'status' => 400,
                    'message' => 'User not found!',
                ];
                return response()->json($res,400);
            }
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function sendMessage(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'user_id' => ['required'],
                'message' => ['required'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = User::find($request->user_id);
            if($user){
                $chat_head = ChatHead::where(function($query) use ($user){
                            $query->where('sender_id',$user->id)
                           ->where('receiver_id',Auth::user()->id);
                        })->orWhere(function($query2) use ($user){
                            $query2->where('sender_id',Auth::user()->id)
                           ->where('receiver_id',$user->id);
                        })->first();
                if($chat_head){
                    $message = new Message;
                    $message->sender_id = Auth::user()->id;
                    $message->receiver_id = $user->id;
                    $message->chat_head_id = $chat_head->id;
                    $message->message = $request->message;
                    if($message->save()){
                        // send event to listeners
                        broadcast(new MessageSentEvent('Hello', $user->id))->toOthers();
                        $res = [
                            'status' => 200,
                            'message' => 'Message sent successfully!',
                        ];
                        return response()->json($res,200);
                    }
                }else{
                    $chat_head = new ChatHead;
                    $chat_head->sender_id = Auth::user()->id;
                    $chat_head->receiver_id = $user->id;
                    if($chat_head->save()){
                        $message = new Message;
                        $message->sender_id = Auth::user()->id;
                        $message->receiver_id = $user->id;
                        $message->chat_head_id = $chat_head->id;
                        $message->message = $request->message;
                        if($message->save()){
                            // send event to listeners
                            broadcast(new MessageSentEvent('Hello', $user->id))->toOthers();
                            $res = [
                                'status' => 200,
                                'message' => 'Message sent successfully!',
                            ];
                            return response()->json($res,200);
                        }
                    }
                }
            }else{
                $res = [
                    'status' => 400,
                    'message' => 'User not found!',
                ];
                return response()->json($res,400);
            }

        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function getChatList(){
        try{
            $user_id = Auth::user()->id;
            $chat_head_ids = Message::where(function($query) use ($user_id){
                            $query->where('sender_id',$user_id);
                        })->orWhere(function($query2) use ($user_id){
                            $query2->where('receiver_id',$user_id);
                        })->orderBy('id','DESC')->pluck('chat_head_id');

            // $chatList = ChatHead::with('lastMessage')->where(function($query) use ($user_id){
            //                 $query->where('sender_id',$user_id);
            //             })->orWhere(function($query2) use ($user_id){
            //                 $query2->where('receiver_id',$user_id);
            //             })->orderBy('created_at','DESC')->get();

            $chat_head_ids = array_unique($chat_head_ids->toArray());
           // dd($chat_head_ids);
            $chatList = [];
            foreach($chat_head_ids as $key => $item){

                $chatList[] = ChatHead::with('lastMessage')->where('id',$item)->first();
            }
            $res = [
                'status' => 200,
                'data' => $chatList,
            ];
            return response()->json($res,200);
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function updateOnlineStatus(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'status' => ['required'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = Auth::user();
            if($request->status==1){
                $user->update(['is_online'=>1]);
            }else{
                $user->update(['is_online'=>0]);
            }
            $res = [
                'status' => 200,
                'message' => "Status Updated successfully!",
            ];
            return response()->json($res,200);
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    // testing push notification ios with apns
    public function iosPushNotification($device_token, $title, $message, $data){
        try{
            $base_path =  public_path();//die;
            $pushCertAndKeyPemFile = $base_path. '/Gopay-APNS.pem';
            $pem_file       = $pushCertAndKeyPemFile;
            $pem_secret     = 'rvtech';
            $apns_topic     = 'com.rvtech.DequincyApp';
            $body ['aps'] = array (
                           'title' => $title,
                           'message' => $message,
                           'alert' => $title,
                           'data' => $data,
                           'sound' => 'default',
                           "mutable-content" => '1'
            );
            $url = "https://api.development.push.apple.com/3/device/$device_token";
            // $url = "https://api.push.apple.com/3/device/$device_token";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("apns-topic: $apns_topic"));
            curl_setopt($ch, CURLOPT_SSLCERT, $pem_file);
            curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $pem_secret);
            $response = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($httpcode==200){
                return true;
            }else{
                return false;
            }
        }catch(\Exception $e){
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }
    // testing push notification ios with apns

    public function enableNotification(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'status' => ['required'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = Auth::user();
            if($request->status==1){
                $user->notification_enabled = 1;

                if($request->has('deviceToken') && $request->deviceToken!=""  && $request->deviceToken!=null){
                    $user->device_token = $request->deviceToken;
                }

                $user->save();

                $res = [
                    'status' => 200,
                    'message' => "Notification Enabled successfully!",
                ];
            }else{
                $user->notification_enabled = 0;
                $user->save();

                $res = [
                    'status' => 200,
                    'message' => "Notification Disabled successfully!",
                ];
            }
            return response()->json($res,200);
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function generateQR(){
        return view('QR-code');
    }

    public function notifications(){
        try{
            $user_id = Auth::user()->id;
            $notifications = Notification::where('receiver_id',$user_id)->orderBy('id','DESC')->select('id','title','message','type','status','notification_time')->paginate(10);
            $res = [
                'status' => 200,
                'data' => $notifications,
            ];
            Notification::where(['receiver_id' => $user_id, 'status'=>0])->update(['status'=>1]);
            return response()->json($res,200);
        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function getUserByHandle(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'userHandle' => ['required'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }

            $userHandle = $request->userHandle;
            // $user =

        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }


    public function transactionGraph(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'year' => ['required'],
                'type' => ['required'],  // sent => 0, received => 1
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = Auth::user();
            if($request->has('month') && $request->month!="" && $request->month!=null){

                // $month = '2022-02';
                $month = $request->year.'-'.$request->month;
                $start = Carbon::parse($month)->startOfMonth();
                $end = Carbon::parse($month)->endOfMonth();

               // return $end;
                $data = [];
                while ($start->lte($end)) {

                    // $start->copy()->format('d');

                    if($request->type==0){
                        $transaction_count = PaymentTransaction::where(function($query) use ($user,$request,$start){
                                $query->where('userHandle',$user->userHandle)
                               ->whereYear('created_at',$request->year)
                               ->whereMonth('created_at',$request->month)
                               ->whereDay('created_at',$start->copy()->format('d'));
                            })->sum('amount');
                    }else{
                        $transaction_count = PaymentTransaction::where(function($query2) use ($user,$request,$start){
                                $query2->where('destinationHandle',$user->userHandle)
                               ->whereYear('created_at',$request->year)
                               ->whereMonth('created_at',$request->month)
                               ->whereDay('created_at',$start->copy()->format('d'));
                            })->sum('amount');
                    }

                    $month_arr = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

                    $month_name = $month_arr[$request->month-1];

                    array_push($data, array(
                        // 'month_number' => $month->month,
                        'date' => $start->copy()->format('d').' '.$month_name,
                        'year' => $request->year,
                        'transaction_count' => $transaction_count
                    ));

                     // $dates[] = $start->copy();
                     $start->addDay();
                }

                $res = [
                    'status' => 200,
                    'data' => $data
                ];
                // return $data;
                return response()->json($res,200);

            }else{
                $data = array();
                for ($i = 13; $i >= 2; $i--) {
                    $month = Carbon::today()->subMonth($i);
                    //return $month;
                    $year = $request->year;

                    if($request->type==0){
                        $transaction_count = PaymentTransaction::where(function($query) use ($user,$month,$year){
                                $query->where('userHandle',$user->userHandle)
                               ->whereYear('created_at',$year)
                               ->whereMonth('created_at',$month->month);
                            })->sum('amount');
                    }else{
                        $transaction_count = PaymentTransaction::where(function($query2) use ($user,$month,$year){
                                $query2->where('destinationHandle',$user->userHandle)
                               ->whereYear('created_at',$year)
                               ->whereMonth('created_at',$month->month);
                            })->sum('amount');
                    }

                    array_push($data, array(
                        // 'month_number' => $month->month,
                        'month' => $month->shortMonthName,
                        'year' => $year,
                        'transaction_count' => $transaction_count
                    ));
                }
                $res = [
                    'status' => 200,
                    'data' => $data
                ];
                // return $data;
                return response()->json($res,200);
            }


        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }


    public function rateUser(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'user_id' => ['required'],
                'rating' => ['required'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }

            $user = Auth::user();

            $if_already_rated = UserRating::where(['user_id'=>$request->user_id,'rated_by'=>$user->id])->first();

            if($if_already_rated){
                // $user_rating = new UserRating;
                $if_already_rated->user_id = $request->user_id;
                $if_already_rated->rated_by = $user->id;
                $if_already_rated->rating = $request->rating;
                if($if_already_rated->save()){
                    $res = [
                        'status' => 200,
                        'message' => 'User rated successfully!',
                    ];
                }else{
                    $res = [
                        'status' => 400,
                        'status' => 'Something went wrong!',
                    ];
                }
            }else{
                $user_rating = new UserRating;
                $user_rating->user_id = $request->user_id;
                $user_rating->rated_by = $user->id;
                $user_rating->rating = $request->rating;
                if($user_rating->save()){
                    $res = [
                        'status' => 200,
                        'message' => 'User rated successfully!',
                    ];
                }else{
                    $res = [
                        'status' => 400,
                        'status' => 'Something went wrong!',
                    ];
                }
            }

            return response()->json($res,200);

        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

    public function blockUser(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'user_id' => ['required'],
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }

            $user = Auth::user();

            $if_already_blocked = BlockedUser::where(['user_id'=>$request->user_id,'blocked_by'=>$user->id])->first();

            if($if_already_blocked){

                if($if_already_blocked->delete()){
                    $res = [
                        'status' => 200,
                        'message' => 'User unblocked successfully!',
                    ];
                }else{
                    $res = [
                        'status' => 400,
                        'status' => 'Something went wrong!',
                    ];
                }
            }else{
                $block_user = new BlockedUser;
                $block_user->user_id = $request->user_id;
                $block_user->blocked_by = $user->id;
                if($block_user->save()){
                    $res = [
                        'status' => 200,
                        'message' => 'User blocked successfully!',
                    ];
                }else{
                    $res = [
                        'status' => 400,
                        'status' => 'Something went wrong!',
                    ];
                }
            }

            return response()->json($res,200);

        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }


    public function verifyPhone(Request $request){
        try{
            $validator   = Validator::make($request->all(), [
                'phone_number'    => 'required|unique:users,phone_number,'.Auth::user()->id,
                'country_code' => 'required',
            ]);

            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }

            $phone_number = urldecode($request->phone_number);

            $user = Auth::user();

            if(!$user){
                $res = [
                    'status' => 200,
                    'message' => 'User not found!',
                ];
                return response()->json($res,200);
            }

            $country_code = '+'.str_replace(" ","",urldecode($request->country_code));
            $phone_number = str_replace(" ","",urldecode($request->phone_number));

            $user->phone_verified = '1';
            $user->phone_verified_at = Carbon::now();
            $user->phone_number = $phone_number;
            $user->country_code = $country_code;
            $user->phone_number_with_country_code = $country_code.$phone_number;

            if($user->save()){
                $token = $user->createToken($user->phone_number.'-'.now());
                $res = [
                    'success' => true,
                    'status' => 200,
                    'message' => 'Logged in successfully!',
                    'data' => [
                        'user' => User::find($user->id),
                        'access_token' => $token->accessToken,
                    ]
                ];
            }else{
                $res = [
                    'status' => 400,
                    'status' => 'Something went wrong!',
                ];
            }

            return response()->json($res,200);

        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }



    public function transactionGraphNew(Request $request){

        try{
            $validator = Validator::make($request->all(), [
                'year' => ['required'],
                'type' => ['required'],  // sent => 0, received => 1
            ]);
            if($validator->fails()) {
                $error = [
                    'message' => $validator->errors()->first(),
                    'status' => 400,
                ];
                return response()->json($error, 400);
            }
            $user = Auth::user();
            $person = Person::where('loggedIn_user_id', $user->id )->get('person_id');
            $personId = $person[0]->person_id;
            if($request->has('month') && $request->month!="" && $request->month!=null){

                // $month = '2022-02';
                $month = $request->year.'-'.$request->month;
                $start = Carbon::parse($month)->startOfMonth();
                $end = Carbon::parse($month)->endOfMonth();

               // return $end;
                $data = [];
                while ($start->lte($end)) {

                    // $start->copy()->format('d');

                    if($request->type==0){
                        $transaction_count = MoneyTransfer::where(function($query) use ($personId,$request,$start){
                                $query->where('transferBy',$personId)
                               ->whereYear('transferredAt',$request->year)
                               ->whereMonth('transferredAt',$request->month)
                               ->whereDay('transferredAt',$start->copy()->format('d'));
                            })->sum('amount');
                    }else{
                        $transaction_count = MoneyTransfer::where(function($query2) use ($personId,$request,$start){
                                $query2->where('transferTo',$personId)
                               ->whereYear('transferredAt',$request->year)
                               ->whereMonth('transferredAt',$request->month)
                               ->whereDay('transferredAt',$start->copy()->format('d'));
                            })->sum('amount');
                    }

                    $month_arr = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

                    $month_name = $month_arr[$request->month-1];

                    array_push($data, array(
                        // 'month_number' => $month->month,
                        'date' => $start->copy()->format('d').' '.$month_name,
                        'year' => $request->year,
                        'transaction_count' => $transaction_count
                    ));

                     // $dates[] = $start->copy();
                     $start->addDay();
                }

                $res = [
                    'status' => 200,
                    'data' => $data
                ];
                // return $data;
                return response()->json($res,200);

            }else{
                $data = array();
                for ($i = 13; $i >= 2; $i--) {
                    $month = Carbon::today()->subMonth($i);
                    //return $month;
                    $year = $request->year;

                    if($request->type==0){

                            $transaction_count = MoneyTransfer::where(function($query2) use ($personId,$month,$year){
                                $query2->where('transferBy',$personId)
                               ->whereYear('transferredAt',$year)
                               ->whereMonth('transferredAt',$month->month);
                            })->sum('amount');
                    }else{
                        $transaction_count = MoneyTransfer::where(function($query2) use ($personId,$month,$year){
                                $query2->where('transferTo',$personId)
                               ->whereYear('transferredAt',$year)
                               ->whereMonth('transferredAt',$month->month);
                            })->sum('amount');
                    }

                    array_push($data, array(
                        // 'month_number' => $month->month,
                        'month' => $month->shortMonthName,
                        'year' => $year,
                        'transaction_count' => $transaction_count
                    ));
                }
                $res = [
                    'status' => 200,
                    'data' => $data
                ];
                // return $data;
                return response()->json($res,200);
            }


        }catch(\Exception $e){
            $res = [
                'status' => 400,
                'message' => $e->getMessage().' on line no '.$e->getLine().' in file '.$e->getFile(),
            ];
            return response()->json($res,400);
        }
    }

}
