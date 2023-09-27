<?php

namespace App\Http\Middleware;

use App\Http\Traits\AccountTrait;
use Illuminate\Http\Request;
use Closure;
use DB;

class VerifiedUser
{
    use AccountTrait;

    protected $status = 400;

    protected $data = [];

    protected $error = true;

    protected $success = false;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $username = ($request->has('email')) ? $request->email : $request->phone;

        // $user = \App\Models\User::select('users.email_verified', 'users.phone_verified', 'statuses.name', 'statuses.slug')
        $user = \App\Models\User::select('users.email_verified', 'users.phone_verified')
        ->when($request->has('email'), function ($qr) use ($username) {
            $qr->where('email', $username);
        })
        ->when($request->has('phone'), function ($qr) use ($username) {
            $qr->where('phone_number', $username);
        })
        // ->leftJoin('user_actions', 'user_actions.user_id', '=', 'users.id')
        // ->leftJoin('statuses', 'statuses.id', '=' , 'user_actions.status_id')
        ->first();
        
        if ($user != null) {

            if(request()->login_type == "email") {

                if (!$user->email_verified) {

                    $this->message = "Email not verified";
                }
            }
            
            if (!is_null($user->name)){
                
                $this->message = $this->getMessage($user->slug);

            } else {

                return $next($request);
            }

        } else {

            $this->success = false;
            $this->status = 401;
            $this->message = "User Not Found";
            $this->error = true;
        }

        return response()->json([
            'success' => $this->success,
            'status' => $this->status,
            'message' => $this->data,
            'error' => $this->error,
        ], $this->status);

        return $next($request);
    }
}
