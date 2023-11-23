<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Nutritionist;
use App\Models\WebUserAssociation;
use App\Models\NutritionistMetadata;
use App\Models\NutritionistSpecializationMap;
use App\Models\Role;
use App\Models\Specialization;
use App\Models\Status;
use App\Models\User;
use App\Models\UserAction;
use App\Models\WebUserWorkingHour;
use App\Models\Ticket;
use App\Models\TicketAssignedToWebUser;
use App\Models\GroupChat;
use App\Models\GroupChatUser;
use Auth;
use DB; 
use Illuminate\Http\Request;

class NutritionistController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('nutritionist_management')) {
            $userId = Role::where('role_type', 'users')->where('tag', 'nutritionist')->value('id');
            $NutritionistsList = Nutritionist::with('UserAction', 'NutritionistSpecialization.Specialization', 'Review')->where('role_id', $userId)->orderBy("id", 'DESC')->get();
            return view('nutritionists.index', ['NutritionistsList' => $NutritionistsList]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function addNutritionist(Request $request)
    {

        if (Auth::user()->can('add_nutritionist')) {
            $status = DB::table('statuses')->where(['module_name' => 'Account', 'slug' => 'account_status'])->get();
            $genders = DB::table('md_dropdowns')->where('slug', 'gender')->get();
            $specializations = Specialization::ACTIVE_SPECIALIZATION();
            return view('nutritionists.add', compact('status', 'genders', 'specializations'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }

    }

    public function saveNutritionist(Request $request)
    {
        
       DB::beginTransaction();

       try {

            //Save Basic Details...........
        $Nutritionist = new Nutritionist();
        $Nutritionist->title = $request->title;
        $Nutritionist->name = $request->name;
        $Nutritionist->work_experience = $request->experience;
        $Nutritionist->role_id = Role::where('role_type', 'users')->where('tag', 'nutritionist')->value('id');
            //Nutritionist->account_status = $request->status;
        if (!empty($request->phone_number)) {
            $Nutritionist->phone_number = $request->phone_number;
            $Nutritionist->country_code = $request->country_code;
            $Nutritionist->phone_verified = 1;
        }

        if (!empty($request->email)) {
            $Nutritionist->email = $request->email;
            $Nutritionist->password = \Hash::make($request->password);
            $Nutritionist->email_verified = 1;
            $Nutritionist->email_verified_at = now();
        }
        $Nutritionist->save();

        if ($request->status == Nutritionist::INACIVE_STATUS) {
            $UserAction = new UserAction();
            $UserAction->user_id = $Nutritionist->id;
            $UserAction->user_guard = 'web_users';
            $UserAction->status_id = $request->status;
            $UserAction->action_by = Auth::user()->id;
            $UserAction->action_reason = 'Suspicious Nutritionist';
            $UserAction->action_time = now();
            $UserAction->save();

        }

            // if ($Nutritionist->save()) {
      //Nutritionst Specializations



        if ($request->specialization_id != "") {
            foreach ($request->specialization_id as $key => $id) {
             $NutritionistSpecializationMap = new NutritionistSpecializationMap();
             $NutritionistSpecializationMap->web_user_id = $Nutritionist->id;
             $NutritionistSpecializationMap->specialization_id = $id ;
             $NutritionistSpecializationMap->save();
         }
     }

     //Store Workin Hours..

     foreach ($request->days as $key => $day_name) {
        $WebUserWorkingHour = new WebUserWorkingHour();
        $WebUserWorkingHour->web_user_id = $Nutritionist->id;
        $WebUserWorkingHour->days = $day_name;
        $WebUserWorkingHour->open_time = $request->open_time;
        $WebUserWorkingHour->close_time = $request->close_time;
        $WebUserWorkingHour->save();
    }


     $NutritionistMetadata = new NutritionistMetadata();
     $NutritionistMetadata->web_user_id = $Nutritionist->id;

            //Check Image and upload.......

     if ($request->file("image")) {
        $NutritionistMetadataImage = $request->file("image");
        $image = time() . "." . $NutritionistMetadataImage->getClientOriginalExtension();
        $NutritionistMetadataImage->move("images/nutritionist", $image);
        $NutritionistMetadata->image = env('IMAGE_BASE_URL') . '/images/nutritionist/' . $image;
    }
 
    $NutritionistMetadata->description = $request->description;
    $NutritionistMetadata->working_area = $request->working_area;
    $NutritionistMetadata->open_time = $request->open_time;
    $NutritionistMetadata->close_time = $request->close_time;
    $NutritionistMetadata->charges = $request->charges;
    $NutritionistMetadata->description = $request->description;

    $NutritionistMetadata->address = $request->address;
    $NutritionistMetadata->city = $request->city;
    $NutritionistMetadata->state = $request->state;
    $NutritionistMetadata->country = $request->country;
    $NutritionistMetadata->latitude = $request->lat;
    $NutritionistMetadata->longitude = $request->lng;
    $NutritionistMetadata->currency ='$';
    $NutritionistMetadata->charges_per = 'hr';
    $NutritionistMetadata->save();

          

    DB::commit();

    return redirect()
    ->route("nutritionist_index")
    ->with("success", "Nutritionist has been added successfully!");
            // all good
} catch (\Exception $e) {
    DB::rollback();
    return redirect()
    ->back()
    ->with("warning", "Something went wrong!");
}

}

public function viewNutritionist($id)
{
    if (Auth::user()->can('view_nutritionist')) {
        $status = DB::table('statuses')->where(['module_name' => 'Account', 'slug' => 'account_status'])->get();
         $Nutritionist = Nutritionist::with('NutritionistMetadata', 'NutritionistSpecialization', 'NutritionistDocuments.documentStatus', 'Appointment.AppointmentMetaData.AppointmentStatus', 'Appointment.User', 'Appointment.Nutritionist', 'Review.ReviewComment.ReviewCommentByUsers','webUserAssociation.user')->where('id', $id)->first();
         $NutritionistSpecializationMapIds = NutritionistSpecializationMap::where('web_user_id',$id)->pluck('specialization_id')->toArray();
           $WorkingHourIds = WebUserWorkingHour::where('web_user_id',$id)->pluck('days')->toArray(); 
        // dd($NutritionistSpecializationMapIds);
        $specializations = Specialization::ACTIVE_SPECIALIZATION();

          //Show all Chats..........

        $groupChatWebUsers =  GroupChatUser::with('groupChat.messages','groupChat.ticket')->where(['gena_health_user_id'=>$id,'gena_health_user_guard'=>'web_users'])->get();
      //dd($groupChatWebUsers);



        return view('nutritionists.view', compact('status', 'Nutritionist', 'specializations','NutritionistSpecializationMapIds','WorkingHourIds','groupChatWebUsers'));
    } else {
        return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
    }

}


  public function viewUserTickets($id){
       
       $ticketDetails = Ticket::with('user')->orderByDesc('id')->where('id', $id)->first();
        $ticketInfo = Ticket::getTicketsMessage($id);

        $activeNutiritionist = Nutritionist::ACTIVE_NUTRITIONIST();    
        // $allTickets =  Ticket::where(['ticket_owner_id'=>$userId,'ticket_type'=>$id])->get();
        // $title = Ticket::getTicketTitle($id);
        // $ticketView = view('users.partials.ticket_partial', compact('allTickets'))->render(); 
        
         //return view('users.tickets',compact('allTickets','title','ticketView'));
      return view('nutritionists.tickets', ['ticket' => $ticketDetails, 'nutiritionists' => $activeNutiritionist,'ticketInfo'=>$ticketInfo]);
    }

public function editNutritionist($id)
{
    if (Auth::user()->can('edit_nutritionist')) {
        $status = DB::table('statuses')->where(['module_name' => 'Account', 'slug' => 'account_status'])->get();

        $Nutritionist = Nutritionist::with('NutritionistMetadata', 'NutritionistSpecialization')->where('id', $id)->first();
        $specializations = Specialization::ACTIVE_SPECIALIZATION();
         $NutritionistSpecializationMapIds = NutritionistSpecializationMap::where('web_user_id',$id)->pluck('specialization_id')->toArray();
         $WorkingHourIds = WebUserWorkingHour::where('web_user_id',$id)->pluck('days')->toArray(); 
        return view('nutritionists.edit', compact('status', 'Nutritionist', 'specializations','NutritionistSpecializationMapIds','WorkingHourIds'));
    } else {
        return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
    }
}

public function updateNutritionist(Request $request)
{
     
    DB::beginTransaction();

    try {

            //Save Basic Details...........
        $Nutritionist = Nutritionist::where('id', $request->id)->first();
        $Nutritionist->title = $request->title;
        $Nutritionist->name = $request->name;
         $Nutritionist->work_experience = $request->experience;
            //$Nutritionist->role_id = Role::where('role_type', 'users')->where('tag', 'nutritionist')->value('id');
            //Nutritionist->account_status = $request->status;
        if (!empty($request->phone_number)) {
            $Nutritionist->phone_number = $request->phone_number;
            $Nutritionist->country_code = $request->country_code;
        } else {
            $request->phone_number = null;
        }

        if (!empty($request->email)) {
            $Nutritionist->email = $request->email;
            if ($request->password) {
                $Nutritionist->password = \Hash::make($request->password);
            }
        } else {
            $Nutritionist->email = null;
        }
        $Nutritionist->update();

        $findUser = UserAction::where(['user_id' => $request->id, 'user_guard' => 'web_users'])->first();
        if ($request->status == Nutritionist::ACTIVE_STATUS) {
            if ($findUser) {
                $findUser->delete();
            }
        }

        if ($request->status == Nutritionist::INACIVE_STATUS) {
            if (!$findUser) {
                $UserAction = new UserAction();
                $UserAction->user_id = $request->id;
                $UserAction->user_guard = 'web_users';
                $UserAction->status_id = $request->status;
                $UserAction->action_by = Auth::user()->id;
                $UserAction->action_reason = 'Suspicious Nutritionist';
                $UserAction->action_time = now();
                $UserAction->save();
            }
        }

            // if ($Nutritionist->save()) {

        $NutritionistSpecializationMapGet = NutritionistSpecializationMap::where('web_user_id', $request->id)->delete();
        
        // $NutritionistSpecializationMap = new NutritionistSpecializationMap();
        // $NutritionistSpecializationMap->web_user_id = $request->id;
        // $NutritionistSpecializationMap->specialization_id = $request->specialization_id;
        // $NutritionistSpecializationMap->save();
        
        if ($request->specialization_id != "") {
            foreach ($request->specialization_id as $key => $id) {
             $NutritionistSpecializationMap = new NutritionistSpecializationMap();
             $NutritionistSpecializationMap->web_user_id = $Nutritionist->id;
             $NutritionistSpecializationMap->specialization_id = $id ;
             $NutritionistSpecializationMap->save();
         }
     } 


        //Store Workin Hours..
    WebUserWorkingHour::where('web_user_id',$Nutritionist->id)->forceDelete();
     foreach ($request->days as $key => $day_name) {
        $WebUserWorkingHour = new WebUserWorkingHour();
        $WebUserWorkingHour->web_user_id = $Nutritionist->id;
        $WebUserWorkingHour->days = $day_name;
        $WebUserWorkingHour->open_time = $request->open_time;
        $WebUserWorkingHour->close_time = $request->close_time;
        $WebUserWorkingHour->save();
    }     

        $NutritionistMetadata = NutritionistMetadata::where('web_user_id', $request->id)->first();
        if ($NutritionistMetadata) {

            $NutritionistMetadata->web_user_id = $request->id;

                //Check Image and upload.......

            if ($request->file("image")) {
                $NutritionistMetadataImage = $request->file("image");
                $image = time() . "." . $NutritionistMetadataImage->getClientOriginalExtension();
                $NutritionistMetadataImage->move("images/nutritionist", $image);
                $NutritionistMetadata->image = env('IMAGE_BASE_URL') . '/images/nutritionist/' . $image;
            }

            $NutritionistMetadata->description = $request->description;
            $NutritionistMetadata->working_area = $request->working_area;
            $NutritionistMetadata->open_time = $request->open_time;
            $NutritionistMetadata->close_time = $request->close_time;
            $NutritionistMetadata->charges = $request->charges;
            $NutritionistMetadata->description = $request->description;

            $NutritionistMetadata->address = $request->address;
            $NutritionistMetadata->city = $request->city;
            $NutritionistMetadata->state = $request->state;
            $NutritionistMetadata->country = $request->country;
            $NutritionistMetadata->latitude = $request->lat;
            $NutritionistMetadata->longitude = $request->lng;
            $NutritionistMetadata->currency ='$';
            $NutritionistMetadata->charges_per = 'hr';
            $NutritionistMetadata->update();

        } else {

            $NutritionistMetadata = new NutritionistMetadata();
            $NutritionistMetadata->web_user_id = $request->id;

                //Check Image and upload.......

            if ($request->file("image")) {
                $NutritionistMetadataImage = $request->file("image");
                $image = time() . "." . $NutritionistMetadataImage->getClientOriginalExtension();
                $NutritionistMetadataImage->move("images/nutritionist", $image);
                $NutritionistMetadata->image = env('IMAGE_BASE_URL') . '/images/nutritionist/' . $image;
            }

            $NutritionistMetadata->description = $request->description;
            $NutritionistMetadata->working_area = $request->working_area;
            $NutritionistMetadata->open_time = $request->open_time;
            $NutritionistMetadata->close_time = $request->close_time;
            $NutritionistMetadata->charges = $request->charges;
            $NutritionistMetadata->description = $request->description;
            $NutritionistMetadata->save();
        }

            //     return redirect()
            //         ->route("nutritionist_index")
            //         ->with("success", "Nutritionist has been added successfully!");
            // } else {
            //     return redirect()
            //         ->back()
            //         ->with("warning", "Something went wrong!");
            // }

        DB::commit();

        return redirect()
        ->route("nutritionist_index")
        ->with("success", "Nutritionist has been updated successfully!");
            // all good
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()
        ->back()
        ->with("warning", "Something went wrong!");
    }

}

public function deleteNutritionist(Request $request)
{
    $User = Nutritionist::where('id', $request->id)->delete();
    if ($User) {
        $res['success'] = 1;
        return json_encode($res);
    } else {
        $res['success'] = 0;
        return json_encode($res);
    }
}

public function checkNutritionistEmail(Request $request)
{
    $email = Nutritionist::withTrashed()->where("email", $request->email)->get();

    if (count($email) > 0) {
        $res = 1;
        return response()->json(["msg" => $res]);
    } else {
        $res = 0;
        return response()->json(["msg" => $res]);
    }
}

public function checkNutritionistNumber(Request $request)
{
    $email = Nutritionist::withTrashed()->where("phone_number", $request->number)->get();

    if (count($email) > 0) {
        $res = 1;
        return response()->json(["msg" => $res]);
    } else {
        $res = 0;
        return response()->json(["msg" => $res]);
    }
}

public function deleteProfilePicture(Request $request)
{
        // dd($request->all());

    $NutritionistMetadata = NutritionistMetadata::where(
        'id',
        $request->manager_id
    )->first();

    if ($NutritionistMetadata) {
        $NutritionistMetadata->image = null;
        if ($NutritionistMetadata->save()) {
            return response()->json(['status' => 'true', 'success' => 1]);
        } else {
            return response()->json(['status' => 'true', 'success' => 0]);
        }
    } else {
        return response()->json(['status' => 'true', 'success' => 0]);
    }

}

public function getActiveUsers(Request $request)
{
    $findUser = $request->term;
    $breeds = User::where('name', 'LIKE', '%' . $findUser . '%')->orderBy('name')->take(25)->get(['id', 'email', DB::raw('name as text')]);

    return response()->json($breeds);
}

public function approveNutritionist(Request $request)
{
    $approveDocument = Document::where('id', $request->id)->first();
    $approveDocument->document_status = Status::where(['module_name' => 'Document', 'slug' => 'document_approved'])->value('id');
    if ($approveDocument->update()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Approved',
        ]);
    }
}

public function rejectNutritionist(Request $request)
{

    $approveDocument = Document::where('id', $request->id)->first();
    $approveDocument->document_status = Status::where(['module_name' => 'Document', 'slug' => 'document_rejected'])->value('id');
    $approveDocument->reason = $request->reason;
    $approveDocument->document_action_by = Auth::user()->id;
    if ($approveDocument->update()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Rejected',
        ]);
    }
}





}
