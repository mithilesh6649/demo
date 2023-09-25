<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

class AuthServiceProvider extends ServiceProvider {
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	*/
	protected $policies = [
		// 'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	*/
	public function boot() {

		$this->registerPolicies();

        // Start Apply Gates
Gate::define('manage_users_management', function ($user) {

$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_customer' ||
$permissions[$i]->slug == 'edit_customer' ||
$permissions[$i]->slug == 'delete_customer' ||
$permissions[$i]->slug == 'add_customer' ||
$permissions[$i]->slug == 'add_admin' ||
$permissions[$i]->slug == 'edit_admin' ||
$permissions[$i]->slug == 'view_admin' ||
$permissions[$i]->slug == 'delete_admin' ||
$permissions[$i]->slug == 'add_branch_manager' ||
$permissions[$i]->slug == 'delete_branch_manager' ||
$permissions[$i]->slug == 'edit_branch_manager' ||
$permissions[$i]->slug == 'view_branch_manager' ||
$permissions[$i]->slug == 'view_branch_staff' ||
$permissions[$i]->slug == 'edit_branch_staff' ||
$permissions[$i]->slug == 'delete_branch_staff' ||
$permissions[$i]->slug == 'add_branch_staff' ||
$permissions[$i]->slug == 'edit_management' ||
$permissions[$i]->slug == 'view_management'
) {
return true;
}
}
});


 //Customer Management
Gate::define('customer_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_customer' ||
$permissions[$i]->slug == 'edit_customer' ||
$permissions[$i]->slug == 'delete_customer' ||
$permissions[$i]->slug == 'add_customer'
) {
return true;
}
}
});

Gate::define('view_customer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_customer'
) {
return true;
}
}
});

Gate::define('edit_customer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_customer'
) {
return true;
}
}
});

Gate::define('delete_customer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_customer'
) {
return true;
}
}
});

Gate::define('add_customer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_customer'
) {
return true;
}
}
});

Gate::define('admins_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'add_admin' ||
$permissions[$i]->slug == 'edit_admin' ||
$permissions[$i]->slug == 'view_admin' ||
$permissions[$i]->slug == 'delete_admin'
) {
return true;
}
}
});

Gate::define('add_admin', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_admin'
) {
return true;
}
}
});

Gate::define('edit_admin', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_admin'
) {
return true;
}
}
});

Gate::define('view_admin', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_admin'
) {
return true;
}
}
});

Gate::define('delete_admin', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_admin'
) {
return true;
}
}
});



//Managements.............


Gate::define('managements_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_management' ||
$permissions[$i]->slug == 'view_management'
) {
return true;
}
}
});



Gate::define('edit_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_management'
) {
return true;
}
}
});

Gate::define('view_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_management'
) {
return true;
}
}
});




 //Branch Staff Management


Gate::define('branch_staff_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'view_branch_staff' ||
$permissions[$i]->slug == 'edit_branch_staff' ||
$permissions[$i]->slug == 'delete_branch_staff' ||
$permissions[$i]->slug == 'add_branch_staff'
) {
return true;
}
}
});

Gate::define('add_branch_staff', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_branch_staff'
) {
return true;
}
}
});

Gate::define('edit_branch_staff', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_branch_staff'
) {
return true;
}
}
});

Gate::define('view_branch_staff', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_branch_staff'
) {
return true;
}
}
});

Gate::define('delete_branch_staff', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_branch_staff'
) {
return true;
}
}
});


//Branch Manager Management

Gate::define('branch_managers_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_branch_manager' ||
$permissions[$i]->slug == 'edit_branch_manager' ||
$permissions[$i]->slug == 'delete_branch_manager' ||
$permissions[$i]->slug == 'add_branch_manager'
) {
return true;
}
}
});

Gate::define('view_branch_manager', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_branch_manager'
) {
return true;
}
}
});

Gate::define('edit_branch_manager', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_branch_manager'
) {
return true;
}
}
});

Gate::define('delete_branch_manager', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_branch_manager'
) {
return true;
}
}
});

Gate::define('add_branch_manager', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_branch_manager'
) {
return true;
}
}
});

//Branch Management


Gate::define('manage_branch_management', function ($user) {

$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'view_branch' ||
$permissions[$i]->slug == 'edit_branch' ||
$permissions[$i]->slug == 'delete_branch' ||
$permissions[$i]->slug == 'add_branch' ||
$permissions[$i]->slug == 'add_staff'||
$permissions[$i]->slug == 'edit_staff'||
$permissions[$i]->slug == 'view_branch_locality' ||
$permissions[$i]->slug == 'edit_branch_locality' ||
$permissions[$i]->slug == 'add_branch_locality'

) {
return true;
}
}
});



Gate::define('branch_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_branch' ||
$permissions[$i]->slug == 'edit_branch' ||
$permissions[$i]->slug == 'delete_branch' ||
$permissions[$i]->slug == 'add_branch' ||
$permissions[$i]->slug == 'add_staff'||
$permissions[$i]->slug == 'edit_staff'
) {
return true;
}
}
});

Gate::define('view_branch', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_branch'
) {
return true;
}
}
});

Gate::define('edit_branch', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_branch'
) {
return true;
}
}
});

Gate::define('delete_branch', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_branch'
) {
return true;
}
}
});

Gate::define('add_branch', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_branch'
) {
return true;
}
}
});

Gate::define('add_staff', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_staff'
) {
return true;
}
}
});

Gate::define('edit_staff', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_staff'
) {
return true;
}
}
});

//Locality Management

Gate::define('branch_locality_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_branch_locality' ||
$permissions[$i]->slug == 'edit_branch_locality' ||
$permissions[$i]->slug == 'add_branch_locality'
) {
return true;
}
}
});

Gate::define('view_branch_locality', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_branch_locality'
) {
return true;
}
}
});


Gate::define('edit_branch_locality', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_branch_locality'
) {
return true;
}
}
});


Gate::define('add_branch_locality', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_branch_locality'
) {
return true;
}
}
});

//Menu Management
Gate::define('manage_menu_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_category' ||
$permissions[$i]->slug == 'edit_category' ||
$permissions[$i]->slug == 'delete_category' ||
$permissions[$i]->slug == 'add_category' ||
$permissions[$i]->slug == 'view_item' ||
$permissions[$i]->slug == 'edit_item' ||
$permissions[$i]->slug == 'delete_item' ||
$permissions[$i]->slug == 'add_item' ||
$permissions[$i]->slug == 'view_item_availability' ||
$permissions[$i]->slug == 'edit_item_availability'


) {
return true;
}
}
});

//Category Tab

Gate::define('category_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_category' ||
$permissions[$i]->slug == 'edit_category' ||
$permissions[$i]->slug == 'delete_category' ||
$permissions[$i]->slug == 'add_category'
) {
return true;
}
}
});

Gate::define('view_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_category'
) {
return true;
}
}
});


Gate::define('edit_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_category'
) {
return true;
}
}
});


Gate::define('delete_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_category'
) {
return true;
}
}
});


Gate::define('add_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_category'
) {
return true;
}
}
});


 //Menu Item Tab

Gate::define('menuitem_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_item' ||
$permissions[$i]->slug == 'edit_item' ||
$permissions[$i]->slug == 'delete_item' ||
$permissions[$i]->slug == 'add_item'

) {
return true;
}
}
});


Gate::define('view_item', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_item'
) {
return true;
}
}
});


Gate::define('edit_item', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_item'
) {
return true;
}
}
});


Gate::define('delete_item', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_item'
) {
return true;
}
}
});


Gate::define('add_item', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_item'
) {
return true;
}
}
});

 //Item Availability

Gate::define('menuitem_availability_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_item_availability' ||
$permissions[$i]->slug == 'edit_item_availability'

) {
return true;
}
}
});

Gate::define('view_item_availability', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_item_availability'
) {
return true;
}
}
});


Gate::define('edit_item_availability', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_item_availability'
) {
return true;
}
}
});

//Order Management

Gate::define('order_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_order' ||
$permissions[$i]->slug == 'edit_order'

) {
return true;
}
}
});

Gate::define('view_order', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_order'
) {
return true;
}
}
});

Gate::define('edit_order', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_order'
) {
return true;
}
}
});

//Dine and Catering management
Gate::define('catering_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_catering' ||
$permissions[$i]->slug == 'view_catering' ||
$permissions[$i]->slug == 'delete_catering'
) {
return true;
}
}
});

Gate::define('edit_catering', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_catering'
) {
return true;
}
}
});

Gate::define('view_catering', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_catering'
) {
return true;
}
}
});

Gate::define('delete_catering', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_catering'
) {
return true;
}
}
});

  //Content Management


//Website Page Content  management


Gate::define('website_page_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_website_content' ||
$permissions[$i]->slug == 'edit_website_content' ||
$permissions[$i]->slug == 'add_banner' ||
$permissions[$i]->slug == 'edit_banner' ||
$permissions[$i]->slug == 'view_banner' ||
$permissions[$i]->slug == 'delete_banner'||


$permissions[$i]->slug == 'view_media'||
$permissions[$i]->slug == 'edit_media'||
$permissions[$i]->slug == 'view_theme'||
$permissions[$i]->slug == 'edit_theme'||
$permissions[$i]->slug == 'view_social_link'||
$permissions[$i]->slug == 'edit_social_link'||
$permissions[$i]->slug == 'delete_social_link'||
$permissions[$i]->slug == 'add_social_link'


) {
return true;
}
}
});

Gate::define('website_content_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_website_content' ||
$permissions[$i]->slug == 'view_website_content'
) {
return true;
}
}
});

Gate::define('edit_website_content', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_website_content'
) {
return true;
}
}
});

Gate::define('view_website_content', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_website_content'
) {
return true;
}
}
});

//Banner management


Gate::define('banners_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'add_banner' ||
$permissions[$i]->slug == 'edit_banner' ||
$permissions[$i]->slug == 'view_banner' ||
$permissions[$i]->slug == 'delete_banner'
) {
return true;
}
}
});

Gate::define('add_banner', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_banner'
) {
return true;
}
}
});

Gate::define('edit_banner', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_banner'
) {
return true;
}
}
});

Gate::define('view_banner', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_banner'
) {
return true;
}
}
});

Gate::define('delete_banner', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_banner'
) {
return true;
}
}
});



 //Media Management

Gate::define('media_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_media' ||
$permissions[$i]->slug == 'view_media'
) {
return true;
}
}
});

Gate::define('edit_media', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_media'
) {
return true;
}
}
});

Gate::define('view_media', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_media'
) {
return true;
}
}
});




 //Theme Management

Gate::define('theme_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_theme' ||
$permissions[$i]->slug == 'view_theme'
) {
return true;
}
}
});

Gate::define('edit_theme', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_theme'
) {
return true;
}
}
});

Gate::define('view_theme', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_theme'
) {
return true;
}
}
});




 //Social Links Managements

Gate::define('social_links_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_social_link'||
$permissions[$i]->slug == 'edit_social_link'||
$permissions[$i]->slug == 'delete_social_link'||
$permissions[$i]->slug == 'add_social_link'
) {
return true;
}
}
});

Gate::define('view_social_link', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_social_link'
) {
return true;
}
}
});

Gate::define('edit_social_link', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_social_link'
) {
return true;
}
}
});

Gate::define('delete_social_link', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_social_link'
) {
return true;
}
}
});

Gate::define('add_social_link', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_social_link'
) {
return true;
}
}
});







Gate::define('manage_contact_us_review_action', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_contact_us' ||
$permissions[$i]->slug == 'edit_contact_us' ||
$permissions[$i]->slug == 'reply_contact_us'||
$permissions[$i]->slug == 'add_review' ||
$permissions[$i]->slug == 'edit_review' ||
$permissions[$i]->slug == 'view_review' ||
$permissions[$i]->slug == 'delete_review'

) {
return true;
}
}
});


//Contact Us management
Gate::define('contact_us_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_contact_us' ||
$permissions[$i]->slug == 'edit_contact_us' ||
$permissions[$i]->slug == 'reply_contact_us'
) {
return true;
}
}
});

Gate::define('view_contact_us', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_contact_us'
) {
return true;
}
}
});

Gate::define('edit_contact_us', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_contact_us'
) {
return true;
}
}
});

Gate::define('reply_contact_us', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'reply_contact_us'
) {
return true;
}
}
});

//Join us management
Gate::define('joinus_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'view_joinus' ||
$permissions[$i]->slug == 'reply_joinus' ||
$permissions[$i]->slug == 'edit_joinus' ||
$permissions[$i]->slug == 'delete_joinus'
) {
return true;
}
}
});

Gate::define('view_joinus', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_joinus'
) {
return true;
}
}
});


Gate::define('reply_joinus', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'reply_joinus'
) {
return true;
}
}
});



Gate::define('edit_joinus', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_joinus'
) {
return true;
}
}
});



Gate::define('delete_joinus', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_joinus'
) {
return true;
}
}
});

//Review management
Gate::define('reviews_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'add_review' ||
$permissions[$i]->slug == 'edit_review' ||
$permissions[$i]->slug == 'view_review' ||
$permissions[$i]->slug == 'delete_review'
) {
return true;
}
}
});

Gate::define('add_review', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_review'
) {
return true;
}
}
});

Gate::define('edit_review', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_review'
) {
return true;
}
}
});

Gate::define('view_review', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_review'
) {
return true;
}
}
});

Gate::define('delete_review', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_review'
) {
return true;
}
}
});

 //Misc Data Management

 Gate::define('misc_data_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_brand' ||
$permissions[$i]->slug == 'edit_brand' ||
$permissions[$i]->slug == 'delete_brand' ||
$permissions[$i]->slug == 'add_brand'||


$permissions[$i]->slug == 'view_subsidiaries' ||
$permissions[$i]->slug == 'edit_subsidiaries' ||
$permissions[$i]->slug == 'delete_subsidiaries' ||
$permissions[$i]->slug == 'add_subsidiaries'||

$permissions[$i]->slug == 'view_blocks' ||
$permissions[$i]->slug == 'edit_blocks' ||
$permissions[$i]->slug == 'delete_blocks' ||
$permissions[$i]->slug == 'add_blocks'||



$permissions[$i]->slug == 'view_city' ||
$permissions[$i]->slug == 'edit_city' ||
$permissions[$i]->slug == 'delete_city' ||
$permissions[$i]->slug == 'add_city'||
$permissions[$i]->slug == 'view_question' ||
$permissions[$i]->slug == 'edit_question' ||
$permissions[$i]->slug == 'delete_question' ||
$permissions[$i]->slug == 'add_question'||
$permissions[$i]->slug == 'view_designations' ||
$permissions[$i]->slug == 'edit_designations' ||
$permissions[$i]->slug == 'delete_designations' ||
$permissions[$i]->slug == 'add_designations'||
$permissions[$i]->slug == 'view_petty_exp_category'||
$permissions[$i]->slug == 'edit_petty_exp_category'||
$permissions[$i]->slug == 'delete_petty_exp_category'||
$permissions[$i]->slug == 'add_petty_exp_category'||
$permissions[$i]->slug == 'view_petty_exp_sub_category'||
$permissions[$i]->slug == 'edit_petty_exp_sub_category'||
$permissions[$i]->slug == 'delete_petty_exp_sub_category'||
$permissions[$i]->slug == 'add_petty_exp_sub_category'||
$permissions[$i]->slug == 'view_maintenance_category'||
$permissions[$i]->slug == 'edit_maintenance_category'||
$permissions[$i]->slug == 'delete_maintenance_category'||
$permissions[$i]->slug == 'add_maintenance_category'||
$permissions[$i]->slug == 'view_maintenance_sub_category'||
$permissions[$i]->slug == 'edit_maintenance_sub_category'||
$permissions[$i]->slug == 'delete_maintenance_sub_category'||
$permissions[$i]->slug == 'add_maintenance_sub_category'||
$permissions[$i]->slug == 'view_ownership'||
$permissions[$i]->slug == 'edit_ownership'||
$permissions[$i]->slug == 'delete_ownership'||
$permissions[$i]->slug == 'add_ownership'||
$permissions[$i]->slug == 'view_driver'||
$permissions[$i]->slug == 'edit_driver'||
$permissions[$i]->slug == 'delete_driver'||
$permissions[$i]->slug == 'add_driver'||
$permissions[$i]->slug == 'view_car'||
$permissions[$i]->slug == 'edit_car'||
$permissions[$i]->slug == 'delete_car'||
$permissions[$i]->slug == 'add_car'




) {
return true;
}
}
});



//Brands management


Gate::define('brands_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'view_brand' ||
$permissions[$i]->slug == 'edit_brand' ||
$permissions[$i]->slug == 'delete_brand' ||
$permissions[$i]->slug == 'add_brand'
) {
return true;
}
}
});



Gate::define('view_brand', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_brand'
) {
return true;
}
}
});


Gate::define('edit_brand', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_brand'
) {
return true;
}
}
});



Gate::define('delete_brand', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_brand'
) {
return true;
}
}
});



Gate::define('add_brand', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_brand'
) {
return true;
}
}
});





//Subsidiaries management


Gate::define('subsidiaries_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'view_subsidiaries' ||
$permissions[$i]->slug == 'edit_subsidiaries' ||
$permissions[$i]->slug == 'delete_subsidiaries' ||
$permissions[$i]->slug == 'add_subsidiaries'
) {
return true;
}
}
});



Gate::define('view_subsidiaries', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_subsidiaries'
) {
return true;
}
}
});


Gate::define('edit_subsidiaries', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_subsidiaries'
) {
return true;
}
}
});



Gate::define('delete_subsidiaries', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_subsidiaries'
) {
return true;
}
}
});



Gate::define('add_subsidiaries', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_subsidiaries'
) {
return true;
}
}
});




//Blocks management


Gate::define('blocks_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'view_blocks' ||
$permissions[$i]->slug == 'edit_blocks' ||
$permissions[$i]->slug == 'delete_blocks' ||
$permissions[$i]->slug == 'add_blocks'
) {
return true;
}
}
});



Gate::define('view_blocks', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_blocks'
) {
return true;
}
}
});


Gate::define('edit_blocks', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_blocks'
) {
return true;
}
}
});



Gate::define('delete_blocks', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_blocks'
) {
return true;
}
}
});



Gate::define('add_blocks', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_blocks'
) {
return true;
}
}
});









//Cities management


Gate::define('cities_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'view_city' ||
$permissions[$i]->slug == 'edit_city' ||
$permissions[$i]->slug == 'delete_city' ||
$permissions[$i]->slug == 'add_city'
) {
return true;
}
}
});



Gate::define('view_city', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_city'
) {
return true;
}
}
});


Gate::define('edit_city', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_city'
) {
return true;
}
}
});



Gate::define('delete_city', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_city'
) {
return true;
}
}
});



Gate::define('add_city', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_city'
) {
return true;
}
}
});



//Security Questions
Gate::define('security_questions_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_question' ||
$permissions[$i]->slug == 'edit_question' ||
$permissions[$i]->slug == 'delete_question' ||
$permissions[$i]->slug == 'add_question'
) {
return true;
}
}
});



Gate::define('view_question', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_question'
) {
return true;
}
}
});


Gate::define('edit_question', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_question'
) {
return true;
}
}
});



Gate::define('delete_question', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_question'
) {
return true;
}
}
});



Gate::define('add_question', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_question'
) {
return true;
}
}
});



//Designations



Gate::define('staff_designations_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_designations' ||
$permissions[$i]->slug == 'edit_designations' ||
$permissions[$i]->slug == 'delete_designations' ||
$permissions[$i]->slug == 'add_designations'
) {
return true;
}
}
});



Gate::define('view_designations', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_designations'
) {
return true;
}
}
});


Gate::define('edit_designations', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_designations'
) {
return true;
}
}
});



Gate::define('delete_designations', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_designations'
) {
return true;
}
}
});



Gate::define('add_designations', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_designations'
) {
return true;
}
}
});




//Daily  Petty Expense main tab
Gate::define('daily_petty_expenses_main_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_petty_exp_category'||
$permissions[$i]->slug == 'edit_petty_exp_category'||
$permissions[$i]->slug == 'delete_petty_exp_category'||
$permissions[$i]->slug == 'add_petty_exp_category'||
$permissions[$i]->slug == 'view_petty_exp_sub_category'||
$permissions[$i]->slug == 'edit_petty_exp_sub_category'||
$permissions[$i]->slug == 'delete_petty_exp_sub_category'||
$permissions[$i]->slug == 'add_petty_exp_sub_category'


) {
return true;
}
}
});



//Daily Petty Expense Category

  Gate::define('petty_exp_category_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_petty_exp_category'||
$permissions[$i]->slug == 'edit_petty_exp_category'||
$permissions[$i]->slug == 'delete_petty_exp_category'||
$permissions[$i]->slug == 'add_petty_exp_category'
) {
return true;
}
}
});



Gate::define('view_petty_exp_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_petty_exp_category'
) {
return true;
}
}
});


Gate::define('edit_petty_exp_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_petty_exp_category'
) {
return true;
}
}
});



Gate::define('delete_petty_exp_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_petty_exp_category'
) {
return true;
}
}
});



Gate::define('add_petty_exp_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_petty_exp_category'
) {
return true;
}
}
});

//Daily Petty Expense Sub Category

Gate::define('petty_exp_sub_category_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_petty_exp_sub_category'||
$permissions[$i]->slug == 'edit_petty_exp_sub_category'||
$permissions[$i]->slug == 'delete_petty_exp_sub_category'||
$permissions[$i]->slug == 'add_petty_exp_sub_category'
) {
return true;
}
}
});



Gate::define('view_petty_exp_sub_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_petty_exp_sub_category'
) {
return true;
}
}
});


Gate::define('edit_petty_exp_sub_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_petty_exp_sub_category'
) {
return true;
}
}
});



Gate::define('delete_petty_exp_sub_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_petty_exp_sub_category'
) {
return true;
}
}
});



Gate::define('add_petty_exp_sub_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_petty_exp_sub_category'
) {
return true;
}
}
});



  //Maintenance Report.............................



 //Maintenance main tab
Gate::define('maintenance_report_main_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_maintenance_category'||
$permissions[$i]->slug == 'edit_maintenance_category'||
$permissions[$i]->slug == 'delete_maintenance_category'||
$permissions[$i]->slug == 'add_maintenance_category'||
$permissions[$i]->slug == 'view_maintenance_sub_category'||
$permissions[$i]->slug == 'edit_maintenance_sub_category'||
$permissions[$i]->slug == 'delete_maintenance_sub_category'||
$permissions[$i]->slug == 'add_maintenance_sub_category'

) {
return true;
}
}
});



//Daily Petty Expense Category

  Gate::define('maintenance_report_category_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_maintenance_category'||
$permissions[$i]->slug == 'edit_maintenance_category'||
$permissions[$i]->slug == 'delete_maintenance_category'||
$permissions[$i]->slug == 'add_maintenance_category'
) {
return true;
}
}
});



Gate::define('view_maintenance_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_maintenance_category'
) {
return true;
}
}
});


Gate::define('edit_maintenance_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_maintenance_category'
) {
return true;
}
}
});



Gate::define('delete_maintenance_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_maintenance_category'
) {
return true;
}
}
});



Gate::define('add_maintenance_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_maintenance_category'
) {
return true;
}
}
});

//Daily Petty Expense Sub Category

Gate::define('maintenance_report_sub_category_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_maintenance_sub_category'||
$permissions[$i]->slug == 'edit_maintenance_sub_category'||
$permissions[$i]->slug == 'delete_maintenance_sub_category'||
$permissions[$i]->slug == 'add_maintenance_sub_category'
) {
return true;
}
}
});



Gate::define('view_maintenance_sub_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_maintenance_sub_category'
) {
return true;
}
}
});


Gate::define('edit_maintenance_sub_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_maintenance_sub_category'
) {
return true;
}
}
});



Gate::define('delete_maintenance_sub_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_maintenance_sub_category'
) {
return true;
}
}
});



Gate::define('add_maintenance_sub_category', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_maintenance_sub_category'
) {
return true;
}
}
});




// ---------------------------



  //Vehicle management.............................



 //Maintenance main tab
Gate::define('vechicle_main_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_ownership'||
$permissions[$i]->slug == 'edit_ownership'||
$permissions[$i]->slug == 'delete_ownership'||
$permissions[$i]->slug == 'add_ownership'||
$permissions[$i]->slug == 'view_driver'||
$permissions[$i]->slug == 'edit_driver'||
$permissions[$i]->slug == 'delete_driver'||
$permissions[$i]->slug == 'add_driver'||
$permissions[$i]->slug == 'view_car'||
$permissions[$i]->slug == 'edit_car'||
$permissions[$i]->slug == 'delete_car'||
$permissions[$i]->slug == 'add_car'

) {
return true;
}
}
});



//Daily Petty Expense Category

  Gate::define('ownership_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_ownership'||
$permissions[$i]->slug == 'edit_ownership'||
$permissions[$i]->slug == 'delete_ownership'||
$permissions[$i]->slug == 'add_ownership'
) {
return true;
}
}
});



Gate::define('view_ownership', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_ownership'
) {
return true;
}
}
});


Gate::define('edit_ownership', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_ownership'
) {
return true;
}
}
});



Gate::define('delete_ownership', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_ownership'
) {
return true;
}
}
});



Gate::define('add_ownership', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_ownership'
) {
return true;
}
}
});

//Daily Petty Expense Sub Category

Gate::define('drivers_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_driver'||
$permissions[$i]->slug == 'edit_driver'||
$permissions[$i]->slug == 'delete_driver'||
$permissions[$i]->slug == 'add_driver'
) {
return true;
}
}
});



Gate::define('view_driver', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_driver'
) {
return true;
}
}
});


Gate::define('edit_driver', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_driver'
) {
return true;
}
}
});



Gate::define('delete_driver', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_driver'
) {
return true;
}
}
});



Gate::define('add_driver', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_driver'
) {
return true;
}
}
});




Gate::define('cars_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_car'||
$permissions[$i]->slug == 'edit_car'||
$permissions[$i]->slug == 'delete_car'||
$permissions[$i]->slug == 'add_car'
) {
return true;
}
}
});



Gate::define('view_car', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_car'
) {
return true;
}
}
});


Gate::define('edit_car', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_car'
) {
return true;
}
}
});



Gate::define('delete_car', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_car'
) {
return true;
}
}
});



Gate::define('add_car', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_car'
) {
return true;
}
}
});



//Blogs management


Gate::define('blogs_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'add_blog' ||
$permissions[$i]->slug == 'edit_blog' ||
$permissions[$i]->slug == 'view_blog' ||
$permissions[$i]->slug == 'delete_blog'
) {
return true;
}
}
});



Gate::define('add_blog', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_blog'
) {
return true;
}
}
});


Gate::define('edit_blog', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_blog'
) {
return true;
}
}
});



Gate::define('view_blog', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_blog'
) {
return true;
}
}
});



Gate::define('delete_blog', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_blog'
) {
return true;
}
}
});




//Offers management


Gate::define('offers_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

 $permissions[$i]->slug == 'add_current_offer' ||
$permissions[$i]->slug == 'edit_current_offer' ||
$permissions[$i]->slug == 'view_current_offer' ||
$permissions[$i]->slug == 'delete_current_offer' ||


$permissions[$i]->slug == 'add_checkout_offer' ||
$permissions[$i]->slug == 'edit_checkout_offer' ||
$permissions[$i]->slug == 'view_checkout_offer' ||
$permissions[$i]->slug == 'delete_checkout_offer' ||


$permissions[$i]->slug == 'add_discount_offer' ||
$permissions[$i]->slug == 'edit_discount_offer' ||
$permissions[$i]->slug == 'view_discount_offer' ||
$permissions[$i]->slug == 'delete_discount_offer' ||

$permissions[$i]->slug == 'add_coupon_offer' ||
$permissions[$i]->slug == 'edit_coupon_offer' ||
$permissions[$i]->slug == 'view_coupon_offer' ||
$permissions[$i]->slug == 'delete_coupon_offer' ||

$permissions[$i]->slug == 'view_gift_card' ||
$permissions[$i]->slug == 'delete_gift_card' ||
$permissions[$i]->slug == 'add_gift_card' ||

$permissions[$i]->slug == 'view_loyalty'||
$permissions[$i]->slug == 'edit_loyalty'
) {
return true;
}
}
});




//Checkout Offer



Gate::define('current_offer_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'add_current_offer' ||
$permissions[$i]->slug == 'edit_current_offer' ||
$permissions[$i]->slug == 'view_current_offer' ||
$permissions[$i]->slug == 'delete_current_offer'
) {
return true;
}
}
});


Gate::define('add_current_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_current_offer'
) {
return true;
}
}
});


Gate::define('edit_current_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_current_offer'
) {
return true;
}
}
});



Gate::define('view_current_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_current_offer'
) {
return true;
}
}
});



Gate::define('delete_current_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_current_offer'
) {
return true;
}
}
});










//Checkout Offer



Gate::define('checkout_offer_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if($permissions[$i]->slug == 'add_checkout_offer' ||
$permissions[$i]->slug == 'edit_checkout_offer' ||
$permissions[$i]->slug == 'view_checkout_offer' ||
$permissions[$i]->slug == 'delete_checkout_offer'
) {
return true;
}
}
});


Gate::define('add_checkout_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_checkout_offer'
) {
return true;
}
}
});


Gate::define('edit_checkout_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_checkout_offer'
) {
return true;
}
}
});



Gate::define('view_checkout_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_checkout_offer'
) {
return true;
}
}
});



Gate::define('delete_checkout_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_checkout_offer'
) {
return true;
}
}
});


//Discount Offer

Gate::define('discount_offers_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'add_discount_offer' ||
$permissions[$i]->slug == 'edit_discount_offer' ||
$permissions[$i]->slug == 'view_discount_offer' ||
$permissions[$i]->slug == 'delete_discount_offer'
) {
return true;
}
}
});



Gate::define('add_discount_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_discount_offer'
) {
return true;
}
}
});


Gate::define('edit_discount_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_discount_offer'
) {
return true;
}
}
});



Gate::define('view_discount_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_discount_offer'
) {
return true;
}
}
});



Gate::define('delete_discount_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_discount_offer'
) {
return true;
}
}
});



//Coupon Code offer


Gate::define('coupon_code_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_coupon_offer' ||
$permissions[$i]->slug == 'edit_coupon_offer' ||
$permissions[$i]->slug == 'view_coupon_offer' ||
$permissions[$i]->slug == 'delete_coupon_offer'
) {
return true;
}
}
});



Gate::define('add_coupon_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_coupon_offer'
) {
return true;
}
}
});


Gate::define('edit_coupon_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_coupon_offer'
) {
return true;
}
}
});



Gate::define('view_coupon_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_coupon_offer'
) {
return true;
}
}
});



Gate::define('delete_coupon_offer', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_coupon_offer'
) {
return true;
}
}
});






//Gift  Cards


Gate::define('gift_cards_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_gift_card' ||
$permissions[$i]->slug == 'delete_gift_card' ||
$permissions[$i]->slug == 'add_gift_card' ||
$permissions[$i]->slug == 'edit_gift_card'
) {
return true;
}
}
});



Gate::define('view_gift_card', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_gift_card'
) {
return true;
}
}
});


Gate::define('delete_gift_card', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_gift_card'
) {
return true;
}
}
});



Gate::define('add_gift_card', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'add_gift_card'
) {
return true;
}
}
});

Gate::define('edit_gift_card', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_gift_card'
) {
return true;
}
}
});




//Loyalties management


Gate::define('loyalites_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_loyalty' ||
$permissions[$i]->slug == 'view_loyalty'
) {
return true;
}
}
});





Gate::define('edit_loyalty', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_loyalty'
) {
return true;
}
}
});



Gate::define('view_loyalty', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_loyalty'
) {
return true;
}
}
});





//Payments management


Gate::define('payment_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_payment_transaction'
) {
return true;
}
}
});







Gate::define('view_payment_transaction', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_payment_transaction'
) {
return true;
}
}
});





Gate::define('report_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_report'
) {
return true;
}
}
});







Gate::define('view_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_report'
) {
return true;
}
}
});



//Start Report Management

// For Main Tab Advanced Reports

Gate::define('advanced_reports_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_cash_deposite_branch_wise_report' ||
$permissions[$i]->slug == 'download_cash_deposite_branch_wise_report' ||
$permissions[$i]->slug == 'view_daily_sales_report' ||
$permissions[$i]->slug == 'download_daily_sales_report' ||
$permissions[$i]->slug == 'edit_daily_sales_report' ||
$permissions[$i]->slug == 'delete_daily_sales_report' ||
$permissions[$i]->slug == 'view_payment_methods_branch_wise_report' ||
$permissions[$i]->slug == 'download_payment_methods_branch_wise_report' ||
$permissions[$i]->slug == 'view_sales_by_branch_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_report' ||
$permissions[$i]->slug == 'view_sales_by_branch_net_sale_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_net_sale_report' ||

$permissions[$i]->slug == 'view_sales_by_branch_gross_sale_monthly_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_gross_sale_monthly_report' ||
$permissions[$i]->slug == 'view_sales_by_branch_net_sale_monthly_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_net_sale_monthly_report' ||

$permissions[$i]->slug == 'view_sales_by_branch_discount_sale_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_discount_sale_report' ||

$permissions[$i]->slug == 'view_discount_complimentary_return_report' ||
$permissions[$i]->slug == 'download_discount_complimentary_return_report' ||



$permissions[$i]->slug == 'view_sales_by_month_report' ||
$permissions[$i]->slug == 'download_sales_by_month_report' ||
$permissions[$i]->slug == 'view_sales_by_service_report' ||
$permissions[$i]->slug == 'download_sales_by_service_report' ||
$permissions[$i]->slug == 'view_sales_by_complimentary_report' ||
$permissions[$i]->slug == 'download_sales_by_complimentary_report' ||
$permissions[$i]->slug == 'view_branch_petty_cash_report' ||
$permissions[$i]->slug == 'edit_branch_petty_cash_report' ||
$permissions[$i]->slug == 'delete_branch_petty_cash_report' ||
$permissions[$i]->slug == 'download_branch_petty_cash_report' ||
$permissions[$i]->slug == 'view_petty_cash_by_branch_report' ||
$permissions[$i]->slug == 'download_petty_cash_by_branch_report' ||
$permissions[$i]->slug == 'view_petty_cash_by_month_report' ||
$permissions[$i]->slug == 'download_petty_cash_by_month_report' ||
$permissions[$i]->slug == 'view_sales_petty_report' ||
$permissions[$i]->slug == 'delete_sales_petty_report' ||
$permissions[$i]->slug == 'download_sales_petty_report' ||
$permissions[$i]->slug == 'edit_sales_petty_report' ||
$permissions[$i]->slug == 'add_received_amount_sales_petty_report' ||
$permissions[$i]->slug == 'edit_received_amount_sales_petty_report' ||
$permissions[$i]->slug == 'view_car_wise_fule_report_report' ||
$permissions[$i]->slug == 'download_car_wise_fule_report_report' ||
$permissions[$i]->slug == 'view_credit_card_report' ||
$permissions[$i]->slug == 'download_credit_card_report' ||
$permissions[$i]->slug == 'view_sales_report' ||
$permissions[$i]->slug == 'download_sales_report'||
$permissions[$i]->slug == 'view_credit_card_report_by_month_report' ||
$permissions[$i]->slug == 'download_credit_card_report_by_month_report'||
$permissions[$i]->slug == 'view_maintenance_report'||
$permissions[$i]->slug == 'download_maintenance_report'||
$permissions[$i]->slug == 'edit_maintenance_report'||
$permissions[$i]->slug == 'delete_maintenance_report'||

$permissions[$i]->slug == 'view_tip_report'||
$permissions[$i]->slug == 'edit_tip_report'||
$permissions[$i]->slug == 'delete_tip_report'||


$permissions[$i]->slug == 'view_gift_card_report'||
$permissions[$i]->slug == 'delete_gift_card_report'  ||
$permissions[$i]->slug == 'edit_gift_card_report'  ||
$permissions[$i]->slug == 'download_gift_card_report'  ||
$permissions[$i]->slug == 'download_gift_cards_all_branch_report'  ||
$permissions[$i]->slug == 'view_gift_cards_all_branch_report'

) {
return true;
}
}
});


//For Sales Report tab

Gate::define('sales_reports_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_cash_deposite_branch_wise_report' ||
$permissions[$i]->slug == 'download_cash_deposite_branch_wise_report' ||
$permissions[$i]->slug == 'view_daily_sales_report' ||
$permissions[$i]->slug == 'download_daily_sales_report' ||
$permissions[$i]->slug == 'view_payment_methods_branch_wise_report' ||
$permissions[$i]->slug == 'download_payment_methods_branch_wise_report' ||
$permissions[$i]->slug == 'view_sales_by_branch_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_report' ||

$permissions[$i]->slug == 'view_sales_by_branch_net_sale_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_net_sale_report' ||
$permissions[$i]->slug == 'view_sales_by_branch_discount_sale_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_discount_sale_report' ||


$permissions[$i]->slug == 'view_discount_complimentary_return_report' ||
$permissions[$i]->slug == 'download_discount_complimentary_return_report' ||


$permissions[$i]->slug == 'view_sales_by_branch_gross_sale_monthly_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_gross_sale_monthly_report' ||
$permissions[$i]->slug == 'view_sales_by_branch_net_sale_monthly_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_net_sale_monthly_report' ||

$permissions[$i]->slug == 'view_sales_by_month_report' ||
$permissions[$i]->slug == 'download_sales_by_month_report' ||
$permissions[$i]->slug == 'view_sales_by_service_report' ||
$permissions[$i]->slug == 'download_sales_by_service_report'||

$permissions[$i]->slug == 'view_sales_by_complimentary_report' ||
$permissions[$i]->slug == 'download_sales_by_complimentary_report'



) {
return true;
}
}
});



Gate::define('cash_deposite_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_cash_deposite_branch_wise_report' ||
$permissions[$i]->slug == 'download_cash_deposite_branch_wise_report'
) {
return true;
}
}
});


Gate::define('view_cash_deposite_branch_wise_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_cash_deposite_branch_wise_report'
) {
return true;
}
}
});


Gate::define('download_cash_deposite_branch_wise_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
	$permissions[$i]->slug == 'download_cash_deposite_branch_wise_report'
) {
return true;
}
}
});



Gate::define('daily_sales_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_daily_sales_report' ||
$permissions[$i]->slug == 'download_daily_sales_report'||
$permissions[$i]->slug == 'edit_daily_sales_report'||
$permissions[$i]->slug == 'delete_daily_sales_report'

) {
return true;
}
}
});


Gate::define('view_daily_sales_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_daily_sales_report'
) {
return true;
}
}
});


Gate::define('edit_daily_sales_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'edit_daily_sales_report'
) {
return true;
}
}
});


Gate::define('download_daily_sales_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'download_daily_sales_report'
) {
return true;
}
}
});


Gate::define('delete_daily_sales_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'delete_daily_sales_report'
) {
return true;
}
}
});


Gate::define('payment_methods_branch_wise_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_payment_methods_branch_wise_report' ||
$permissions[$i]->slug == 'download_payment_methods_branch_wise_report'

) {
return true;
}
}
});


Gate::define('view_payment_methods_branch_wise_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_payment_methods_branch_wise_report'
) {
return true;
}
}
});


Gate::define('download_payment_methods_branch_wise_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'download_payment_methods_branch_wise_report'
  ) {
return true;
}
}
});





Gate::define('sales_by_branch_main_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_by_branch_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_report'||
$permissions[$i]->slug == 'view_sales_by_branch_net_sale_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_net_sale_report' ||
$permissions[$i]->slug == 'view_sales_by_branch_discount_sale_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_discount_sale_report' ||


$permissions[$i]->slug == 'view_discount_complimentary_return_report' ||
$permissions[$i]->slug == 'download_discount_complimentary_return_report' ||


$permissions[$i]->slug == 'view_sales_by_branch_gross_sale_monthly_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_gross_sale_monthly_report' ||
$permissions[$i]->slug == 'view_sales_by_branch_net_sale_monthly_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_net_sale_monthly_report'

) {
return true;
}
}
});




Gate::define('sales_by_branch_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_by_branch_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_report'

) {
return true;
}
}
});


Gate::define('view_sales_by_branch_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'view_sales_by_branch_report'
) {
return true;
}
}
});


Gate::define('download_sales_by_branch_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'download_sales_by_branch_report'
) {
return true;
}
}
});





Gate::define('sales_by_branch_net_sale_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_by_branch_net_sale_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_net_sale_report'

) {
return true;
}
}
});


Gate::define('view_sales_by_branch_net_sale_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'view_sales_by_branch_net_sale_report'
) {
return true;
}
}
});


Gate::define('download_sales_by_branch_net_sale_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'download_sales_by_branch_net_sale_report'
) {
return true;
}
}
});



Gate::define('sales_by_branch_discount_sale_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_by_branch_discount_sale_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_discount_sale_report'

) {
return true;
}
}
});


Gate::define('view_sales_by_branch_discount_sale_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'view_sales_by_branch_discount_sale_report'
) {
return true;
}
}
});


Gate::define('download_sales_by_branch_discount_sale_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'download_sales_by_branch_discount_sale_report'
) {
return true;
}
}
});












Gate::define('sales_by_branch_discount_complimentary_return_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(


$permissions[$i]->slug == 'view_discount_complimentary_return_report' ||
$permissions[$i]->slug == 'download_discount_complimentary_return_report'


) {
return true;
}
}
});


Gate::define('view_discount_complimentary_return_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'view_discount_complimentary_return_report'
) {
return true;
}
}
});


Gate::define('download_discount_complimentary_return_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'download_discount_complimentary_return_report'
) {
return true;
}
}
});






//mk


  Gate::define('sales_by_branch_gross_sale_monthly_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_by_branch_gross_sale_monthly_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_gross_sale_monthly_report'

) {
return true;
}
}
});


Gate::define('view_sales_by_branch_gross_sale_monthly_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'view_sales_by_branch_gross_sale_monthly_report'
) {
return true;
}
}
});


Gate::define('download_sales_by_branch_gross_sale_monthly_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'download_sales_by_branch_gross_sale_monthly_report'
) {
return true;
}
}
});





  Gate::define('sales_by_branch_net_sale_monthly_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_by_branch_net_sale_monthly_report' ||
$permissions[$i]->slug == 'download_sales_by_branch_net_sale_monthly_report'

) {
return true;
}
}
});


Gate::define('view_sales_by_branch_net_sale_monthly_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'view_sales_by_branch_net_sale_monthly_report'
) {
return true;
}
}
});


Gate::define('download_sales_by_branch_net_sale_monthly_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'download_sales_by_branch_net_sale_monthly_report'
) {
return true;
}
}
});


//mk







Gate::define('sales_by_month_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_by_month_report' ||
$permissions[$i]->slug == 'download_sales_by_month_report'
) {
return true;
}
}
});




Gate::define('view_sales_by_month_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'view_sales_by_month_report'
) {
return true;
}
}
});



Gate::define('download_sales_by_month_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'download_sales_by_month_report'
) {
return true;
}
}
});





Gate::define('sales_by_service_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_by_service_report' ||
$permissions[$i]->slug == 'download_sales_by_service_report'
) {
return true;
}
}
});


Gate::define('view_sales_by_service_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_by_service_report'
) {
return true;
}
}
});


Gate::define('download_sales_by_service_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'download_sales_by_service_report'
) {
return true;
}
}
});




Gate::define('sales_by_complimentary_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_by_complimentary_report' ||
$permissions[$i]->slug == 'download_sales_by_complimentary_report'
) {
return true;
}
}
});


Gate::define('view_sales_by_complimentary_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_by_complimentary_report'
) {
return true;
}
}
});


Gate::define('download_sales_by_complimentary_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'download_sales_by_complimentary_report'
) {
return true;
}
}
});


//For Petty Cash Reporting Tab


Gate::define('petty_cash_reporting_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'view_branch_petty_cash_report' ||
 $permissions[$i]->slug == 'edit_branch_petty_cash_report' ||
$permissions[$i]->slug == 'delete_branch_petty_cash_report' ||
$permissions[$i]->slug == 'download_branch_petty_cash_report' ||
$permissions[$i]->slug == 'view_petty_cash_by_branch_report' ||
$permissions[$i]->slug == 'download_petty_cash_by_branch_report' ||
$permissions[$i]->slug == 'view_petty_cash_by_month_report' ||
$permissions[$i]->slug == 'download_petty_cash_by_month_report' ||
$permissions[$i]->slug == 'view_sales_petty_report' ||
$permissions[$i]->slug == 'delete_sales_petty_report' ||
$permissions[$i]->slug == 'download_sales_petty_report' ||
$permissions[$i]->slug == 'edit_sales_petty_report' ||
$permissions[$i]->slug == 'add_received_amount_sales_petty_report' ||
$permissions[$i]->slug == 'edit_received_amount_sales_petty_report' ||

$permissions[$i]->slug == 'view_car_wise_fule_report_report' ||
$permissions[$i]->slug == 'download_car_wise_fule_report_report'
) {
return true;
}
}
});



Gate::define('branch_petty_cash_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_branch_petty_cash_report' ||
$permissions[$i]->slug == 'edit_branch_petty_cash_report' ||
$permissions[$i]->slug == 'delete_branch_petty_cash_report' ||
$permissions[$i]->slug == 'download_branch_petty_cash_report'
) {
return true;
}
}
});



Gate::define('view_branch_petty_cash_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'view_branch_petty_cash_report'
) {
return true;
}
}
});


Gate::define('edit_branch_petty_cash_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'edit_branch_petty_cash_report'
) {
return true;
}
}
});


Gate::define('delete_branch_petty_cash_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'delete_branch_petty_cash_report'
) {
return true;
}
}
});


Gate::define('download_branch_petty_cash_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
   $permissions[$i]->slug == 'download_branch_petty_cash_report'
) {
return true;
}
}
});



Gate::define('by_branch_month_wise_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_petty_cash_by_branch_report' ||
$permissions[$i]->slug == 'download_petty_cash_by_branch_report'
) {
return true;
}
}
});


Gate::define('view_petty_cash_by_branch_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
  $permissions[$i]->slug == 'view_petty_cash_by_branch_report'
) {
return true;
}
}
});


Gate::define('download_petty_cash_by_branch_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
   $permissions[$i]->slug == 'download_petty_cash_by_branch_report'
) {
return true;
}
}
});



Gate::define('by_branch_single_branch_wise_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_petty_cash_by_month_report' ||
$permissions[$i]->slug == 'download_petty_cash_by_month_report'
) {
return true;
}
}
});


Gate::define('view_petty_cash_by_month_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_petty_cash_by_month_report'
) {
return true;
}
}
});


Gate::define('download_petty_cash_by_month_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'download_petty_cash_by_month_report'

) {
return true;
}
}
});




Gate::define('sales_petty_cash_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_sales_petty_report' ||
$permissions[$i]->slug == 'delete_sales_petty_report' ||
$permissions[$i]->slug == 'download_sales_petty_report'||
$permissions[$i]->slug == 'edit_sales_petty_report' ||
$permissions[$i]->slug == 'add_received_amount_sales_petty_report' ||
$permissions[$i]->slug == 'edit_received_amount_sales_petty_report'
) {
return true;
}
}
});

Gate::define('view_sales_petty_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_petty_report'
) {
return true;
}
}
});


Gate::define('delete_sales_petty_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'delete_sales_petty_report'
) {
return true;
}
}
});


Gate::define('download_sales_petty_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'download_sales_petty_report'
) {
return true;
}
}
});


Gate::define('edit_sales_petty_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'edit_sales_petty_report'
) {
return true;
}
}
});


Gate::define('add_received_amount_sales_petty_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'add_received_amount_sales_petty_report'
) {
return true;
}
}
});


Gate::define('edit_received_amount_sales_petty_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'edit_received_amount_sales_petty_report'
) {
return true;
}
}
});






Gate::define('car_wise_fule_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_car_wise_fule_report_report' ||
$permissions[$i]->slug == 'download_car_wise_fule_report_report'
) {
return true;
}
}
});

Gate::define('view_car_wise_fule_report_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_car_wise_fule_report_report'
) {
return true;
}
}
});


Gate::define('download_car_wise_fule_report_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'download_car_wise_fule_report_report'
) {
return true;
}
}
});


Gate::define('download_sales_petty_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
 $permissions[$i]->slug == 'download_sales_petty_report'
) {
return true;
}
}
});



//For  Petty Card Sales Report

Gate::define('card_sales_reporting_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_credit_card_report' ||
$permissions[$i]->slug == 'download_credit_card_report' ||
$permissions[$i]->slug == 'view_sales_report' ||
$permissions[$i]->slug == 'download_sales_report' ||
$permissions[$i]->slug == 'view_credit_card_report_by_month_report' ||
$permissions[$i]->slug == 'download_credit_card_report_by_month_report'
) {
return true;
}
}
});




Gate::define('card_commission_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_credit_card_report' ||
$permissions[$i]->slug == 'download_credit_card_report'
) {
return true;
}
}
});


Gate::define('view_credit_card_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_credit_card_report'
) {
return true;
}
}
});



Gate::define('download_credit_card_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'download_credit_card_report'
) {
return true;
}
}
});



Gate::define('card_reports_by_branch_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_sales_report' ||
$permissions[$i]->slug == 'download_sales_report'
) {
return true;
}
}
});

Gate::define('view_sales_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_sales_report'
) {
return true;
}
}
});


Gate::define('download_sales_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'download_sales_report'
) {
return true;
}
}
});







Gate::define('credit_card_report_by_month_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_credit_card_report_by_month_report' ||
$permissions[$i]->slug == 'download_credit_card_report_by_month_report'
) {
return true;
}
}
});

Gate::define('view_credit_card_report_by_month_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_credit_card_report_by_month_report'
) {
return true;
}
}
});


Gate::define('download_credit_card_report_by_month_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'download_credit_card_report_by_month_report'
) {
return true;
}
}
});







// Gate::define('credit_card_report_by_month_tab_management', function ($user) {
// $user = Auth::user();
// $permissions = $user->role->permissions;
// for ($i=0; $i < count($permissions); $i++) {
// if(
// $permissions[$i]->slug == 'view_credit_card_report_by_month_report' ||
// $permissions[$i]->slug == 'download_credit_card_report_by_month_report'
// ) {
// return true;
// }
// }
// });

// Gate::define('view_credit_card_report_by_month_report', function ($user) {
// $user = Auth::user();
// $permissions = $user->role->permissions;
// for ($i=0; $i < count($permissions); $i++) {
// if(

// $permissions[$i]->slug == 'view_credit_card_report_by_month_report'
// ) {
// return true;
// }
// }
// });


// Gate::define('download_credit_card_report_by_month_report', function ($user) {
// $user = Auth::user();
// $permissions = $user->role->permissions;
// for ($i=0; $i < count($permissions); $i++) {
// if(

// $permissions[$i]->slug == 'download_credit_card_report_by_month_report'
// ) {
// return true;
// }
// }
// });





Gate::define('maintenance_report_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_maintenance_report' ||
$permissions[$i]->slug == 'download_maintenance_report'||
$permissions[$i]->slug == 'edit_maintenance_report'||
$permissions[$i]->slug == 'delete_maintenance_report'
) {
return true;
}
}
});

Gate::define('view_maintenance_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_maintenance_report'
) {
return true;
}
}
});

Gate::define('edit_maintenance_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'edit_maintenance_report'
) {
return true;
}
}
});


Gate::define('download_maintenance_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'download_maintenance_report'
) {
return true;
}
}
});



Gate::define('view_maintenance_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_maintenance_report'
) {
return true;
}
}
});


Gate::define('delete_maintenance_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'delete_maintenance_report'
) {
return true;
}
}
});



//Tip Reports


  Gate::define('tip_report_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
   $permissions[$i]->slug == 'view_tip_report'||
$permissions[$i]->slug == 'edit_tip_report'||
$permissions[$i]->slug == 'delete_tip_report'
) {
return true;
}
}
});

Gate::define('view_tip_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_tip_report'
) {
return true;
}
}
});


Gate::define('edit_tip_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'edit_tip_report'
) {
return true;
}
}
});



Gate::define('delete_tip_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'delete_tip_report'
) {
return true;
}
}
});




Gate::define('gift_card_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_gift_card_report' ||
$permissions[$i]->slug == 'delete_gift_card_report'||
$permissions[$i]->slug == 'edit_gift_card_report'  ||
$permissions[$i]->slug == 'download_gift_card_report'  ||
$permissions[$i]->slug == 'download_gift_cards_all_branch_report'  ||
$permissions[$i]->slug == 'view_gift_cards_all_branch_report'
) {
return true;
}
}
});


Gate::define('gift_card_child_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(
$permissions[$i]->slug == 'view_gift_card_report' ||
$permissions[$i]->slug == 'delete_gift_card_report'||
$permissions[$i]->slug == 'edit_gift_card_report'  ||
$permissions[$i]->slug == 'download_gift_card_report'
) {
return true;
}
}
});






Gate::define('view_gift_card_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_gift_card_report'
) {
return true;
}
}
});


Gate::define('delete_gift_card_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'delete_gift_card_report'
) {
return true;
}
}
});

Gate::define('edit_gift_card_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'edit_gift_card_report'
) {
return true;
}
}
});


Gate::define('download_gift_card_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'download_gift_card_report'
) {
return true;
}
}
});



Gate::define('gift_card_branch_all_child_tab_management', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'download_gift_cards_all_branch_report'  ||
$permissions[$i]->slug == 'view_gift_cards_all_branch_report'
) {
return true;
}
}
});



Gate::define('download_gift_cards_all_branch_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'download_gift_cards_all_branch_report'
) {
return true;
}
}
});



Gate::define('view_gift_cards_all_branch_report', function ($user) {
$user = Auth::user();
$permissions = $user->role->permissions;
for ($i=0; $i < count($permissions); $i++) {
if(

$permissions[$i]->slug == 'view_gift_cards_all_branch_report'
) {
return true;
}
}
});


//End Report Management






  //Manage Access Control

       	Gate::define('manage_access_control_roles', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					 $permissions[$i]->slug == 'add_role' ||
					 $permissions[$i]->slug == 'view_role' ||
					 $permissions[$i]->slug == 'edit_role' ||
					 $permissions[$i]->slug == 'delete_role'||
					 $permissions[$i]->slug == 'view_permission' ||
					 $permissions[$i]->slug == 'edit_permission'

				) {
					return true;
				}
			}
		});



  	Gate::define('manage_roles', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'add_role' ||
					 $permissions[$i]->slug == 'view_role' ||
					 $permissions[$i]->slug == 'edit_role' ||
					 $permissions[$i]->slug == 'delete_role'


				) {
					return true;
				}
			}
		});

		Gate::define('add_role', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'add_role'

				) {
					return true;
				}
			}
		});

		Gate::define('edit_role', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'edit_role'

				) {
					return true;
				}
			}
		});

		Gate::define('view_role', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_role'

				) {
					return true;
				}
			}
		});

		Gate::define('delete_role', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'delete_role'

				) {
					return true;
				}
			}
		});

		Gate::define('manage_permissions', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_permission' ||
					 $permissions[$i]->slug == 'edit_permission'

				) {
					return true;
				}
			}
		});

		Gate::define('view_permissions', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_permission'

				) {
					return true;
				}
			}
		});

		Gate::define('edit_permissions', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'edit_permission'

				) {
					return true;
				}
			}
		});




   //Recycle Bin ...........................


    Gate::define('manage_recycle_bin_management', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(
	$permissions[$i]->slug == 'view_deleted_customer' ||
	$permissions[$i]->slug == 'restore_customer' ||
	$permissions[$i]->slug == 'permanent_deleted_customer' ||
	$permissions[$i]->slug == 'view_deleted_admin' ||
	$permissions[$i]->slug == 'restore_admin' ||
	$permissions[$i]->slug == 'permanent_deleted_admin' ||
	$permissions[$i]->slug == 'view_deleted_branch_manager' ||
	$permissions[$i]->slug == 'restore_branch_manager' ||
	$permissions[$i]->slug == 'permanent_deleted_branch_manager' ||

    $permissions[$i]->slug == 'view_deleted_staff' ||
	$permissions[$i]->slug == 'restore_staff' ||
	$permissions[$i]->slug == 'permanent_deleted_staff' ||



	$permissions[$i]->slug == 'view_deleted_branch' ||
	$permissions[$i]->slug == 'restore_branch' ||
	$permissions[$i]->slug == 'permanent_deleted_branch' ||
	$permissions[$i]->slug == 'view_deleted_menu_categories' ||
	$permissions[$i]->slug == 'restore_menu_categories' ||
	$permissions[$i]->slug == 'permanent_deleted_menu_categories' ||
	$permissions[$i]->slug == 'view_deleted_menu_item' ||
	$permissions[$i]->slug == 'restore_menu_item' ||
	$permissions[$i]->slug == 'permanent_deleted_menu_item' ||

	$permissions[$i]->slug == 'view_deleted_current_offer' ||
	$permissions[$i]->slug == 'restore_current_offer' ||
    $permissions[$i]->slug == 'permanent_deleted_current_offer' ||

	$permissions[$i]->slug == 'view_deleted_checkout_offer' ||
	$permissions[$i]->slug == 'restore_checkout_offer' ||
	$permissions[$i]->slug == 'permanent_deleted_checkout_offer' ||
	$permissions[$i]->slug == 'view_deleted_discount_offer' ||
	$permissions[$i]->slug == 'restore_discount_offer' ||
	$permissions[$i]->slug == 'permanent_deleted_discount_offer' ||
	$permissions[$i]->slug == 'view_deleted_coupon_code' ||
	$permissions[$i]->slug == 'restore_coupon_code' ||
	$permissions[$i]->slug == 'permanent_deleted_coupon_code' ||
    $permissions[$i]->slug == 'view_deleted_gift_cards' ||
	$permissions[$i]->slug == 'restore_gift_cards' ||
	$permissions[$i]->slug == 'permanent_deleted_gift_cards' ||
    $permissions[$i]->slug == 'view_deleted_dsr'||
	$permissions[$i]->slug == 'restore_dsr'||
    $permissions[$i]->slug == 'permanent_deleted_dsr'||
    $permissions[$i]->slug == 'view_deleted_sales_and_petty'||
	$permissions[$i]->slug == 'restore_sales_and_petty'||
    $permissions[$i]->slug == 'permanent_deleted_sales_and_petty'||
    $permissions[$i]->slug == 'view_deleted_maintenance_report'||
	$permissions[$i]->slug == 'restore_maintenance_report'||
    $permissions[$i]->slug == 'permanent_delete_maintenance_report'||
    $permissions[$i]->slug == 'view_deleted_cities' ||
	$permissions[$i]->slug == 'restore_cities' ||
	$permissions[$i]->slug == 'permanent_deleted_cities' ||
	$permissions[$i]->slug == 'view_deleted_question' ||
	$permissions[$i]->slug == 'restore_question' ||
	$permissions[$i]->slug == 'permanent_deleted_question' ||
    $permissions[$i]->slug == 'view_deleted_designations' ||
	$permissions[$i]->slug == 'restore_designations' ||
	$permissions[$i]->slug == 'permanent_deleted_designations' ||
    $permissions[$i]->slug == 'view_deleted_petty_expense_category' ||
	$permissions[$i]->slug == 'restore_petty_expense_category' ||
	$permissions[$i]->slug == 'permanent_deleted_petty_expense_category' ||
    $permissions[$i]->slug == 'view_deleted_petty_expense_sub_category' ||
	$permissions[$i]->slug == 'restore_petty_expense_sub_category' ||
	$permissions[$i]->slug == 'permanent_deleted_petty_expense_sub_category' ||
    $permissions[$i]->slug == 'view_deleted_maintenance_category' ||
	$permissions[$i]->slug == 'restore_maintenance_category' ||
	$permissions[$i]->slug == 'permanent_deleted_maintenance_category' ||
    $permissions[$i]->slug == 'view_deleted_maintenance_sub_category' ||
	$permissions[$i]->slug == 'restore_maintenance_sub_category' ||
	$permissions[$i]->slug == 'permanent_deleted_maintenance_sub_category' ||
	$permissions[$i]->slug == 'view_deleted_role'||
	$permissions[$i]->slug == 'view_deleted_ownership' ||
	$permissions[$i]->slug == 'restore_ownership' ||
	$permissions[$i]->slug == 'permanent_delete_ownership'||
	$permissions[$i]->slug == 'view_deleted_drivers' ||
	$permissions[$i]->slug == 'restore_drivers' ||
	$permissions[$i]->slug == 'permanent_delete_drivers'||
	$permissions[$i]->slug == 'view_deleted_cars' ||
	$permissions[$i]->slug == 'restore_cars' ||
	$permissions[$i]->slug == 'permanent_delete_cars'







	) {
	return true;
	}
	}
	});


    Gate::define('manage_recycle_bin_user_management', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(
	$permissions[$i]->slug == 'view_deleted_customer' ||
	$permissions[$i]->slug == 'restore_customer' ||
	$permissions[$i]->slug == 'permanent_deleted_customer' ||
	$permissions[$i]->slug == 'view_deleted_admin' ||
	$permissions[$i]->slug == 'restore_admin' ||
	$permissions[$i]->slug == 'permanent_deleted_admin' ||
	$permissions[$i]->slug == 'view_deleted_branch_manager' ||
	$permissions[$i]->slug == 'restore_branch_manager' ||
	$permissions[$i]->slug == 'permanent_deleted_branch_manager' ||
    $permissions[$i]->slug == 'view_deleted_staff' ||
	$permissions[$i]->slug == 'restore_staff' ||
	$permissions[$i]->slug == 'permanent_deleted_staff'


	) {
	return true;
	}
	}
	});

          //Recyle customer


	      //User Management Tab

    	Gate::define('manage_recyle_customer_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_customer' ||
					$permissions[$i]->slug == 'restore_customer' ||
					$permissions[$i]->slug == 'permanent_deleted_customer'
				) {
					return true;
				}
			}
	});



	Gate::define('view_deleted_customer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_customer'

				) {
					return true;
				}
			}
	});






	Gate::define('restore_customer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_customer'

				) {
					return true;
				}
			}
		});


	Gate::define('permanent_deleted_customer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_customer'

				) {
					return true;
				}
			}
		});

       //Recyle Admin


	      //Admin Management Tab

    	Gate::define('manage_recyle_admin_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_admin' ||
					$permissions[$i]->slug == 'restore_admin' ||
					$permissions[$i]->slug == 'permanent_deleted_admin'
				) {
					return true;
				}
			}
	});



	Gate::define('view_deleted_admin', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_admin'

				) {
					return true;
				}
			}
		});


	Gate::define('restore_admin', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_admin'

				) {
					return true;
				}
			}
		});


	Gate::define('permanent_deleted_admin', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_admin'

				) {
					return true;
				}
			}
		});


  //Recyle Branch Managers


	       //Admin Management Tab

    	Gate::define('manage_recyle_branch_manager_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_branch_manager' ||
					$permissions[$i]->slug == 'restore_branch_manager' ||
					$permissions[$i]->slug == 'permanent_deleted_branch_manager'
				) {
					return true;
				}
			}
	});


	 Gate::define('view_deleted_branch_manager', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_branch_manager'

				) {
					return true;
				}
			}
		});


		Gate::define('restore_branch_manager', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_branch_manager'

				) {
					return true;
				}
			}
		});

		Gate::define('permanent_deleted_branch_manager', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_branch_manager'

				) {
					return true;
				}
			}
		});







       //Recyle Staff Management Tab

    	Gate::define('manage_recyle_staff_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_staff' ||
					$permissions[$i]->slug == 'restore_staff' ||
					$permissions[$i]->slug == 'permanent_deleted_staff'
				) {
					return true;
				}
			}
	});



	Gate::define('view_deleted_staff', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_staff'

				) {
					return true;
				}
			}
		});


	Gate::define('restore_staff', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_staff'

				) {
					return true;
				}
			}
		});


	Gate::define('permanent_deleted_staff', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_staff'

				) {
					return true;
				}
			}
		});





     //Recyle Branch Management

               //Admin Management Tab

    	Gate::define('manage_recyle_branch_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_branch' ||
					$permissions[$i]->slug == 'restore_branch' ||
					$permissions[$i]->slug == 'permanent_deleted_branch'
				) {
					return true;
				}
			}
	});



	Gate::define('view_deleted_branch', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_branch'

				) {
					return true;
				}
			}
		});


		Gate::define('restore_branch', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_branch'

				) {
					return true;
				}
			}
		});

		Gate::define('permanent_deleted_branch', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_branch'

				) {
					return true;
				}
			}
		});


		//Recyle Menu Management



    Gate::define('manage_recycle_bin_menu_management', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'view_deleted_menu_categories' ||
	$permissions[$i]->slug == 'restore_menu_categories' ||
	$permissions[$i]->slug == 'permanent_deleted_menu_categories' ||
	$permissions[$i]->slug == 'view_deleted_menu_item' ||
	$permissions[$i]->slug == 'restore_menu_item' ||
	$permissions[$i]->slug == 'permanent_deleted_menu_item'
	) {
	return true;
	}
	}
	});

             //Category Management


                 //Menu Management Tab

    	Gate::define('manage_recyle_menu_categories_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_menu_categories' ||
					$permissions[$i]->slug == 'restore_menu_categories' ||
					$permissions[$i]->slug == 'permanent_deleted_menu_categories'
				) {
					return true;
				}
			}
	});

        	Gate::define('view_deleted_menu_categories', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_menu_categories'

				) {
					return true;
				}
			}
		});


		Gate::define('restore_menu_categories', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_menu_categories'

				) {
					return true;
				}
			}
		});

		Gate::define('permanent_deleted_menu_categories', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_menu_categories'

				) {
					return true;
				}
			}
		});




		    //Menu Item Management


		        //Menu Item Management Tab

    	Gate::define('manage_recyle_menu_item_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_menu_item' ||
					$permissions[$i]->slug == 'restore_menu_item' ||
					$permissions[$i]->slug == 'permanent_deleted_menu_item'
				) {
					return true;
				}
			}
	});

        	Gate::define('view_deleted_menu_item', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_menu_item'

				) {
					return true;
				}
			}
		});


		Gate::define('restore_menu_item', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_menu_item'

				) {
					return true;
				}
			}
		});

		Gate::define('permanent_deleted_menu_item', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_menu_item'

				) {
					return true;
				}
			}
		});



      //Recyle Offer Management.........................




    Gate::define('manage_recycle_bin_offer_management', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'view_deleted_current_offer' ||
	$permissions[$i]->slug == 'restore_current_offer' ||
	$permissions[$i]->slug == 'permanent_deleted_current_offer' ||



	$permissions[$i]->slug == 'view_deleted_checkout_offer' ||
	$permissions[$i]->slug == 'restore_checkout_offer' ||
	$permissions[$i]->slug == 'permanent_deleted_checkout_offer' ||
	$permissions[$i]->slug == 'view_deleted_discount_offer' ||
	$permissions[$i]->slug == 'restore_discount_offer' ||
	$permissions[$i]->slug == 'permanent_deleted_discount_offer' ||
	$permissions[$i]->slug == 'view_deleted_coupon_code' ||
	$permissions[$i]->slug == 'restore_coupon_code' ||
	$permissions[$i]->slug == 'permanent_deleted_coupon_code' ||
	$permissions[$i]->slug == 'view_deleted_gift_cards' ||
	$permissions[$i]->slug == 'restore_gift_cards' ||
	$permissions[$i]->slug == 'permanent_deleted_gift_cards'


	) {
	return true;
	}
	}
	});

     //Recyle checkout offer




    	Gate::define('manage_recyle_current_offer_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_current_offer' ||
					$permissions[$i]->slug == 'restore_current_offer' ||
					$permissions[$i]->slug == 'permanent_deleted_current_offer'
				) {
					return true;
				}
			}
	});


      Gate::define('view_deleted_current_offer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_current_offer'

				) {
					return true;
				}
			}
		});

      Gate::define('restore_current_offer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_current_offer'

				) {
					return true;
				}
			}
		});


      Gate::define('permanent_deleted_current_offer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_current_offer'

				) {
					return true;
				}
			}
		});



		        //Menu Item Management Tab

    	Gate::define('manage_recyle_checkout_offer_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_checkout_offer' ||
					$permissions[$i]->slug == 'restore_checkout_offer' ||
					$permissions[$i]->slug == 'permanent_deleted_checkout_offer'
				) {
					return true;
				}
			}
	});


      Gate::define('view_deleted_checkout_offer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_checkout_offer'

				) {
					return true;
				}
			}
		});

      Gate::define('restore_checkout_offer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_checkout_offer'

				) {
					return true;
				}
			}
		});


      Gate::define('permanent_deleted_checkout_offer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_checkout_offer'

				) {
					return true;
				}
			}
		});

         //Recyle discount offer



    	Gate::define('manage_recyle_discount_offer_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_discount_offer' ||
					$permissions[$i]->slug == 'restore_discount_offer' ||
					$permissions[$i]->slug == 'permanent_deleted_discount_offer'

				) {
					return true;
				}
			}
	});


      Gate::define('view_deleted_discount_offer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_discount_offer'

				) {
					return true;
				}
			}
		});

      Gate::define('restore_discount_offer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_discount_offer'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_discount_offer', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_discount_offer'

				) {
					return true;
				}
			}
		});

    //Recyle Coupon code


        	Gate::define('manage_recyle_coupon_code_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_coupon_code' ||
					$permissions[$i]->slug == 'restore_coupon_code' ||
					$permissions[$i]->slug == 'permanent_deleted_coupon_code'

				) {
					return true;
				}
			}
	});



      Gate::define('view_deleted_coupon_code', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_coupon_code'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_coupon_code', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_coupon_code'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_coupon_code', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_coupon_code'

				) {
					return true;
				}
			}
		});




      //Recyle Gift Cards


        	Gate::define('manage_recyle_gift_cards_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
				$permissions[$i]->slug == 'view_deleted_gift_cards' ||
				$permissions[$i]->slug == 'restore_gift_cards' ||
				$permissions[$i]->slug == 'permanent_deleted_gift_cards'

				) {
					return true;
				}
			}
	});



      Gate::define('view_deleted_gift_cards', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_gift_cards'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_gift_cards', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_gift_cards'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_gift_cards', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_gift_cards'

				) {
					return true;
				}
			}
		});


    //Recycle Advanced Reports


       Gate::define('manage_recycle_bin_advance_report_management', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(
	$permissions[$i]->slug == 'view_deleted_dsr' ||
	$permissions[$i]->slug == 'restore_dsr' ||
	$permissions[$i]->slug == 'permanent_deleted_dsr'||
	$permissions[$i]->slug == 'view_deleted_sales_and_petty'||
	$permissions[$i]->slug == 'restore_sales_and_petty'||
	$permissions[$i]->slug == 'permanent_deleted_sales_and_petty'||
  $permissions[$i]->slug == 'view_deleted_maintenance_report'||
	$permissions[$i]->slug == 'restore_maintenance_report'||
	$permissions[$i]->slug == 'permanent_delete_maintenance_report'

	) {
	return true;
	}
	}
	});

       //For DSR


	Gate::define('manage_recyle_report_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
				$permissions[$i]->slug == 'view_deleted_dsr' ||
				$permissions[$i]->slug == 'restore_dsr' ||
				$permissions[$i]->slug == 'permanent_deleted_dsr'

				) {
					return true;
				}
			}
	});



  Gate::define('view_deleted_dsr', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'view_deleted_dsr'

	) {
	return true;
	}
	}
	});

	Gate::define('restore_dsr', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'restore_dsr'

	) {
	return true;
	}
	}
	});


	Gate::define('permanent_deleted_dsr', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'permanent_deleted_dsr'

	) {
	return true;
	}
	}
	});




	  //For  Sales & Petty


	Gate::define('manage_recyle_sales_and_petty_report_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
			$permissions[$i]->slug == 'view_deleted_sales_and_petty'||
			$permissions[$i]->slug == 'restore_sales_and_petty'||
			$permissions[$i]->slug == 'permanent_deleted_sales_and_petty'
				) {
					return true;
				}
			}
	});



  Gate::define('view_deleted_sales_and_petty', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'view_deleted_sales_and_petty'

	) {
	return true;
	}
	}
	});

	Gate::define('restore_sales_and_petty', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'restore_sales_and_petty'

	) {
	return true;
	}
	}
	});


	Gate::define('permanent_deleted_sales_and_petty', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'permanent_deleted_sales_and_petty'

	) {
	return true;
	}
	}
	});




	  //For  Sales & Petty


	Gate::define('manage_recyle_maintenance_report_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
				$permissions[$i]->slug == 'view_deleted_maintenance_report'||
				$permissions[$i]->slug == 'restore_maintenance_report'||
				$permissions[$i]->slug == 'permanent_delete_maintenance_report'
				) {
					return true;
				}
			}
	});



  Gate::define('view_deleted_maintenance_report', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'view_deleted_maintenance_report'

	) {
	return true;
	}
	}
	});

	Gate::define('restore_maintenance_report', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'restore_maintenance_report'

	) {
	return true;
	}
	}
	});


	Gate::define('permanent_delete_maintenance_report', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'permanent_delete_maintenance_report'

	) {
	return true;
	}
	}
	});



    //Recycle Misc Data Management

       Gate::define('manage_recycle_bin_misc_management', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

     	$permissions[$i]->slug == 'view_deleted_brands' ||
	    $permissions[$i]->slug == 'restore_brands' ||
	    $permissions[$i]->slug == 'permanent_deleted_brands' ||

	    $permissions[$i]->slug == 'view_deleted_blocks' ||
	    $permissions[$i]->slug == 'restore_blocks' ||
	    $permissions[$i]->slug == 'permanent_deleted_blocks' ||



	$permissions[$i]->slug == 'view_deleted_cities' ||
	$permissions[$i]->slug == 'restore_cities' ||
	$permissions[$i]->slug == 'permanent_deleted_cities' ||
	$permissions[$i]->slug == 'view_deleted_question' ||
	$permissions[$i]->slug == 'restore_question' ||
	$permissions[$i]->slug == 'permanent_deleted_question' ||

  $permissions[$i]->slug == 'view_deleted_designations' ||
	$permissions[$i]->slug == 'restore_designations' ||
	$permissions[$i]->slug == 'permanent_deleted_designations' ||

	$permissions[$i]->slug == 'view_deleted_petty_expense_category' ||
	$permissions[$i]->slug == 'restore_petty_expense_category' ||
	$permissions[$i]->slug == 'permanent_deleted_petty_expense_category' ||

	$permissions[$i]->slug == 'view_deleted_petty_expense_sub_category' ||
	$permissions[$i]->slug == 'restore_petty_expense_sub_category' ||
	$permissions[$i]->slug == 'permanent_deleted_petty_expense_sub_category' ||

  $permissions[$i]->slug == 'view_deleted_maintenance_category' ||
	$permissions[$i]->slug == 'restore_maintenance_category' ||
	$permissions[$i]->slug == 'permanent_deleted_maintenance_category' ||


   $permissions[$i]->slug == 'view_deleted_maintenance_sub_category' ||
	$permissions[$i]->slug == 'restore_maintenance_sub_category' ||
	$permissions[$i]->slug == 'permanent_deleted_maintenance_sub_category' ||



	$permissions[$i]->slug == 'view_deleted_ownership' ||
	$permissions[$i]->slug == 'restore_ownership' ||
	$permissions[$i]->slug == 'permanent_delete_ownership'||
  $permissions[$i]->slug == 'view_deleted_drivers' ||
	$permissions[$i]->slug == 'restore_drivers' ||
	$permissions[$i]->slug == 'permanent_delete_drivers'||
  $permissions[$i]->slug == 'view_deleted_cars' ||
	$permissions[$i]->slug == 'restore_cars' ||
	$permissions[$i]->slug == 'permanent_delete_cars'
	) {
	return true;
	}
	}
	});










 //Recyle Blocks....................


           Gate::define('manage_recyle_blocks_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_blocks' ||
					$permissions[$i]->slug == 'restore_blocks' ||
					$permissions[$i]->slug == 'permanent_deleted_blocks'

				) {
					return true;
				}
			}
	});

           Gate::define('view_deleted_blocks', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_blocks'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_blocks', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_blocks'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_blocks', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_blocks'

				) {
					return true;
				}
			}
		});






 //Recyle Brands....................


           Gate::define('manage_recyle_brands_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_brands' ||
					$permissions[$i]->slug == 'restore_brands' ||
					$permissions[$i]->slug == 'permanent_deleted_brands'

				) {
					return true;
				}
			}
	});

           Gate::define('view_deleted_brands', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_brands'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_brands', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_brands'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_brands', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_brands'

				) {
					return true;
				}
			}
		});




       //Recyle Cities....................


           Gate::define('manage_recyle_cities_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_cities' ||
					$permissions[$i]->slug == 'restore_cities' ||
					$permissions[$i]->slug == 'permanent_deleted_cities'

				) {
					return true;
				}
			}
	});

           Gate::define('view_deleted_cities', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_cities'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_cities', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_cities'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_cities', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_cities'

				) {
					return true;
				}
			}
		});

       //Recyle  Question.....................


     Gate::define('manage_recyle_question_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
				$permissions[$i]->slug == 'view_deleted_question' ||
				$permissions[$i]->slug == 'restore_question' ||
				$permissions[$i]->slug == 'permanent_deleted_question'
				) {
					return true;
				}
			}
	});


        Gate::define('view_deleted_question', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_question'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_question', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_question'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_question', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_question'

				) {
					return true;
				}
			}
		});



           //Recyle  	Designations.....................


     Gate::define('manage_recyle_designations_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
				$permissions[$i]->slug == 'view_deleted_designations' ||
	$permissions[$i]->slug == 'restore_designations' ||
	$permissions[$i]->slug == 'permanent_deleted_designations'
				) {
					return true;
				}
			}
	});


        Gate::define('view_deleted_designations', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_designations'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_designations', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_designations'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_designations', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_designations'

				) {
					return true;
				}
			}
		});




           //Recyle  	petty_expense_category.....................


     Gate::define('manage_recyle_petty_expense_category_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
		$permissions[$i]->slug == 'view_deleted_petty_expense_category' ||
	$permissions[$i]->slug == 'restore_petty_expense_category' ||
	$permissions[$i]->slug == 'permanent_deleted_petty_expense_category'
				) {
					return true;
				}
			}
	});


        Gate::define('view_deleted_petty_expense_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_petty_expense_category'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_petty_expense_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_petty_expense_category'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_petty_expense_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_petty_expense_category'

				) {
					return true;
				}
			}
		});





           //Recyle  	petty_expense_ sub category.....................


     Gate::define('manage_recyle_petty_expense_sub_category_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
$permissions[$i]->slug == 'view_deleted_petty_expense_sub_category' ||
	$permissions[$i]->slug == 'restore_petty_expense_sub_category' ||
	$permissions[$i]->slug == 'permanent_deleted_petty_expense_sub_category'
				) {
					return true;
				}
			}
	});


        Gate::define('view_deleted_petty_expense_sub_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_petty_expense_sub_category'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_petty_expense_sub_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_petty_expense_sub_category'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_petty_expense_sub_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_petty_expense_sub_category'

				) {
					return true;
				}
			}
		});





           //Recyle  maintenance_category category.....................


     Gate::define('manage_recyle_maintenance_category_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
  $permissions[$i]->slug == 'view_deleted_maintenance_category' ||
	$permissions[$i]->slug == 'restore_maintenance_category' ||
	$permissions[$i]->slug == 'permanent_deleted_maintenance_category'

				) {
					return true;
				}
			}
	});


        Gate::define('view_deleted_maintenance_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_maintenance_category'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_maintenance_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_maintenance_category'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_maintenance_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_maintenance_category'

				) {
					return true;
				}
			}
		});




               //Recyle  maintenance_sub category.....................


     Gate::define('manage_recyle_maintenance_sub_category_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
   $permissions[$i]->slug == 'view_deleted_maintenance_sub_category' ||
	$permissions[$i]->slug == 'restore_maintenance_sub_category' ||
	$permissions[$i]->slug == 'permanent_deleted_maintenance_sub_category'

				) {
					return true;
				}
			}
	});


        Gate::define('view_deleted_maintenance_sub_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_maintenance_sub_category'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_maintenance_sub_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_maintenance_sub_category'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_deleted_maintenance_sub_category', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_deleted_maintenance_sub_category'

				) {
					return true;
				}
			}
		});


      //Recyle  OwnerShip.....................


     Gate::define('manage_recyle_ownership_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
				$permissions[$i]->slug == 'view_deleted_ownership' ||
				$permissions[$i]->slug == 'restore_ownership' ||
				$permissions[$i]->slug == 'permanent_delete_ownership'
				) {
					return true;
				}
			}
	});


        Gate::define('view_deleted_ownership', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_ownership'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_ownership', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_ownership'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_delete_ownership', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_delete_ownership'

				) {
					return true;
				}
			}
		});




     //Recyle  OwnerShip.....................


     Gate::define('manage_recyle_drivers_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
			$permissions[$i]->slug == 'view_deleted_drivers' ||
			$permissions[$i]->slug == 'restore_drivers' ||
			$permissions[$i]->slug == 'permanent_delete_drivers'
				) {
					return true;
				}
			}
	});


        Gate::define('view_deleted_drivers', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_drivers'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_drivers', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_drivers'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_delete_drivers', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_delete_drivers'

				) {
					return true;
				}
			}
		});







     //Recyle  Cars.....................


     Gate::define('manage_recyle_cars_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
					$permissions[$i]->slug == 'view_deleted_cars' ||
					$permissions[$i]->slug == 'restore_cars' ||
					$permissions[$i]->slug == 'permanent_delete_cars'
				) {
					return true;
				}
			}
	});


        Gate::define('view_deleted_cars', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'view_deleted_cars'

				) {
					return true;
				}
			}
		});


      Gate::define('restore_cars', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'restore_cars'

				) {
					return true;
				}
			}
		});

      Gate::define('permanent_delete_cars', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if($permissions[$i]->slug == 'permanent_delete_cars'

				) {
					return true;
				}
			}
		});


    //Access Control



   Gate::define('manage_recyle_role_tab', function ($user) {
			$user = Auth::user();
			$permissions = $user->role->permissions;
			for ($i=0; $i < count($permissions); $i++) {
				if(
				$permissions[$i]->slug == 'view_deleted_role' ||
				$permissions[$i]->slug == 'restore_role' ||
				$permissions[$i]->slug == 'permanent_deleted_role'

				) {
					return true;
				}
			}
	});



  Gate::define('view_deleted_role', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'view_deleted_role'

	) {
	return true;
	}
	}
	});

	       Gate::define('restore_role', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'restore_role'

	) {
	return true;
	}
	}
	});


	Gate::define('permanent_deleted_role', function ($user) {
	$user = Auth::user();
	$permissions = $user->role->permissions;
	for ($i=0; $i < count($permissions); $i++) {
	if(

	$permissions[$i]->slug == 'permanent_deleted_role'

	) {
	return true;
	}
	}
	});


	//.....................






       // End Apply Gates

		//--Old Codes Below

		// Gate::define('manage_users_management', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'add_user' ||
		// 			 $permissions[$i]->slug == 'edit_user' ||
		// 			 $permissions[$i]->slug == 'delete_user' ||
		// 			 $permissions[$i]->slug == 'view_user' ||
		// 			 $permissions[$i]->slug == 'add_admin' ||
		// 			 $permissions[$i]->slug == 'edit_admin' ||
		// 			 $permissions[$i]->slug == 'view_admin' ||
		// 			 $permissions[$i]->slug == 'delete_admin'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('users_management', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'add_user' ||
		// 			 $permissions[$i]->slug == 'edit_user' ||
		// 			 $permissions[$i]->slug == 'delete_user' ||
		// 			 $permissions[$i]->slug == 'view_user'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });


		// Gate::define('add_user', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if(
		// 			 $permissions[$i]->slug == 'view_user'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('edit_user', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if(
		// 			 $permissions[$i]->slug == 'edit_user'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('delete_user', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if(
		// 			 $permissions[$i]->slug == 'delete_user'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('add_user', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if(
		// 			 $permissions[$i]->slug == 'add_user'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });



		// Gate::define('manage_mobile_content', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'add_mobile_content' ||
		// 			 $permissions[$i]->slug == 'edit_mobile_content' ||
		// 			 $permissions[$i]->slug == 'view_mobile_content' ||
		// 			 $permissions[$i]->slug == 'delete_mobile_content'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('add_mobile_content', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'add_mobile_content'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('view_mobile_content', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'view_mobile_content'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('edit_mobile_content', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'edit_mobile_content'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('delete_mobile_content', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'delete_mobile_content'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });


		// Gate::define('manage_feedback_action', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'delete_feedback' ||
		// 			 $permissions[$i]->slug == 'view_feedback'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('delete_feedback', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'delete_feedback'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('view_feedback', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'view_feedback'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('manage_roles', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'add_role' ||
		// 			 $permissions[$i]->slug == 'view_role' ||
		// 			 $permissions[$i]->slug == 'edit_role' ||
		// 			 $permissions[$i]->slug == 'delete_role'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('add_role', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'add_role'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('edit_role', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'edit_role'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('view_role', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'view_role'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('delete_role', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'delete_role'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('manage_permissions', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'view_permission' ||
		// 			 $permissions[$i]->slug == 'edit_permission'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('view_permissions', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'view_permission'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('edit_permissions', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'edit_permission'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('manage_deleted_admins', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'restore_admin' ||
		// 			 $permissions[$i]->slug == 'permanent_delete_admin'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('restore_admin', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'restore_admin'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('permanent_delete_admin', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'permanent_delete_admin'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('manage_deleted_users', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'restore_user' ||
		// 			 $permissions[$i]->slug == 'permanent_delete_user'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('restore_user', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'restore_user'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('permanent_delete_user', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'permanent_delete_user'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('manage_deleted_roles', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'restore_role' ||
		// 			 $permissions[$i]->slug == 'permanent_delete_role'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('restore_role', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'restore_role'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });

		// Gate::define('permanent_delete_role', function ($user) {
		// 	return true;
		// 	$user = Auth::user();
		// 	$permissions = $user->role->permissions;
		// 	for ($i=0; $i < count($permissions); $i++) {
		// 		if($permissions[$i]->slug == 'permanent_delete_role'

		// 		) {
		// 			return true;
		// 		}
		// 	}
		// });
	}
}
