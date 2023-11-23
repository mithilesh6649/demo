<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClientReviewController;
use App\Http\Controllers\ConfidentialApiKeyController;
// use App\Http\Controllers\Admin\RecycleBinController;
// use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ConsultantSessionController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CurrentOpeningController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DiteCategoryController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NutritionistController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\PaymentTransactionController;
use App\Http\Controllers\ProjectFeatureController;
use App\Http\Controllers\RecipeCategoryController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecycleBinController;
use App\Http\Controllers\ReferralPatientController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestReportManagementController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\TraitController;
use App\Http\Controllers\RdaValueController;
use App\Http\Controllers\DietPlanSubscriptionSubController;
use Illuminate\Support\Facades\Route;

//

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get("/insert-data", function () {
    App\Models\DietSubscriptionFeatureMap::truncate();
    $DietPlanSubscription = App\Models\DietPlanSubscription::pluck("id")->toArray();

    foreach ($DietPlanSubscription as $id) {

        switch ($id) {
            case 1:

                $DietPlanFeatures = App\Models\Feature::pluck("id")->toArray();
                foreach ($DietPlanFeatures as $DietPlanFeature) {
                    $newFeature = new App\Models\DietSubscriptionFeatureMap();
                    $newFeature->feature_id = $DietPlanFeature;
                    $newFeature->diet_plan_subscription_id = 1;
                    $newFeature->save();
                }

                break;
            case 2:
                $DietPlanFeatures = App\Models\Feature::whereNotIn('id', [5, 3, 13, 18, 8, 12, 9, 6])->pluck("id")->toArray();
                foreach ($DietPlanFeatures as $DietPlanFeature) {
                    $newFeature = new App\Models\DietSubscriptionFeatureMap();
                    $newFeature->feature_id = $DietPlanFeature;
                    $newFeature->diet_plan_subscription_id = 2;
                    $newFeature->save();
                }
                break;
            case 3:
                $DietPlanFeatures = App\Models\Feature::whereNotIn('id', [5, 8, 12, 9, 6])->pluck("id")->toArray();
                foreach ($DietPlanFeatures as $DietPlanFeature) {
                    $newFeature = new App\Models\DietSubscriptionFeatureMap();
                    $newFeature->feature_id = $DietPlanFeature;
                    $newFeature->diet_plan_subscription_id = 3;
                    $newFeature->save();
                }
                break;
            case 4:
                $DietPlanFeatures = App\Models\Feature::pluck("id")->toArray();
                foreach ($DietPlanFeatures as $DietPlanFeature) {
                    $newFeature = new App\Models\DietSubscriptionFeatureMap();
                    $newFeature->feature_id = $DietPlanFeature;
                    $newFeature->diet_plan_subscription_id = 4;
                    $newFeature->save();
                }
                break;

            default:
                return "fsdfdddddddd";
        }

    }

    return "Data inserted";
});

Route::post('custom-logout', function () {
    Auth::logout();
    Session::flush();
    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    return redirect()->route('login');
})->name('custom.logout');

Route::get('/zoom-authentication', [AppointmentController::class, 'zoomAuth']);
Route::get('/test-zoom', [AppointmentController::class, 'testZoom']);
Route::post('/zoom-metting-end', [AppointmentController::class, 'zoomEndWebhook']);
Route::get('/', function () {

    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');

    return redirect()->route('login');
    // return view('welcome');
})->name('admin_home');

Route::middleware(['auth:admin'])->group(function () {
    // Admin Panel
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/user_permissions', [RolesController::class, 'getUserPermissions'])->name('user_permissions');
        Route::get('/all_permissions', [RolesController::class, 'getAllPermissions'])->name('all_permissions');

        // Common
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/set-session', [AdminController::class, 'setSession'])->name('setSession');
        Route::get('/admin_profile', [AdminController::class, 'adminProfile'])->name('admin_profile');
        Route::post('/update_profile', [AdminController::class, 'updateProfile'])->name('update_profile');
        Route::post('/check_password', [AdminController::class, 'checkPassword'])->name('check_password');
        Route::post('/change_password', [AdminController::class, 'changePassword'])->name('change_password');
        Route::post("/delete/admin/profile", [AdminsController::class, "deleteAdminProfile"])->name("delete_admin_profile");
        // Users Management
        Route::group(['prefix' => 'users'], function () {
            // Normal Customer
            Route::get('/list', [UserController::class, 'index'])->name('user_index');
            Route::get('/add', [UserController::class, 'addUser'])->name('add_user');
            Route::post('/save', [UserController::class, 'saveUser'])->name('save_user');
            Route::get('/view/{id}', [UserController::class, 'viewUser'])->name('user_view');
            Route::get('/edit/{id}', [UserController::class, 'editUser'])->name('user_edit');
            Route::post('/update/user', [UserController::class, 'updateUser'])->name('update_user');
            Route::post('/delete/user', [UserController::class, 'deleteUser'])->name('delete_user');
            Route::get("/check_email", [UserController::class, "checkUserEmail"])->name("check_user_email");
            Route::post("/delete/profile", [UserController::class, "deleteUserProfilePicture"])->name("delete_user_profile");

            Route::get("graph/data", [UserController::class, "graphData"])->name('get.graph.data');

            // user tickets.......

            Route::get('/view/ticket/{id}', [UserController::class, 'viewUserTickets'])->name('user_view_ticket');
            Route::post('/filter/diet/plan', [UserController::class, 'filterDietPlan'])->name('filter.diet_plan');


          Route::post("/get/plan/details", [UserController::class, "getPlanDetails"])->name("get_plan_details");
        });

        // Users Management
        Route::group(['prefix' => 'nutritionist'], function () {
            // Normal Customer
            Route::get('/list', [NutritionistController::class, 'index'])->name('nutritionist_index');
            Route::get('/add', [NutritionistController::class, 'addNutritionist'])->name('add_nutritionist');
            Route::post('/save', [NutritionistController::class, 'saveNutritionist'])->name('save_nutritionist');
            Route::get('/view/{id}', [NutritionistController::class, 'viewNutritionist'])->name('nutritionist_view');
            Route::get('/edit/{id}', [NutritionistController::class, 'editNutritionist'])->name('nutritionist_edit');
            Route::post('/update/nutritionist', [NutritionistController::class, 'updateNutritionist'])->name('update_nutritionist');
            Route::post('/delete/nutritionist', [NutritionistController::class, 'deleteNutritionist'])->name('delete_nutritionist');
            Route::get("/check_email", [NutritionistController::class, "checkNutritionistEmail"])->name("check_nutritionist_email");
            Route::get("/check_number", [NutritionistController::class, "checkNutritionistNumber"])->name("check_nutritionist_number");
            Route::post("/delete/profile", [NutritionistController::class, "deleteProfilePicture"])->name("delete_nutritionist_profile");

            Route::get("/get/users", [NutritionistController::class, "getActiveUsers"])->name("get_active_users");

            Route::post('/approve/nutritionist', [NutritionistController::class, 'approveNutritionist'])->name('approve_nutritionist');

            Route::post('/reject/nutritionist', [NutritionistController::class, 'rejectNutritionist'])->name('reject_nutritionist');

            Route::get('/view/ticket/{id}', [NutritionistController::class, 'viewUserTickets'])->name('nutritionist_view_ticket');

        });

        // Test...
        Route::group(['prefix' => 'test'], function () {
            Route::get('/list', [TestController::class, 'geneticTestList'])->name('genetic_test_list');
            Route::get('/view/{id}', [TestController::class, 'viewGeneticTest'])->name('view_genetic_test');
            Route::get('/edit/{id}', [TestController::class, 'editGeneticTest'])->name('edit_genetic_test');
            Route::post('/update', [TestController::class, 'updateGeneticTest'])->name('update_genetic_test');
            Route::post('/delete', [TestController::class, 'deleteGeneticTest'])->name('delete_genetic_test');
            Route::get('/add', [TestController::class, 'addGeneticTest'])->name('add_genetic_test');
            Route::post('/save', [TestController::class, 'saveGeneticTest'])->name('save_genetic_test');

            //Additional discount........

            Route::get('/additional-discount', [TestController::class, 'geneticTestAdditionalDiscountList'])->name('additional_test_discount');

            Route::get('/additional-discount-edit/{id}', [TestController::class, 'geneticTestAdditionalDiscountEdit'])->name('additional_test_discount_edit');

            Route::get('/additional-discount-view/{id}', [TestController::class, 'geneticTestAdditionalDiscountView'])->name('additional_test_discount_view');

            Route::post('/additional-discount-update', [TestController::class, 'geneticTestAdditionalDiscountUpdate'])->name('additional_test_discount_update');

        });

        // Diseases...
        Route::group(['prefix' => 'diseases'], function () {
            Route::get('/list', [DiseaseController::class, 'diseasesList'])->name('diseases_list');
            Route::get('/view/{id}', [DiseaseController::class, 'viewDiseases'])->name('view_diseases');
            Route::get('/edit/{id}', [DiseaseController::class, 'editDiseases'])->name('edit_diseases');
            Route::post('/update', [DiseaseController::class, 'updateDiseases'])->name('update_diseases');
            Route::post('/delete', [DiseaseController::class, 'deleteDiseases'])->name('delete_diseases');
            Route::get('/add', [DiseaseController::class, 'addDiseases'])->name('add_diseases');
            Route::post('/save', [DiseaseController::class, 'saveDiseases'])->name('save_diseases');
        });

        // Diseases...
        Route::group(['prefix' => 'allergies'], function () {
            Route::get('/list', [DiseaseController::class, 'allergyList'])->name('allergy_list');
            Route::get('/view/{id}', [DiseaseController::class, 'viewAllergy'])->name('view_allergy');
            Route::get('/edit/{id}', [DiseaseController::class, 'editAllergy'])->name('edit_allergy');
            Route::post('/update', [DiseaseController::class, 'updateAllergy'])->name('update_allergy');
            Route::post('/delete', [DiseaseController::class, 'deleteAllergy'])->name('delete_allergy');
            Route::get('/add', [DiseaseController::class, 'addAllergy'])->name('add_allergy');
            Route::post('/save', [DiseaseController::class, 'saveAllergy'])->name('save_allergy');
        });

        // AppointmentController...
        Route::group(['prefix' => 'appointments'], function () {
            Route::get('/list', [AppointmentController::class, 'AppointmentList'])->name('appointments_list');
            Route::get('/view/{id}', [AppointmentController::class, 'viewAppointment'])->name('view_appointment');
            Route::get('/edit/{id}', [AppointmentController::class, 'editAppointment'])->name('edit_appointment');
            Route::post('/update', [AppointmentController::class, 'updateAppointment'])->name('update_appointment');
            Route::post('/delete', [AppointmentController::class, 'deleteAppointment'])
                ->name('delete_appointment');
            Route::get('/add', [AppointmentController::class, 'addAppointment'])->name('add_appointment');
            Route::post('/save', [AppointmentController::class, 'saveAppointment'])->name('save_appointment');

            Route::get('/create-code-zoom', [AppointmentController::class, 'createZoomCode'])->name('create_zoom_code');
            Route::get('/refresh-code-zoom/{token}', [AppointmentController::class, 'refreshZoomCode'])->name('refresh_zoom_code');

            Route::post('/today-appoinment-details', [AppointmentController::class, 'todayAppointment'])->name('today_appointment');
            Route::post('/check-appoinment-exists', [AppointmentController::class, 'checkAppointmentExist'])->name('check_appointment_exist');

            Route::post('/scheduled-appoinment', [AppointmentController::class, 'ScheduledAppointment'])
                ->name('scheduled_appointment');

            Route::post('/scheduled-appoinment-save', [AppointmentController::class, 'ScheduledAppointmentSave'])
                ->name('scheduled_appointment_save');

            Route::get('send-mail/{id}', [AppointmentController::class, 'ScheduledAppointmentSendMail'])->name('send-mail');

            //Filter records.........
            Route::post('filter-appointments', [AppointmentController::class, 'FilterAppointment'])->name('filter.appointments');
            Route::post('cancel-appointment', [AppointmentController::class, 'CancelAppointment'])->name('cancel.appointment');
        });

        // AppointmentController...
        Route::group(['prefix' => 'api-keys'], function () {
            Route::get('/list', [ConfidentialApiKeyController::class, 'ApiKeysList'])->name('apiKey_list');
            Route::get('/view/{id}', [ConfidentialApiKeyController::class, 'viewApiKey'])->name('view_apiKey');
            Route::get('/edit/{slug}', [ConfidentialApiKeyController::class, 'editApiKey'])->name('edit_apiKey');
            Route::post('/update', [ConfidentialApiKeyController::class, 'updateApiKey'])->name('update_apiKey');

            Route::get('/edit_key/{id}', [ConfidentialApiKeyController::class, 'editApiKeyProvider'])->name('edit_api_key_provider');
        });

        //Your Health Guide Message

        Route::group(['prefix' => 'your-health-guide-message'], function () {
            Route::get('/list', [MiscController::class, 'healthGuideMessageList'])->name('health_guide_message_list');
            Route::get('/view/{id}', [MiscController::class, 'viewHealthGuideMessage'])->name('view_health_guide_message');

            Route::post('/update', [MiscController::class, 'updateHealthGuideMessage'])->name('update_health_guide_essage');

            Route::get('/edit_key/{id}', [MiscController::class, 'editHealthGuideMessageProvider'])->name('edit_health_guide_essage');
        });

        // LaboratoryController...
        Route::group(['prefix' => 'laboratories'], function () {
            Route::get('/list', [LaboratoryController::class, 'LaboratoryList'])->name('laboratories_list');
            Route::get('/view/{id}', [LaboratoryController::class, 'viewLaboratory'])->name('view_laboratory');
            Route::get('/edit/{id}', [LaboratoryController::class, 'editLaboratory'])->name('edit_laboratory');
            Route::post('/update', [LaboratoryController::class, 'updateLaboratory'])->name('update_laboratory');
            Route::post('/delete', [LaboratoryController::class, 'deleteLaboratory'])
                ->name('delete_laboratory');
            Route::get('/add', [LaboratoryController::class, 'addLaboratory'])->name('add_laboratory');
            Route::post('/save', [LaboratoryController::class, 'saveLaboratory'])->name('save_laboratory');

            Route::post('/lab_verification', [LaboratoryController::class, 'LaboratoryVerifications'])->name('verify_laboratory');
        });

        // Test...
        Route::group(['prefix' => 'reports'], function () {
            Route::get('/list', [TestReportManagementController::class, 'TestList'])->name('test_reports_list');
            Route::post('/assign-report', [TestReportManagementController::class, 'assignReport'])->name('assign_reports');
            Route::post('/get-reports-data', [TestReportManagementController::class, 'getReportData'])->name('get_reports_data');
            Route::post('/upload-reports-data', [TestReportManagementController::class, 'uploadReportData'])->name('upload_reports_data');

        });

        //Subscription Plan

        Route::group(['prefix' => 'subscription-plan'], function () {
            Route::get('/list', [SubscriptionPlanController::class, 'plansList'])->name('subscription-plan.plan_list');
            Route::get('/view/{id}', [SubscriptionPlanController::class, 'viewPlan'])->name('subscription-plan.view_plan');
            Route::get('/edit/{id}', [SubscriptionPlanController::class, 'editPlan'])->name('subscription-plan.edit_plan');
            Route::post('/update', [SubscriptionPlanController::class, 'updatePlan'])->name('subscription-plan.update_plans');
            Route::get('/add', [SubscriptionPlanController::class, 'addPlan'])->name('subscription-plan.add_plan');
            Route::post('/save', [SubscriptionPlanController::class, 'savePlan'])->name('subscription-plan.save_plan');
            Route::post('/delete', [SubscriptionPlanController::class, 'deletePlan'])->name('subscription-plan.delete_plan');
            Route::get('/deleted', [SubscriptionPlanController::class, 'deletedPlansList'])->name('subscription-plan.deleted_plans_list');
            Route::post('/restore_plan', [SubscriptionPlanController::class, 'restorePlan'])->name('subscription-plan.restore_plan');
            Route::post('/permanent_delete', [SubscriptionPlanController::class, 'permanentDeletePlan'])->name('subscription-plan.permanent_delete_plan');
            Route::post('/check', [SubscriptionPlanController::class, 'checkPlan'])->name('subscription-plan.checkPlan');
            Route::post('/change-status', [SubscriptionPlanController::class, 'changePlanStatus'])->name('subscription-plan.change_plan_status');

        });

        // Specialization.........
        Route::group(['prefix' => 'specialization'], function () {
            Route::get('/list', [SpecializationController::class, 'SpecializationList'])->name('specialization_list');
            Route::get('/add', [SpecializationController::class, 'addSpecialization'])->name('add_specialization');
            Route::post('/save', [SpecializationController::class, 'saveSpecialization'])->name('save_specialization');
            Route::get('/view/{id}', [SpecializationController::class, 'viewSpecialization'])->name('view_specialization');
            Route::get('/edit/{id}', [SpecializationController::class, 'editSpecialization'])->name('edit_specialization');
            Route::post('/update', [SpecializationController::class, 'updateSpecialization'])->name('update_specialization');
            Route::post('/delete', [SpecializationController::class, 'deleteSpecialization'])->name('delete_specialization');

        });

        // Project Features.........
        Route::group(['prefix' => 'health-complaints'], function () {
            Route::get('/list', [ProjectFeatureController::class, 'ProjectFeatureList'])->name('project_features_list');
            Route::get('/add', [ProjectFeatureController::class, 'addProjectFeature'])->name('add_project_features');
            Route::post('/save', [ProjectFeatureController::class, 'saveProjectFeature'])->name('save_project_features');
            Route::get('/view/{id}', [ProjectFeatureController::class, 'viewProjectFeature'])->name('view_project_features');
            Route::get('/edit/{id}', [ProjectFeatureController::class, 'editProjectFeature'])->name('edit_project_features');
            Route::post('/update', [ProjectFeatureController::class, 'updateProjectFeature'])->name('update_project_features');
            Route::post('/delete', [ProjectFeatureController::class, 'deleteProjectFeature'])->name('delete_project_features');

        });

        // App Features.........
        Route::group(['prefix' => 'app-features'], function () {
            Route::get('/list', [ProjectFeatureController::class, 'AppFeatureList'])->name('app_features_list');
            Route::get('/add', [ProjectFeatureController::class, 'addAppFeature'])->name('add_app_features');
            Route::post('/save', [ProjectFeatureController::class, 'saveAppFeature'])->name('save_app_features');
            Route::get('/view/{id}', [ProjectFeatureController::class, 'viewAppFeature'])->name('view_app_features');
            Route::get('/edit/{id}', [ProjectFeatureController::class, 'editAppFeature'])->name('edit_app_features');
            Route::post('/update', [ProjectFeatureController::class, 'updateAppFeature'])->name('update_app_features');
            Route::post('/delete', [ProjectFeatureController::class, 'deleteAppFeature'])->name('delete_app_features');

        });

        // Our  Teams.........
        Route::group(['prefix' => 'our-teams'], function () {
            Route::get('/list', [OurTeamController::class, 'OurTeamList'])->name('our_team_list');
            Route::get('/add', [OurTeamController::class, 'addOurTeam'])->name('add_our_team');
            Route::post('/save', [OurTeamController::class, 'saveOurTeam'])->name('save_our_team');
            Route::get('/view/{id}', [OurTeamController::class, 'viewOurTeam'])->name('view_our_team');
            Route::get('/edit/{id}', [OurTeamController::class, 'editOurTeam'])->name('edit_our_team');
            Route::post('/update', [OurTeamController::class, 'updateOurTeam'])->name('update_our_team');
            Route::post('/delete', [OurTeamController::class, 'deleteOurTeam'])->name('delete_our_team');

        });

        // Notification.........
        Route::group(['prefix' => 'notification'], function () {
            Route::get('/list', [NotificationController::class, 'NotificationList'])->name('notification_list');
            Route::get('/add', [NotificationController::class, 'addNotification'])->name('add_notification');
            Route::post('/save', [NotificationController::class, 'saveNotification'])->name('save_notification');
            Route::get('/view/{id}', [NotificationController::class, 'viewNotification'])->name('view_notification');
            Route::get('/edit/{id}', [NotificationController::class, 'editNotification'])->name('edit_notification');
            Route::post('/update', [NotificationController::class, 'updateNotification'])->name('update_notification');
            Route::post('/delete', [NotificationController::class, 'deleteNotification'])->name('delete_notification');

            //Send Notifications...
            Route::get('/send', [NotificationController::class, 'sendNotification'])->name('send_notification');
            Route::post('/send-store', [NotificationController::class, 'sendStoreNotification'])->name('send_store_notification');

        });

        // account settings
        Route::group(['prefix' => 'account-setting'], function () {
            Route::get('/kyc', [AdminsController::class, 'kyc'])->name('kyc');
            Route::post('/submit-kyc', [AdminsController::class, 'submit_kyc'])->name('submit-kyc');
            Route::get('/account-list', [AdminsController::class, 'account_list'])->name('account-list');
            Route::get('/account', [AdminsController::class, 'account'])->name('account');
            Route::get('/view-account/{id}', [AdminsController::class, 'view_account'])->name('view-account');
            Route::post('/submit-account', [AdminsController::class, 'submit_account'])->name('submit-account');
        });
        // account settings

        // Blog Management //

        Route::group(["prefix" => "blogs"], function () {
            Route::get("list", [BlogController::class, "blogList"])->name(
                "blogs.list"
            );
            Route::get("add", [BlogController::class, "addBlog"])->name(
                "blogs.add"
            );
            Route::post("save", [BlogController::class, "saveBlog"])->name(
                "blogs.save"
            );
            Route::get("view/{id}", [BlogController::class, "viewBlog"])->name(
                "blogs.view"
            );
            Route::get("edit/{id}", [BlogController::class, "editBlog"])->name(
                "blogs.edit"
            );
            Route::post("update", [BlogController::class, "updateBlog"])->name(
                "blogs.update"
            );
            Route::post("delete", [BlogController::class, "deleteBlog"])->name(
                "blogs.delete"
            );
            Route::post("delete-blog-image", [BlogController::class, "deleteBlogImage"])->name(
                "delete.blog_image_delete"
            );
            Route::post("editor/image_upload", [BlogController::class, "upload"])->name(
                "upload"
            );
            Route::post("verify", [BlogController::class, "verifyBlog"])->name(
                "blogs.verify"
            );

        });

        // Add Social Media Data //

        Route::group(["prefix" => "social-media"], function () {
            Route::get("list", [
                SocialMediaController::class,
                "socialmediaList",
            ])->name("social-media.list");
            Route::get("/add", [
                SocialMediaController::class,
                "addSocialMedia",
            ])->name("add.social_media");
            Route::post("/save", [
                SocialMediaController::class,
                "saveSocialMedia",
            ])->name("save.social_media");
            Route::get("/view/{id}", [
                SocialMediaController::class,
                "viewSocialMedia",
            ])->name("view.social_media");
            Route::get("/edit/{id}", [
                SocialMediaController::class,
                "editSocialMedia",
            ])->name("edit.social_media");
            Route::post("/update", [
                SocialMediaController::class,
                "updateSocialMedia",
            ])->name("update.social_media");
            Route::post("/delete", [
                SocialMediaController::class,
                "deleteSocialMedia",
            ])->name("delete.social_media");
            Route::post("/delete-image", [
                SocialMediaController::class,
                "deleteSocialMediaImage",
            ])->name("delete.social_media_image");
        });

        //Customer Reviews

        Route::group(["prefix" => "client-review"], function () {
            Route::get("list", [ClientReviewController::class, "ClientReviewsList"])->name(
                "client.review.list"
            );
            Route::get("add", [ClientReviewController::class, "addClientReview"])->name(
                "client.review.add"
            );
            Route::post("save", [ClientReviewController::class, "saveClientReview"])->name(
                "client.review.save"
            );
            Route::get("view/{id}", [ClientReviewController::class, "viewClientReview"])->name(
                "client.review.view"
            );
            Route::get("edit/{id}", [ClientReviewController::class, "editClientReview"])->name(
                "client.review.edit"
            );
            Route::post("update", [ClientReviewController::class, "updateClientReview"])->name(
                "client.review.update"
            );
            Route::post("delete", [ClientReviewController::class, "deleteClientReview"])->name(
                "client.review.delete"
            );
            Route::post("delete-blog-image", [ClientReviewController::class, "deleteClientReviewImage"])->name(
                "delete.client_image_delete"
            );
        });

        //start recipe category coding..........

        Route::group(["prefix" => "recipe-category"], function () {
            Route::get("list", [RecipeCategoryController::class, "RecipeCategoriesList"])->name(
                "recipe.category.list"
            );
            Route::get("add", [RecipeCategoryController::class, "addRecipeCategory"])->name(
                "recipe.category.add"
            );
            Route::post("save", [RecipeCategoryController::class, "saveRecipeCategory"])->name(
                "recipe.category.save"
            );
            Route::get("view/{id}", [RecipeCategoryController::class, "viewRecipeCategory"])->name(
                "recipe.category.view"
            );
            Route::get("edit/{id}", [RecipeCategoryController::class, "editRecipeCategory"])->name(
                "recipe.category.edit"
            );
            Route::post("update", [RecipeCategoryController::class, "updateRecipeCategory"])->name(
                "recipe.category.update"
            );
            Route::post("delete", [RecipeCategoryController::class, "deleteRecipeCategory"])->name(
                "recipe.category.delete"
            );
            // Route::post("delete-blog-image", [RecipeCategoryController::class, "deleteRecipeCategoryImage"])->name(
            //     "delete.recipe.category.delete"
            // );
        });

        // End recipe category coding...........

        //start recipe   coding..........

        Route::group(["prefix" => "recipe"], function () {
            Route::get("list", [RecipeController::class, "RecipeList"])->name(
                "recipe.list"
            );
            Route::get("add", [RecipeController::class, "addRecipe"])->name(
                "recipe.add"
            );
            Route::post("save", [RecipeController::class, "saveRecipe"])->name(
                "recipe.save"
            );
            Route::get("view/{id}", [RecipeController::class, "viewRecipe"])->name(
                "recipe.view"
            );
            Route::get("edit/{id}", [RecipeController::class, "editRecipe"])->name(
                "recipe.edit"
            );
            Route::post("update", [RecipeController::class, "updateRecipe"])->name(
                "recipe.update"
            );
            Route::post("delete", [RecipeController::class, "deleteRecipe"])->name(
                "recipe.delete"
            );

        });

        // End recipe   coding...........

        //start  food coding..........

        Route::group(["prefix" => "food"], function () {
            Route::get("list", [FoodController::class, "FoodList"])->name(
                "food.list"
            );
            Route::get("custom-add", [FoodController::class, "addCustomFood"])->name(
                "food.custom.add"
            );

            Route::get("edamam-add", [FoodController::class, "addEdamamFood"])->name(
                "food.edamam.add"
            );

            Route::post("save", [FoodController::class, "saveFood"])->name(
                "food.save"
            );
            Route::get("view/{id}", [FoodController::class, "viewFood"])->name(
                "food.view"
            );
            Route::get("edit/{id}", [FoodController::class, "editFood"])->name(
                "food.edit"
            );
            Route::post("update", [FoodController::class, "updateFood"])->name(
                "food.update"
            );
            Route::post("delete", [FoodController::class, "deleteFood"])->name(
                "food.delete"
            );

            Route::post("get-edamam-food", [FoodController::class, "getEdamamFood"])->name(
                "get.edamam.food"
            );

            Route::post("add-edamam-food-by-id", [FoodController::class, "addEdamamFoodById"])->name(
                "add.edamam.food.by.id"
            );

            Route::get("edamam-food", [FoodController::class, "EdamamFood"])->name(
                "edamam.food"
            );

            Route::get("food.import", [FoodController::class, "foodImport"])->name(
                "food.import"
            );

            Route::post("upload-file", [FoodController::class, "foodUpload"])->name(
                "food.upload"
            );
            
            Route::post("get-measure-nutrition", [FoodController::class, "getMeasureNutrition"])->name(
                "get.measure.nutrition"
            );

            // Route::post("delete-blog-image", [FoodController::class, "deleteRecipeCategoryImage"])->name(
            //     "delete.recipe.category.delete"
            // );
        });

        // end food coding ..............

        // Start Dite Category.............

        Route::group(["prefix" => "diet-category"], function () {
            Route::get("list", [DiteCategoryController::class, "DiteCategoriesList"])->name(
                "dite.category.list"
            );
            Route::get("add", [DiteCategoryController::class, "addDiteCategory"])->name(
                "dite.category.add"
            );
            Route::post("save", [DiteCategoryController::class, "saveDiteCategory"])->name(
                "dite.category.save"
            );
            Route::get("view/{id}", [DiteCategoryController::class, "viewDiteCategory"])->name(
                "dite.category.view"
            );
            Route::get("edit/{id}", [DiteCategoryController::class, "editDiteCategory"])->name(
                "dite.category.edit"
            );
            Route::post("update", [DiteCategoryController::class, "updateDiteCategory"])->name(
                "dite.category.update"
            );
            Route::post("delete", [DiteCategoryController::class, "deleteDiteCategory"])->name(
                "dite.category.delete"
            );
            // Route::post("delete-blog-image", [DiteCategoryController::class, "deletediteCategoryImage"])->name(
            //     "delete.dite.category.delete"
            // );
        });

        // End Dite Category....................

        // Start Dites  .............

        Route::group(["prefix" => "diets"], function () {
            Route::get("list", [DietController::class, "DietsList"])->name(
                "diet.list"
            );
            Route::get("add", [DietController::class, "addDiet"])->name(
                "diet.add"
            );
            Route::post("save", [DietController::class, "saveDiet"])->name(
                "diet.save"
            );
            Route::get("view/{id}", [DietController::class, "viewDiet"])->name(
                "diet.view"
            );
            Route::get("edit/{id}", [DietController::class, "editDiet"])->name(
                "diet.edit"
            );
            Route::post("update", [DietController::class, "updateDiet"])->name(
                "diet.update"
            );
            Route::post("delete", [DietController::class, "deleteDiet"])->name(
                "diet.delete"
            );
            // Route::post("delete-blog-image", [DietController::class, "deletedietImage"])->name(
            //     "delete.diet..delete"
            // );

        });

        //FoodPreference

        Route::group(["prefix" => "food-preferences"], function () {
            Route::get("list", [ProjectFeatureController::class, "FoodPreferencesList"])->name(
                "food.preference.list"
            );
            Route::get("add", [ProjectFeatureController::class, "addFoodPreference"])->name(
                "food.preference.add"
            );
            Route::post("save", [ProjectFeatureController::class, "saveFoodPreference"])->name(
                "food.preference.save"
            );
            Route::get("view/{id}", [ProjectFeatureController::class, "viewFoodPreference"])->name(
                "food.preference.view"
            );
            Route::get("edit/{id}", [ProjectFeatureController::class, "editFoodPreference"])->name(
                "food.preference.edit"
            );
            Route::post("update", [ProjectFeatureController::class, "updateFoodPreference"])->name(
                "food.preference.update"
            );
            Route::post("delete", [ProjectFeatureController::class, "deleteFoodPreference"])->name(
                "food.preference.delete"
            );

        });

        // End Dites  ....................

        // CurrentOpeningController...
        Route::group(['prefix' => 'current-openings'], function () {
            Route::get('/list', [CurrentOpeningController::class, 'CurrentOpeningList'])->name('current_opening_list');
            Route::get('/view/{id}', [CurrentOpeningController::class, 'viewCurrentOpening'])->name('view_current_opening');
            Route::get('/edit/{id}', [CurrentOpeningController::class, 'editCurrentOpening'])->name('edit_current_opening');
            Route::post('/update', [CurrentOpeningController::class, 'updateCurrentOpening'])->name('update_current_opening');
            Route::post('/delete', [CurrentOpeningController::class, 'deleteCurrentOpening'])
                ->name('delete_current_opening');
            Route::get('/add', [CurrentOpeningController::class, 'addCurrentOpening'])->name('add_current_opening');
            Route::post('/save', [CurrentOpeningController::class, 'saveCurrentOpening'])->name('save_current_opening');
        });

        // Exercise...
        Route::group(['prefix' => 'exercises'], function () {
            Route::get('/list', [ExerciseController::class, 'exerciseList'])->name('exercise_list');
            Route::get('/view/{id}', [ExerciseController::class, 'viewExercise'])->name('view_exercise');
            Route::get('/edit/{id}', [ExerciseController::class, 'editExercise'])->name('edit_exercise');
            Route::post('/update', [ExerciseController::class, 'updateExercise'])->name('update_exercise');
            Route::post('/delete', [ExerciseController::class, 'deleteExercise'])->name('delete_exercise');
            Route::get('/add', [ExerciseController::class, 'addExercise'])->name('add_exercise');
            Route::post('/save', [ExerciseController::class, 'saveExercise'])->name('save_exercise');
        });

        // Contact Us
        Route::group(["prefix" => "contact_us"], function () {
            Route::post("/status", [
                ContactUsController::class,
                "statusUpdate",
            ])->name("contact.status.update");
            Route::get("/list", [
                ContactUsController::class,
                "contactUsMessagesList",
            ])->name("contact_us_message_list");
            Route::get("/view/{id}", [
                ContactUsController::class,
                "viewContactUsMessage",
            ])->name("view_contact_us_message");

        });

        //Tickets.........

        Route::group(['prefix' => 'tickets'], function () {

            Route::get('/list', [TicketsController::class, 'ticketsList'])->name('ticket_list');
            Route::get('/view/{id}', [TicketsController::class, 'view'])->name('ticket.view');
            Route::post('/assign-tickets', [TicketsController::class, 'assignTickets'])->name('assign_tickets');
            //------------------
            Route::get('/edit/{id}', [TicketsController::class, 'editTicket'])->name('ticket.edit');
            Route::post('/update', [TicketsController::class, 'update'])->name('ticket.update');
            Route::get('/view/{id}', [TicketsController::class, 'view'])->name('ticket.view');
            Route::get('/add', [TicketsController::class, 'add'])->name('ticket.add');
            Route::post('/save', [TicketsController::class, 'save'])->name('ticket.save');
            Route::post('/delete', [TicketsController::class, 'delete'])->name('ticket.delete');
            Route::post('/change-status', [TicketsController::class, 'changeStatus'])->name('change.ticket.status');
            Route::post('/ticket-send-message', [TicketsController::class, 'sendMessage'])->name('ticket.send.message');

        });

        // end tickets...........

        // Subscribers Us
        Route::group(["prefix" => "subscribers"], function () {
            Route::post("/status", [
                ContactUsController::class,
                "statusSubscribersUpdate",
            ])->name("subscribers.status.update");
            Route::get("/list", [
                ContactUsController::class,
                "SubscribersList",
            ])->name("subscribers.list");
            Route::get("/view/{id}", [
                ContactUsController::class,
                "viewSubscribers",
            ])->name("view.subscribers");

        });

        //Misc Data MiscController Consultant

        Route::group(["prefix" => "consultations"], function () {
            Route::get("list", [MiscController::class, "ConsultationList"])->name(
                "consultation.list"
            );
            Route::get("view/{id}", [MiscController::class, "viewConsultation"])->name(
                "consultation.view"
            );
            Route::get("edit/{id}", [MiscController::class, "editConsultation"])->name(
                "consultation.edit"
            );
            Route::post("update", [MiscController::class, "updateConsultation"])->name(
                "consultation.update"
            );
        });

        // Diet Subscription Plan seeder........

        Route::group(["prefix" => "diet-subscription-plan"], function () {
            Route::get("list", [MiscController::class, "DietSubscriptionPlanList"])->name(
                "diet.subscription.plan.list"
            );
            Route::get("view/{id}", [MiscController::class, "viewDietSubscriptionPlan"])->name(
                "diet.subscription.plan.view"
            );
            Route::get("edit/{id}", [MiscController::class, "editDietSubscriptionPlan"])->name(
                "diet.subscription.plan.edit"
            );
            Route::post("update", [MiscController::class, "updateDietSubscriptionPlan"])->name(
                "diet.subscription.plan.update"
            );

            // Customize sub plans.............

            Route::post("get/html", [MiscController::class, "getHTML"])->name("get.html");
            Route::post("get/pricing/details", [MiscController::class, "getPricingDetails"])->name("get.pricing.details");
            Route::post("get/pricing/details/by/dietId", [MiscController::class, "getPricingDetailsByDietId"])->name("get.pricing..details.bydietid");
            Route::post("save/sub/plans]", [MiscController::class, "saveSubPlans"])->name("save.sub.plans"); 

            Route::post("delete/sub/plans]", [MiscController::class, "deleteSubPlan"])->name("delete.sub.plan"); 

        });

        // Diet Subscription Featues  .......

        //Diet Sub Subscription Plan Seeder.........


      Route::group(["prefix" => "diet-subscription-sub-plan"], function () {
            Route::get("list", [DietPlanSubscriptionSubController::class, "DietSubscriptionSubPlanList"])->name(
                "diet.subscription.sub.plan.list"
            );

             Route::get('/add', [DietPlanSubscriptionSubController::class, 'addDietSubscriptionSubPlan'])->name('diet.subscription.sub.plan.add');
            Route::post('/save', [DietPlanSubscriptionSubController::class, 'saveDietSubscriptionSubPlan'])->name('diet.subscription.sub.plan.save');

            Route::get("view/{id}", [DietPlanSubscriptionSubController::class, "viewDietSubscriptionSubPlan"])->name(
                "diet.subscription.sub.plan.view"
            );
            Route::get("edit/{id}", [DietPlanSubscriptionSubController::class, "editDietSubscriptionSubPlan"])->name(
                "diet.subscription.sub.plan.edit"
            );
            Route::post("update", [DietPlanSubscriptionSubController::class, "updateDietSubscriptionSubPlan"])->name(
                "diet.subscription.sub.plan.update"
            );

             Route::post("delete/planduration", [DietPlanSubscriptionSubController::class, "deleteDietSubscriptionSubPlanDuration"])->name(
                "delete.diet.subscription.sub.plan.duration"
            );
        });


           Route::group(["prefix" => "diet-subscription-sub-plan-pricing"], function () {
            Route::get("list", [DietPlanSubscriptionSubController::class, "DietSubscriptionSubPlanPricingList"])->name(
                "diet.subscription.sub.plan.pricing.list"
            );

             Route::get('/add', [DietPlanSubscriptionSubController::class, 'addDietSubscriptionSubPlanPricing'])->name('diet.subscription.sub.plan.pricing.add');
            Route::post('/save', [DietPlanSubscriptionSubController::class, 'saveDietSubscriptionSubPlanPricing'])->name('diet.subscription.sub.plan.pricing.save');

            Route::get("view/{id}", [DietPlanSubscriptionSubController::class, "viewDietSubscriptionSubPlanPricing"])->name(
                "diet.subscription.sub.plan.pricing.view"
            );
            Route::get("edit/{id}", [DietPlanSubscriptionSubController::class, "editDietSubscriptionSubPlanPricing"])->name(
                "diet.subscription.sub.plan.pricing.edit"
            );
            Route::post("update", [DietPlanSubscriptionSubController::class, "updateDietSubscriptionSubPlanPricing"])->name(
                "diet.subscription.sub.plan.pricing.update"
            );
        });




            // Diet Subscription Featues  .......


        Route::group(["prefix" => "diet-subscription-feature"], function () {
            Route::get("list", [MiscController::class, "DietSubscriptionFeatureList"])->name("diet.subscription.features.list");

            Route::get("add", [MiscController::class, "DietSubscriptionFeatureAdd"])->name(
                "diet.subscription.feature.add"
            );

            Route::post("save", [MiscController::class, "DietSubscriptionFeatureSave"])->name(
                "diet.subscription.feature.save"
            );

            Route::get("view/{id}", [MiscController::class, "viewDietSubscriptionFeature"])->name(
                "diet.subscription.feature.view"
            );
            Route::get("edit/{id}", [MiscController::class, "editDietSubscriptionFeature"])->name(
                "diet.subscription.feature.edit"
            );
            Route::post("update", [MiscController::class, "updateDietSubscriptionFeature"])->name(
                "diet.subscription.feature.update"
            );

            Route::post("delete", [MiscController::class, "deleteDietSubscriptionFeature"])->name(
                "diet.subscription.feature.delete"
            );

            Route::post("check-features", [MiscController::class, "DietSubscriptionCheckFeature"])->name(
                "subscription.feature.check"
            );
        });

        // Diet Subscription Plan Feature seeder........

        Route::group(["prefix" => "diet-subscription-plan-feature"], function () {
            Route::get("list", [MiscController::class, "DietSubscriptionPlanFeatureList"])->name(
                "diet.subscription.plan.feature.list"
            );
            Route::get("view/{id}", [MiscController::class, "viewDietSubscriptionPlanFeature"])->name(
                "diet.subscription.plan.feature.view"
            );
            Route::get("edit/{id}", [MiscController::class, "editDietSubscriptionPlanFeature"])->name(
                "diet.subscription.plan.feature.edit"
            );
            Route::post("update", [MiscController::class, "updateDietSubscriptionPlanFeature"])->name(
                "diet.subscription.plan.feature.update"
            );
        });

        // Meal Templates meal_templates

        Route::group(["prefix" => "meal-templates"], function () {
            Route::get("list", [MiscController::class, "MealTemplateList"])->name(
                "meal.template.list"
            );
            Route::get("view/{id}", [MiscController::class, "viewMealTemplate"])->name(
                "meal.template.view"
            );
            Route::get("edit/{id}", [MiscController::class, "editMealTemplate"])->name(
                "meal.template.edit"
            );
            Route::post("update", [MiscController::class, "updateMealTemplate"])->name(
                "meal.template.update"
            );
        });

        Route::group(["prefix" => "consultation-session"], function () {
            Route::get("list", [ConsultantSessionController::class, "ConsultationSessionList"])->name(
                "consultation.session.list"
            );
            Route::get("view/{id}", [ConsultantSessionController::class, "viewConsultationSession"])->name(
                "consultation.session.view"
            );
            Route::get("edit/{id}", [ConsultantSessionController::class, "editConsultationSession"])->name(
                "consultation.session.edit"
            );
            Route::post("update", [ConsultantSessionController::class, "updateConsultationSession"])->name(
                "consultation.session.update"
            );

            Route::post("delete", [ConsultantSessionController::class, "DeleteConsultationSession"])->name(
                "consultation.session.delete"
            );
        });

        //ReferralPatientController
        Route::group(["prefix" => "referral-patients"], function () {
            Route::get("list", [ReferralPatientController::class, "ReferralPatientList"])->name(
                "referral.patients.list"
            );
            Route::get("view/{id}", [ReferralPatientController::class, "viewReferralPatient"])->name(
                "referral.patients.view"
            );

            Route::post("delete", [ReferralPatientController::class, "DeleteReferralPatient"])->name(
                "referral.patients.delete"
            );

        });

        //Payment Transaction
        Route::group(['prefix' => 'payment_transactions'], function () {
            Route::get('/list', [PaymentTransactionController::class, 'transactionList'])->name('payment_transactions.list');

            Route::get('/view/{id}', [PaymentTransactionController::class, 'viewTransaction'])->name('payment_transactions.view');

            Route::post('/payment_filter', [PaymentTransactionController::class, 'filterTransaction'])->name('filter_transactions');
            Route::post('/payment_filter_month_year', [PaymentTransactionController::class, 'filterTransactionMonthYear'])->name('filter_transactions_month_year');

            Route::post('/reset', [PaymentTransactionController::class, 'reset'])->name('payment_transactions_reset');
        });

        //start trait coding......

        Route::group(["prefix" => "trait-category"], function () {
            Route::get("list", [TraitController::class, "TraitCategoriesList"])->name(
                "trait.category.list"
            );

            Route::get("add", [TraitController::class, "addTraitCategory"])->name(
                "trait.category.add"
            );
            Route::post("save", [TraitController::class, "saveTraitCategory"])->name(
                "trait.category.save"
            );
            Route::get("view/{id}", [TraitController::class, "viewTraitCategory"])->name(
                "trait.category.view"
            );
            Route::get("edit/{id}", [TraitController::class, "editTraitCategory"])->name(
                "trait.category.edit"
            );
            Route::post("update", [TraitController::class, "updateTraitCategory"])->name(
                "trait.category.update"
            );
            Route::post("delete", [TraitController::class, "deleteTraitCategory"])->name(
                "trait.category.delete"
            );

        });

        Route::group(["prefix" => "traits"], function () {
            Route::get("list", [TraitController::class, "TraitsList"])->name(
                "trait.list"
            );

            Route::get("add", [TraitController::class, "addTrait"])->name(
                "trait.add"
            );
            Route::post("save", [TraitController::class, "saveTrait"])->name(
                "trait.save"
            );
            Route::get("view/{id}", [TraitController::class, "viewTrait"])->name(
                "trait.view"
            );
            Route::get("edit/{id}", [TraitController::class, "editTrait"])->name(
                "trait.edit"
            );
            Route::post("update", [TraitController::class, "updateTrait"])->name(
                "trait.update"
            );
            Route::post("delete", [TraitController::class, "deleteTrait"])->name(
                "trait.delete"
            );

            //Additional discount........

            Route::get('/additional-discount', [TraitController::class, 'traitAdditionalDiscountList'])->name('additional_trait_discount');

            Route::get('/additional-discount-edit/{id}', [TraitController::class, 'traitAdditionalDiscountEdit'])->name('additional_trait_discount_edit');

            Route::get('/additional-discount-view/{id}', [TraitController::class, 'traitAdditionalDiscountView'])->name('additional_trait_discount_view');

            Route::post('/additional-discount-update', [TraitController::class, 'traitAdditionalDiscountUpdate'])->name('additional_trait_discount_update');

        });
        
        //RDV Values...........

        Route::group(['prefix' => 'rda'], function () {
            Route::get('/list', [RdaValueController::class, 'RdaValueList'])->name('rda_value_list');
            Route::get('/add', [RdaValueController::class, 'RdaValueAdd'])->name('rda_value_add');
            Route::post('/save', [RdaValueController::class, 'RdaValueSave'])->name('rda_value_save');
            Route::get('/view/{id}', [RdaValueController::class, 'viewRdaValue'])->name('rda_value_view');
            Route::get('/edit/{id}', [RdaValueController::class, 'editRdaValue'])->name('rda_value_edit');
            Route::post('/update', [RdaValueController::class, 'updateRdaValue'])->name('rda_value_update');
              Route::post("delete", [TraitController::class, "deleteRdaValue"])->name(
                "rda.delete"
            );
        });

        //end traint coding...........

        // configuration
        Route::get('/configuration', [ConfigurationController::class, 'configuration'])->name('configuration');
        Route::get('/configuration/edit/{id}', [ConfigurationController::class, 'editConfiguration'])->name('configuration.edit');
        Route::post('/configuration/update', [ConfigurationController::class, 'updateConfiguration'])->name('configuration.update');
        // configuration

        // Admins
        Route::group(['prefix' => 'admins'], function () {
            Route::get('/list', [AdminsController::class, 'adminsList'])->name('admins_list');
            Route::get('/view/{id}', [AdminsController::class, 'viewAdmin'])->name('view_admin');
            Route::get('/edit/{id}', [AdminsController::class, 'editAdmin'])->name('edit_admin');
            Route::post('/update', [AdminsController::class, 'updateAdmin'])->name('update_admin');
            Route::post('/delete', [AdminsController::class, 'deleteAdmin'])
                ->name('delete_admin');
            Route::get('/add', [AdminsController::class, 'addAdmin'])->name('add_admin');
            Route::post('/save', [AdminsController::class, 'saveAdmin'])->name('save_admin');
            Route::post('/check_email', [AdminsController::class, 'checkEmail'])->name('check_email');
            Route::post('/filter', [AdminsController::class, 'filter'])->name('admins.filter');
        });

        // Access Controls
        Route::group(['prefix' => 'roles'], function () {
            Route::get('/list', [RolesController::class, 'rolesList'])->name('roles_list');
            Route::get('/view/{id}', [RolesController::class, 'viewRole'])->name('view_role');
            Route::get('/add', [RolesController::class, 'addRole'])->name('add_role');
            Route::post('/save', [RolesController::class, 'saveRole'])->name('save_role');
            Route::get('/edit/{id}', [RolesController::class, 'editRole'])->name('edit_role');
            Route::post('/update', [RolesController::class, 'updateRole'])->name('update_role');
            Route::post('/get_role_permissions', [RolesController::class, 'getRolePermissions'])->name('get_role_permissions');
            Route::post('/save_permissions', [RolesController::class, 'saveRolePermissions'])->name('save_permissions');
            Route::post('/delete', [RolesController::class, 'deleteRole'])->name('delete_role');
        });
        Route::get('/role_permissions', [RolesController::class, 'rolePermissions'])->name('role_permissions');
        // Content Management
        Route::group(['prefix' => 'content'], function () {

            Route::group(['prefix' => 'website'], function () {
                Route::get('/list', [ContentController::class, 'websitePagesList'])->name('website_pages_list');
                Route::get('/view/{id}', [ContentController::class, 'viewWebsitePage'])->name('view_website_page');
                Route::get('/edit/{id}', [ContentController::class, 'editWebsitePage'])->name('edit_website_page');
                Route::post('/update', [ContentController::class, 'updateWebsitePage'])->name('update_website_page');

                //For Seeders................

                Route::get('/logs-list', [ContentController::class, 'websitePagesSeederList'])->name('website_pages_seeder_list');

                Route::post('/run-log-list', [ContentController::class, 'websitePagesSeederRun'])->name('website_pages_seeder_run_list');

            });

           

            Route::group(['prefix' => 'faq'], function () {
                Route::get('/list', [ContentController::class, 'mobilePagesFaqList'])->name('mobile_pages_faq_list');
                Route::get('/add', [ContentController::class, 'mobilePagesFaqAdd'])->name('mobile_pages_faq_add');
                Route::post('/save', [ContentController::class, 'mobilePagesFaqSave'])->name('mobile_pages_faq_save');
                Route::get('/view/{id}', [ContentController::class, 'viewMobileFaqPage'])->name('mobile_pages_faq_view');
                Route::get('/edit/{id}', [ContentController::class, 'editMobileFaqPage'])->name('mobile_pages_faq_edit');
                Route::post('/update', [ContentController::class, 'updateMobileFaqPage'])->name('mobile_pages_faq_update');
            });

            Route::group(['prefix' => 'mobile'], function () {
                Route::get('/list', [ContentController::class, 'mobilePagesList'])->name('mobile_pages_list');
                Route::get('/view/{id}', [ContentController::class, 'viewMobilePage'])->name('view_mobile_page');
                Route::get('/edit/{id}', [ContentController::class, 'editMobilePage'])->name('edit_mobile_page');
                Route::post('/update', [ContentController::class, 'updateMobilePage'])->name('update_mobile_page');
            });

            Route::group(['prefix' => 'media'], function () {
                Route::get('/list', [MediaController::class, 'MediaList'])->name('media_list');
                Route::get('edit-page-media/{slug}', [MediaController::class, 'editPageMedia'])->name('media-page.edit');
                Route::get('edit-section-media/{id}', [MediaController::class, 'editSectionMedia'])->name('sections-media.editpage');
                Route::post('update-section-image', [MediaController::class, 'updateSectionsImage'])->name('media-section.update');
                Route::post('delete_page_media', [MediaController::class, 'deleteMediaSection'])->name('media-section.delete');

            });

        });

        // Recycle Bin
        Route::group(['prefix' => 'recycle_bin'], function () {

            Route::group(['prefix' => 'user-management'], function () {
                Route::group(['prefix' => 'users'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedUsersList'])->name('deleted_users_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreUser'])->name('restore_user');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteUser'])->name('permanent_delete_user');
                });

                Route::group(['prefix' => 'nutritionist'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedNutritionistList'])->name('deleted_nutritionist_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreNutritionist'])->name('restore_nutritionist');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteNutritionist'])->name('permanent_delete_nutritionist');
                });

                Route::group(['prefix' => 'admins'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedAdminsList'])->name('deleted_admins_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreAdmin'])->name('restore_admin');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteAdmin'])->name('permanent_delete_admin');
                });
            });

            Route::group(['prefix' => 'laboratory-management'], function () {
                Route::group(['prefix' => 'laboratories'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedLaboratoriesList'])->name('deleted_laboratories_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreLaboratories'])->name('restore_laboratories');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteLaboratories'])->name('permanent_delete_laboratories');
                });
            });

            Route::group(['prefix' => 'consultant-sessions-management'], function () {
                Route::group(['prefix' => 'consultant-sessions'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedConsultantSessionsList'])->name('deleted_consultant_sessions_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreConsultantSessions'])->name('restore_consultant_sessions');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteConsultantSessions'])->name('permanent_delete_consultant_sessions');
                });
            });

            Route::group(['prefix' => 'clinicians-management'], function () {
                Route::group(['prefix' => 'clinicians'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedCliniciansList'])->name('deleted_clinicians_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreClinicians'])->name('restore_clinicians');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteClinicians'])->name('permanent_delete_clinicians');
                });
            });

            Route::group(['prefix' => 'users-feedback-management'], function () {
                Route::group(['prefix' => 'testimonials'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedTestimonialsList'])->name('deleted_testimonials_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreTestimonials'])->name('restore_testimonials');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteTestimonials'])->name('permanent_delete_testimonials');
                });
            });

            Route::group(['prefix' => 'content-management'], function () {
                Route::group(['prefix' => 'social-links'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedSocialLinksList'])->name('deleted_social_links_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreSocialLinks'])->name('restore_social_links');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteSocialLinks'])->name('permanent_delete_social_links');
                });
            });

            Route::group(['prefix' => 'misc-data-management'], function () {

                Route::group(['prefix' => 'blogs'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedBlogsList'])->name('deleted_blogs_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreBlogs'])->name('restore_blogs');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteBlogs'])->name('permanent_delete_blogs');
                });

                Route::group(['prefix' => 'specializations'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedSpecializationList'])->name('deleted_specialization');
                    Route::post('/restore', [RecycleBinController::class, 'restoreSpecialization'])->name('restore_specialization');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteSpecialization'])->name('permanent_delete_specialization');
                });

                Route::group(['prefix' => 'health-complaints'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedHealthComplaintsList'])->name('deleted_health_complaints');
                    Route::post('/restore', [RecycleBinController::class, 'restoreHealthComplaints'])->name('restore_health_complaints');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteHealthComplaints'])->name('permanent_delete_health_complaints');
                });

                Route::group(['prefix' => 'our-teams'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedOurTeamsList'])->name('deleted_our_teams');
                    Route::post('/restore', [RecycleBinController::class, 'restoreOurTeams'])->name('restore_our_teams');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteOurTeams'])->name('permanent_delete_our_teams');
                });

                Route::group(['prefix' => 'test'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedTestList'])->name('deleted_test_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreTest'])->name('restore_test');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteTest'])->name('permanent_delete_test');
                });

                Route::group(['prefix' => 'job'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedJobList'])->name('deleted_job_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreJob'])->name('restore_job');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteJob'])->name('permanent_delete_job');
                });

                Route::group(['prefix' => 'exercise'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedExerciseList'])->name('deleted_exercise_list');
                    Route::post('/restore', [RecycleBinController::class, 'restoreExercise'])->name('restore_exercise');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteExercise'])->name('permanent_delete_exercise');
                });

                Route::group(['prefix' => 'recipe-category'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedRecipeCategoryList'])->name('deleted_recipe_category');
                    Route::post('/restore', [RecycleBinController::class, 'restoreRecipeCategory'])->name('restore_recipe_category');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteRecipeCategory'])->name('permanent_delete_recipe_category');
                });

                Route::group(['prefix' => 'recipes'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedRecipesList'])->name('deleted_recipes');
                    Route::post('/restore', [RecycleBinController::class, 'restoreRecipes'])->name('restore_recipes');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteRecipes'])->name('permanent_delete_recipes');
                });

                Route::group(['prefix' => 'diet-category'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedDietCategoryList'])->name('deleted_diet_category');
                    Route::post('/restore', [RecycleBinController::class, 'restoreDietCategory'])->name('restore_diet_category');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteDietCategory'])->name('permanent_delete_diet_category');
                });

                Route::group(['prefix' => 'diets'], function () {
                    Route::get('/deleted', [RecycleBinController::class, 'deletedDietsList'])->name('deleted_diets');
                    Route::post('/restore', [RecycleBinController::class, 'restoreDiets'])->name('restore_diets');
                    Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteDiets'])->name('permanent_delete_diets');
                });

            });

            Route::group(['prefix' => 'subscription-plans'], function () {
                Route::get('/deleted', [RecycleBinController::class, 'deletedSubscriptionPlanList'])->name('deleted_subscription_plan_list');
                Route::post('/restore', [RecycleBinController::class, 'restoreSubscriptionPlan'])->name('restore_subscription_plan');
                Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteSubscriptionPlan'])->name('permanent_delete_subscription_plan');
            });

            Route::group(['prefix' => 'specializations'], function () {
                Route::get('/deleted', [RecycleBinController::class, 'deletedSpecializationsList'])->name('deleted_specializations_list');
                Route::post('/restore', [RecycleBinController::class, 'restoreSpecializations'])->name('restore_specializations');
                Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteSpecializations'])->name('permanent_delete_specializations');
            });

            Route::group(['prefix' => 'roles'], function () {
                Route::get('/deleted', [RecycleBinController::class, 'deletedRolesList'])->name('deleted_roles');
                Route::post('/restore', [RecycleBinController::class, 'restoreRole'])->name('restore_role');
                Route::post('/permanent_delete', [RecycleBinController::class, 'permanentDeleteRole'])->name('permanent_delete_role');
            });

        });

        Route::prefix('datatable')->as('datatable.')->group(function () {
            Route::get('/payment-logs', [DatatableController::class, 'getPaymentLogs'])->name('payment.logs');
            Route::post('/export-payment-logs', [DatatableController::class, 'exportPaymentLogs'])->name('export.payment.logs');
            Route::post('/export-bulk-invoices', [DatatableController::class, 'exportBulkInvoices'])->name('export.bulk.invoices');
        });
    });
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::post('get-qualifications', [JobsController::class, 'getQualifications'])->name('recruiter.get.qualification');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
