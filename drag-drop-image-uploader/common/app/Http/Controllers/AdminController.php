<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\BannerImage;
use App\Models\Blog;
use App\Models\Branch;
use App\Models\BranchLocality;
use App\Models\Catring;
use App\Models\CheckoutOffer;
use App\Models\City;
use App\Models\CouponCode;
use App\Models\Discount;
use App\Models\HomePageOffer;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Theme;
use App\Models\Offer;
use App\Models\Order;
use App\Models\ContactUs;
use App\Models\Page;
use App\Models\Review;
use App\Models\Staff;
use App\Models\Role;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * This function is used to Show Admin Dashboard
     */
    public function dashboard(Request $request)
    {

        $website_content_count = Page::where('device_type', 'web')->count();
        $mobile_content_count = Page::where('device_type', 'mobile')->count();

        $admins = Admin::where('role_id', '!=', 1)->where('id', '!=', Auth::id())->get();

        $adminsCount = count($admins);

        $usersCount = User::where('role_id', Role::where('role_type', 'customer')->value('id'))->count();

        $managersCount = User::where('role_id', Role::where('role_type', 'manager')->value('id'))->count();
         
        $staffsCount = Staff::count(); 

        $branchesCount = Branch::count();

        $menucategoriesCount = MenuCategory::count();

        $menuitemCount = MenuItem::count();

        $orderCount = Order::count();
        
        $currentOffer = HomePageOffer::count();
        $checkoutOffer = CheckoutOffer::count();
        $discount = Discount::count();
        $couponCode = CouponCode::count();

        $blogsCount = Blog::count();

        $bannerCount = BannerImage::count();
        $themeCount = Theme::count();

        $reviewCount = Review::count();

        $contactUsCount = ContactUs::count();

        $offerCount = Offer::count();

        $cateringCount = Catring::count();

        return view('dashboard', [

            'adminsCount' => $adminsCount,
            'usersCount' => $usersCount,
            'adminsCount' => $adminsCount,
            'managersCount' => $managersCount,
            'staffsCount' => $staffsCount, 
            'branchesCount' => $branchesCount,
            'menucategoriesCount' => $menucategoriesCount,
            'menuitemCount' => $menuitemCount,
            'orderCount' => $orderCount,
            'blogsCount' => $blogsCount,
            'bannerCount' => $bannerCount,
            'themeCount'=>$themeCount,
            'reviewCount' => $reviewCount,
            'contactUsCount'=>$contactUsCount,
            'currentOffer'=>$currentOffer,
            'offerCount' => $offerCount,
            'cateringCount' => $cateringCount,
            'checkoutOffer' => $checkoutOffer,
            'discount' => $discount,
            'couponCode' => $couponCode,
            'website_content_count' => $website_content_count,
            'mobile_content_count' => $mobile_content_count,

        ]);
    }

    /**
     * This function is used to Show Admin Profile
     */
    public function adminProfile(Request $request)
    {
        $userDetails = Admin::findOrFail(Auth::id());
        return view('admin_profile')->with('userDetails', $userDetails);
    }

    /**
     * This function is used to Update Admin Profile
     */
    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required',
        ]);
        $updateProfile = Admin::where('id', $request->id)->update(['name' => $request->name]);
        if ($updateProfile) {
            return back()->with('success', 'Profile Updated Successfully!');
        } else {
            return back()->with('error', 'Something went wrong! Please try again later.');
        }
    }

    public function checkPassword(Request $request)
    {
        $passwordType = $request['password_type'];
        $admin = Admin::find(Auth::id());
        if ($passwordType == 'old') {
            if (Hash::check($request->password, $admin->password) == false) {
                return true;
            } else if (Hash::check($request->password, $admin->password) == true) {
                return false;
            }
        } else if ($passwordType == 'new') {
            if (Hash::check($request->password, $admin->password) == false) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * This function is used to Change Admin Password
     */
    public function changePassword(Request $request)
    {
        $changePassword = Admin::where('id', Auth::id())->update(['password' => Hash::make($request->password)]);
        if ($changePassword) {
            return back()->with('success', 'Password Updated Successfully!');
        } else {
            return back()->with('error', 'Something went wrong! Please try again later.');
        }
    }

    public function importMenu()
    {
        $cat_id = 0;
        if (($handle = fopen(public_path() . '/Menu.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                if (@$data[0]) {
                    if (@$data[1]) {
                        $menuItem = MenuItem::create([
                            'cat_id' => $cat_id,
                            'item_name_en' => @$data[0],
                            'item_name_ar' => @$data[1],
                            'price' => (float) str_replace('KWD', '', $data[2]),
                        ]);

                        MenuItem::addDefaultChoices($menuItem);

                    } else {
                        $category = MenuCategory::create([
                            'name_en' => @$data[0],
                        ]);
                    }
                    $cat_id = $category->id;
                }
            }
            fclose($handle);

            return 'Data imported Successfully';
        }
    }

    public function importCities()
    {
        // return 'hello';
        City::truncate();
        BranchLocality::truncate();

        if (($handle = fopen(public_path() . '/area.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {

                // echo 'City => '.$data[1].' Branch => '.$data[2].'<br/>';

                $city = City::create([
                    'city' => $data[1],
                ]);

                $branch_name = rtrim($data[2]);
                $branch_name = ltrim($branch_name);

                $branch = Branch::where('title_en', 'LIKE', '%' . $branch_name . '%')->first();
                if ($branch) {
                    BranchLocality::create([
                        'branch_id' => $branch->id,
                        'city_id' => $city->id,
                    ]);
                } else {
                    echo 'not found<br/>';
                    echo $branch_name;
                }

            }
            fclose($handle);

            return 'Branch Localities Imported Successfully';
        }
    }
}
