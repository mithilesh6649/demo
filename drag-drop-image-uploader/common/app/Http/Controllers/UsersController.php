<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\ContactUs;
use App\Models\Order;
use App\Models\PaymentTransaction;
use App\Models\Review;
use App\Models\Role;
use App\Models\User;
use App\Models\UserLoyaltyPoint;
use App\Models\UserLoyaltyPointLog;
use App\Models\UserSocialLogin;
use Auth;
use DB;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function usersList()
    {

        if (Auth::user()->can("customer_management")) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $users = User::where('role_id', Role::where('role_type', 'customer')->value('id'))->orderBY('id', 'desc')->get();

            return view("users.users_list")->with(["users" => $users, 'status' => $status]);
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }
    public function viewUser($id)
    {
        if (Auth::user()->can("view_customer")) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $user = User::find($id);
            return view("users.view_user", compact("user", "status"));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function editUser($id)
    {
        if (Auth::user()->can("edit_customer")) {
            $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
            $user = User::find($id);
            return view("users.edit_user", compact("user", "status"));
        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    public function updateUser(Request $request)
    {

        $user = User::find($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->country = $request->country_code;
        $user->status = $request->status;
        // $user->dob = $dob;
        $user->is_user_locked = $request->is_user_locked;
        if ($request->password) {
            $user->password = \Hash::make($request->password);
        }

        if ($user->save()) {
            return redirect()
                ->route("users_list")
                ->with([
                    "success" =>
                    "Customer details has been updated successfully!",
                ]);
        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }
    }

    public function addUser()
    {
        $status = DB::table('md_dropdowns')->where('slug', 'status_data')->get();
        return view("users.add_user", compact('status'));
    }

    public function saveUser(Request $request)
    {

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->country = $request->country_code;
        $user->role_id = Role::where('role_type', 'customer')->value('id');
        $user->status = $request->status;
        $user->is_user_locked = $request->is_user_locked;
        $user->password = \Hash::make($request->password);

        if ($user->save()) {
            return redirect()
                ->route("users_list")
                ->with("success", "Customer has been added successfully!");
        } else {
            return redirect()
                ->back()
                ->with("warning", "Something went wrong!");
        }
    }

    public function checkUserEmail(Request $request)
    {
        $email = User::withTrashed()->where("email", $request->email)->get();
        if (count($email) > 0) {
            $res = 1;
            return response()->json(["msg" => $res]);
        } else {
            $res = 0;
            return response()->json(["msg" => $res]);
        }
    }

    public function checkUserPhoneNumber(Request $request)
    {

        $number = User::withTrashed()->where("phone_number", $request->number)->get();
        if (count($number) > 0) {
            $res = 1;
            return response()->json(["msg" => $res]);
        } else {
            $res = 0;
            return response()->json(["msg" => $res]);
        }

    }

    public function deleteUser(Request $request)
    {
        // $user = User::where('id', $request->id)->first();
        //         Order::where('user_id',$user_id)
        // dd($user->id);

        $user = User::where('id', $request->id)->each(function ($user) {

            // first child
            Order::where('user_id', $user->id)->each(function ($orders) {
                $orders->delete();
            });

            // second child
            PaymentTransaction::where('user_id', $user->id)->each(function ($PaymentTransaction) {
                $PaymentTransaction->delete();
            });

            // CartItem child
            CartItem::where('user_id', $user->id)->each(function ($CartItem) {
                $CartItem->delete();
            });

            // Review child
            Review::where('user_id', $user->id)->each(function ($Review) {
                $Review->delete();
            });

            // ContactUs child
            ContactUs::where('user_id', $user->id)->each(function ($ContactUs) {
                $ContactUs->delete();
            });

            // Address child
            Address::where('user_id', $user->id)->each(function ($Address) {
                $Address->delete();
            });

            // UserLoyaltyPointLog child
            UserLoyaltyPointLog::where('user_id', $user->id)->each(function ($UserLoyaltyPointLog) {
                $UserLoyaltyPointLog->delete();
            });

            // UserLoyaltyPoint child
            UserLoyaltyPoint::where('user_id', $user->id)->each(function ($UserLoyaltyPoint) {
                $UserLoyaltyPoint->delete();
            });

            // UserSocialLogin child
            UserSocialLogin::where('user_id', $user->id)->each(function ($UserSocialLogin) {
                $UserSocialLogin->delete();
            });

            //Final Parent Element
            $user->delete();

        });

        // $deleteUser = User::where("id", $request->id)->delete();
        if ($user) {
            $res["success"] = 1;
            return json_encode($res);
        } else {
            $res["success"] = 0;
            return json_encode($res);
        }
    }

    //deletedUsersList
    public function deletedUsersList()
    {
        if (Auth::user()->can("manage_recyle_customer_tab")) {

            $usersList = User::where("role_id", Role::where('role_type', 'customer')->value('id'))
                ->orderBY("id", "desc")
                ->onlyTrashed()
                ->get();

            return view("users/deleted_users_list", compact("usersList"));

        } else {
            return redirect()
                ->route("dashboard")
                ->with(
                    "warning",
                    "You do not have permission for this action!"
                );
        }
    }

    //Restore User
    public function restoreUser(Request $request)
    {

        $user = User::where('id', $request->id)->withTrashed()->each(function ($user) {

            // first child
            Order::where('user_id', $user->id)->withTrashed()->each(function ($orders) {
                $orders->restore();
            });

            // second child
            PaymentTransaction::where('user_id', $user->id)->withTrashed()->each(function ($PaymentTransaction) {
                $PaymentTransaction->restore();
            });

            // CartItem child
            CartItem::where('user_id', $user->id)->withTrashed()->each(function ($CartItem) {
                $CartItem->restore();
            });

            // Review child
            Review::where('user_id', $user->id)->withTrashed()->each(function ($Review) {
                $Review->restore();
            });

            // ContactUs child
            ContactUs::where('user_id', $user->id)->withTrashed()->each(function ($ContactUs) {
                $ContactUs->restore();
            });

            // Address child
            Address::where('user_id', $user->id)->withTrashed()->each(function ($Address) {
                $Address->restore();
            });

            // UserLoyaltyPointLog child
            UserLoyaltyPointLog::where('user_id', $user->id)->withTrashed()->each(function ($UserLoyaltyPointLog) {
                $UserLoyaltyPointLog->restore();
            });

            // UserLoyaltyPoint child
            UserLoyaltyPoint::where('user_id', $user->id)->withTrashed()->each(function ($UserLoyaltyPoint) {
                $UserLoyaltyPoint->restore();
            });

            // UserSocialLogin child
            UserSocialLogin::where('user_id', $user->id)->withTrashed()->each(function ($UserSocialLogin) {
                $UserSocialLogin->restore();
            });

            //Final Parent Element
            $user->restore();

        });

        // $usersList = User::withTrashed()
        //     ->find($request->id)
        //     ->restore();
        if ($user) {
            return "success";
        }
    }

    //Permanent Delete User
    public function permanentDeleteUser(Request $request)
    {
        // $usersList = User::onlyTrashed()
        //     ->find($request->id)
        //     ->forceDelete();
        // return "success";

        $user = User::where('id', $request->id)->onlyTrashed()->each(function ($user) {

            // first child
            Order::where('user_id', $user->id)->onlyTrashed()->each(function ($orders) {
                $orders->forceDelete();
            });

            // second child
            PaymentTransaction::where('user_id', $user->id)->onlyTrashed()->each(function ($PaymentTransaction) {
                $PaymentTransaction->forceDelete();
            });

            // CartItem child
            CartItem::where('user_id', $user->id)->onlyTrashed()->each(function ($CartItem) {
                $CartItem->forceDelete();
            });

            // Review child
            Review::where('user_id', $user->id)->onlyTrashed()->each(function ($Review) {
                $Review->forceDelete();
            });

            // ContactUs child
            ContactUs::where('user_id', $user->id)->onlyTrashed()->each(function ($ContactUs) {
                $ContactUs->forceDelete();
            });

            // Address child
            Address::where('user_id', $user->id)->onlyTrashed()->each(function ($Address) {
                $Address->forceDelete();
            });

            // UserLoyaltyPointLog child
            UserLoyaltyPointLog::where('user_id', $user->id)->onlyTrashed()->each(function ($UserLoyaltyPointLog) {
                $UserLoyaltyPointLog->forceDelete();
            });

            // UserLoyaltyPoint child
            UserLoyaltyPoint::where('user_id', $user->id)->onlyTrashed()->each(function ($UserLoyaltyPoint) {
                $UserLoyaltyPoint->forceDelete();
            });

            // UserSocialLogin child
            UserSocialLogin::where('user_id', $user->id)->onlyTrashed()->each(function ($UserSocialLogin) {
                $UserSocialLogin->forceDelete();
            });

            //Final Parent Element
            $user->forceDelete();

        });

        // $usersList = User::withTrashed()
        //     ->find($request->id)
        //     ->restore();
        if ($user) {
            return "success";
        }

    }
}
