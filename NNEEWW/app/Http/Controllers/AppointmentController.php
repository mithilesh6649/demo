<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Appointment;
use App\Models\AppointmentMetaData;
use App\Models\ConfidentialApiKey;
use App\Models\Notification;
use App\Models\Nutritionist;
use App\Models\Status;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Session;

class AppointmentController extends Controller
{
    public function AppointmentList()
    {
        if (Auth::user()->can('appointments_management')) {
            $AppointmentList = AppointmentMetaData::with('Appointment', 'Appointment.User', 'Appointment.Nutritionist')->orderBy('status')->orderBy('appointment_time')->get();
            $ConfidentialApiKey = ConfidentialApiKey::where('key_slug', 'zoom_access_token')->first();
            $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
            return view('appointment.list', compact('AppointmentList', 'status', 'ConfidentialApiKey'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function addAppointment()
    {
        if (Auth::user()->can('add_appointments')) {
            $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
            $NutritionistList = Nutritionist::ACTIVE_NUTRITIONIST();
            return view('appointment.add', compact('status', 'NutritionistList'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function viewAppointment($id)
    {
        if (Auth::user()->can('view_appointments')) {
            $data = AppointmentMetaData::with('Appointment.User', 'Appointment.Nutritionist')->where('id', $id)->first();
            //  $data = Appointment::with('AppointmentMetaData', 'User', 'Nutritionist')->where('id', $id)->first();
            $NutritionistList = Nutritionist::ACTIVE_NUTRITIONIST();
            $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
            return view('appointment.view', compact('NutritionistList', 'status', 'data'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function editAppointment($id)
    {

        if (Auth::user()->can('edit_appointments')) {

            $data = AppointmentMetaData::with('Appointment.User', 'Appointment.Nutritionist')->where('id', $id)->first();
            //  $data = Appointment::with('AppointmentMetaData', 'User', 'Nutritionist')->where('id', $id)->first();
            $NutritionistList = Nutritionist::ACTIVE_NUTRITIONIST();
            $status = DB::table('md_dropdowns')->where('slug', 'status')->get();
            return view('appointment.edit', compact('NutritionistList', 'status', 'data'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }

    public function saveAppointment(Request $request)
    {
        // dd($request->all());
         //Apply validation form Time:- Appointment Exist on this date and time....
        // $appoinment_date = now()->parse($request->appoinment_date)->format('Y-d-m');
        $appoinment_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->appoinment_date)->format('Y-m-d');
        $start_time = now()->parse($request->appoinment_start_time)->addMinute()->format("H:i:s");
        $end_time = now()->parse($request->appoinment_end_time)->format("H:i:s");
        $nutritionist_id = $request->nutritionist_id;

        $check_data = Appointment::checkAppointmentExistOrNot($nutritionist_id, $appoinment_date, $start_time, $end_time);

        if ($check_data == true) {
            // return redirect()
            //     ->route("appointments_list")
            //     ->with("success", "Appointment already exists this date and time");
            //  dd('Appointment already exists this date and time');
            return response()->json([
                'status' => 'failed',
                'message' => 'Appointment already exists this date and time',
            ]);
        } else {

            //Save all data in session...
            $allAppoinmentData = $request->all();
            $allAppoinmentData['appoinment_start_time'] = now()->parse($request->appoinment_start_time)->format("H:i:s");
            $allAppoinmentData['appoinment_end_time'] = now()->parse($request->appoinment_end_time)->format("H:i:s");
            Session::put('allAppoinmentData', $allAppoinmentData);

            $ZoomAccessToken = ConfidentialApiKey::where(['slug' => 'zoom', 'key_slug' => 'zoom_access_token'])->first();
            if (!empty($ZoomAccessToken)) {
                return $this->createZoomMeeting($ZoomAccessToken->value);
            } else {
                $fullUrl = $this->createCode();
                return redirect($fullUrl);
                echo "Please Create accessToken !";
            }

        }

        //$allAppoinmentData =  Session::get('allAppoinmentData');
        //dd($allAppoinmentData);
    }

    public function updateAppointment(Request $request)
    {
       
        $allAppoinmentUpdateData = $request->all();
        $appoinment_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->appoinment_date)->format('Y-m-d');
        $start_time = now()->parse($request->appoinment_start_time)->addMinute()->format("H:i:s");
        $end_time = now()->parse($request->appoinment_end_time)->format("H:i:s");
      // dd($end_time);
        $nutritionist_id = $request->nutritionist_id;
        $metadataid = $request->id;
        $check_data = Appointment::checkAppointmentExistOrNot($nutritionist_id, $appoinment_date, $start_time, $end_time, $metadataid);
        if ($check_data == true) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Appointment already exists this date and time',
            ]);
        }
        //ID OF metadata appointment
        Session::put('allAppoinmentUpdateDataID', $request->id);

        $start_appoinment_date = str_replace("/", "-", $request->appoinment_date);

        $date = date('Y-m-d', strtotime($start_appoinment_date));
        $time = now()->parse($request->appoinment_start_time)->format("H:i:s"); // $request->appoinment_start_time;
        $combinedDT = date('Y-m-d H:i:s', strtotime("$date $time"));
        //  return Carbon::parse($combinedDT)->toISOString();

        //Create Appoinment........

        // $Appointment = Appointment::where('id', $request->id)->first();
        // $Appointment->user_id = $request->user_id;
        // $Appointment->invitee_id = $request->nutritionist_id;
        // $Appointment->status = '1';
        // if ($Appointment->update()) {
        $AppointmentMetaData = AppointmentMetaData::where('id', $request->id)->first();
        // dd($AppointmentMetaData->id);
        // $AppointmentMetaData->appointment_id = $Appointment->id;
        $AppointmentMetaData->appointment_time = $combinedDT;
        $AppointmentMetaData->start_time = now()->parse($request->appoinment_start_time)->format("H:i:s"); //$request->appoinment_start_time;
        $AppointmentMetaData->end_time = now()->parse($request->appoinment_end_time)->format("H:i:s"); //$request->appoinment_end_time;
        $AppointmentMetaData->reason_for_appointment = $request->reason_for_appointment;
        if ($AppointmentMetaData->update()) {
            // Session::put('AppointmentMetaData',$AppointmentMetaData->id);

            $ZoomAccessToken = ConfidentialApiKey::where(['slug' => 'zoom', 'key_slug' => 'zoom_access_token'])->first();
            if (!empty($ZoomAccessToken)) {
                return $this->updateZoomMeeting($ZoomAccessToken->value);
            }

        }
        // }

    }

    public function createZoomMeeting($accessToken)
    {

        $allAppoinmentData = Session::get('allAppoinmentData');
        //dd($allAppoinmentData);
        if ($allAppoinmentData) {
            $start_appoinment_date = str_replace("/", "-", $allAppoinmentData['appoinment_date']);
            $date = date('Y-m-d', strtotime($start_appoinment_date));
            $time = $allAppoinmentData['appoinment_start_time'];
            $combinedDT = date('Y-m-d H:i:s', strtotime("$date $time"));
            $duration = round(abs(strtotime($allAppoinmentData['appoinment_start_time']) - strtotime($allAppoinmentData['appoinment_end_time'])) / 60, 2);
            $title = $allAppoinmentData['reason_for_appointment'] == null ? 'Appointment Gena Healthx' : $allAppoinmentData['reason_for_appointment'];
        }

        // return  $this->regenerateAccesToken($accessToken);
        //Create Meeting
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

        try {
            $response = $client->request('POST', '/v2/users/mithilesh_kumar@rvtechnologies.com/meetings', [
                "headers" => [
                    "Authorization" => "Bearer " . $accessToken,
                ],
                'json' => [
                    "topic" => $title, //"Appointment Gena Healthx",
                    "type" => 2,
                    "start_time" => Carbon::parse($combinedDT)->toISOString(),
                    "duration" => $duration, // 30 mins
                    "password" => "123456",
                ],
            ]);

            $zoomData = json_decode($response->getBody(), true);

            // Start Store Data in DB

            return $this->AppoinmentDatStore($zoomData);

            //End Store Data in DB

        } catch (\GuzzleHttp\Exception\ClientException $e) {

            if (401 == $e->getCode()) {

                return $this->regenerateAccesToken($accessToken, "form_create_side");
            } else {
                echo $e->getMessage();
            }

        }

    }

    public function ScheduledZoomMeeting($accessToken)
    {

        $allAppoinmentScheduledData = Session::get('allAppoinmentScheduledData');
        //dd($allAppoinmentScheduledData);
        if ($allAppoinmentScheduledData) {
            $start_appoinment_date = str_replace("/", "-", $allAppoinmentScheduledData['appoinment_date']);
            $date = date('Y-m-d', strtotime($start_appoinment_date));
            $time = $allAppoinmentScheduledData['appoinment_start_time'];
            $combinedDT = date('Y-m-d H:i:s', strtotime("$date $time"));
            $duration = round(abs(strtotime($allAppoinmentScheduledData['appoinment_start_time']) - strtotime($allAppoinmentScheduledData['appoinment_end_time'])) / 60, 2);
        }

        // return  $this->regenerateAccesToken($accessToken);
        //Create Meeting
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

        try {
            $response = $client->request('POST', '/v2/users/me/meetings', [
                "headers" => [
                    "Authorization" => "Bearer " . $accessToken,
                ],
                'json' => [
                    "topic" => "Appointment Gena Healthx",
                    "type" => 2,
                    "start_time" => Carbon::parse($combinedDT)->toISOString(),
                    "duration" => $duration, // 30 mins
                    "password" => "123456",
                ],
            ]);

            $zoomData = json_decode($response->getBody(), true);

            // Start Store Data in DB

            return $this->AppoinmentSeheduledStore($zoomData);

            //End Store Data in DB

        } catch (\GuzzleHttp\Exception\ClientException $e) {

            if (401 == $e->getCode()) {

                return $this->regenerateAccesToken($accessToken, "form_scheduled_side");
            } else {
                echo $e->getMessage();
            }

        }

    }

    public function updateZoomMeeting($accessToken)
    {

        //get data form db;
        $allAppoinmentUpdateDataID = Session::get('allAppoinmentUpdateDataID');
        $AppointmentMetaData = AppointmentMetaData::where('id', $allAppoinmentUpdateDataID)->first();
        $title = $AppointmentMetaData->reason_for_appointment == null ? 'Appointment Gena Healthx Updated' : $AppointmentMetaData->reason_for_appointment . " Updated";

        //Get data form db;

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

        try {
            $response = $client->request('PATCH', '/v2/meetings/' . $AppointmentMetaData->meeting_id, [
                "headers" => [
                    "Authorization" => "Bearer " . $accessToken,
                ],
                'json' => [
                    "topic" => $title, //"Gena Healthx Appointments Updated",
                    "type" => 2,
                    "pre_schedule" => false,
                    "start_time" => Carbon::parse($AppointmentMetaData->appointment_time)->toISOString(), //"2023-01-11T11:24:00.000000Z",
                    "duration" => round(abs(strtotime($AppointmentMetaData->start_time) - strtotime($AppointmentMetaData->end_time)) / 60, 2), // 30 mins
                    "password" => "123456",
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            //Update Value
            //dd($data);
            // When we update zoom meeting ( then zoom not retrun and new link zoome return status code......)
            if (204 == $response->getStatusCode()) {
                //  echo "Meeting is updated successfully.";
                //
                $appoinments = AppointmentMetaData::with('Appointment')->where('id', $allAppoinmentUpdateDataID)->first();
                //dd($appoinments->Appointment['user_id']);
                if ($appoinments->Appointment != null) {
                    Notification::StoreNotificaiton(8, $appoinments->Appointment['user_id'], 'users', Auth::user()->id, 'admin', 0);

                    Notification::StoreNotificaiton(8, $appoinments->Appointment['invitee_id'], 'web_users', Auth::user()->id, 'admin', 0);
                }
                //

                return response()->json([
                    'status' => 'success',
                    'message' => "Appointment has been updated successfully !",
                ]);

            }
            //Update Value

        } catch (\GuzzleHttp\Exception\ClientException $e) {

            if (401 == $e->getCode()) {
                // dd($accessToken);
                return $this->regenerateAccesToken($accessToken, 'form_update_side');
            } else {
                echo $e->getMessage();
            }

        }

    }

    public function AppoinmentDatStore($zoomData)
    {

        $allAppoinmentData = Session::get('allAppoinmentData');
        // dump($allAppoinmentData);
        //dd($zoomData);

        if ($allAppoinmentData) {
            $start_appoinment_date = str_replace("/", "-", $allAppoinmentData['appoinment_date']);
            $date = date('Y-m-d', strtotime($start_appoinment_date));
            $time = $allAppoinmentData['appoinment_start_time'];
            $combinedDT = date('Y-m-d H:i:s', strtotime("$date $time"));

            $appointment = Appointment::where(['user_id' => $allAppoinmentData['user_id'], 'invitee_id' => $allAppoinmentData['nutritionist_id']])->with('AppointmentMetaData', function ($qr) {
                $qr->whereIn('status', Status::where('slug', 'scheduled')->orWhere('slug', 'requested')->pluck('id')->toArray())->orderBy('id', 'DESC')->first();})->first();

            if ($appointment != null) {

                // if (!empty($appointment->AppointmentMetaData)) {

                //     return response()->json([
                //         'status' => 'failed',
                //         'message' => "This Nutritionist already have a Appointment with this user",
                //     ]);

                // }  

                $this->scheduleAppointmentWithUser($appointment, $allAppoinmentData, $zoomData, $combinedDT);
               


                return response()->json([
                    'status' => 'success',
                    'message' => "Appointment Scheduled with this user",
                ]);
            } else {
                $appointment = Appointment::firstOrCreate(['user_id' => $allAppoinmentData['user_id'], 'invitee_id' => $allAppoinmentData['nutritionist_id']]);
                $this->scheduleAppointmentWithUser($appointment, $allAppoinmentData, $zoomData, $combinedDT);
                return response()->json([
                    'status' => 'success',
                    'message' => "Appointment Scheduled with this user",
                ]);
            }
        }

    }

    public function scheduleAppointmentWithUser($appointment, $allAppoinmentData, $zoomData, $combinedDT)
    {
        $getappointment = Appointment::firstOrCreate(['user_id' => $allAppoinmentData['user_id'], 'invitee_id' => $allAppoinmentData['nutritionist_id']]);
        if ($getappointment) {
            //dd($zoomData);
            $appointmentMetaData = new AppointmentMetaData();
            $appointmentMetaData->appointment_id = $getappointment->id;
            $appointmentMetaData->appointment_time = $combinedDT;
            $appointmentMetaData->meeting_id = $zoomData['id'];
            $appointmentMetaData->appointment_join_url = $zoomData['join_url'];
            $appointmentMetaData->appointment_response = json_encode($zoomData);
            $appointmentMetaData->start_time = $allAppoinmentData['appoinment_start_time'];
            $appointmentMetaData->end_time = $allAppoinmentData['appoinment_end_time'];
            $appointmentMetaData->reason_for_appointment = $allAppoinmentData['reason_for_appointment'];
            $appointmentMetaData->followup_description = null;
            $appointmentMetaData->status = \App\Models\Status::where(['module_name' => 'Appointment', 'slug' => 'scheduled'])->value('id');
            if ($appointmentMetaData->save()) {
                //Store Notification in Notificaiton table.....
                $this->ScheduledAppointmentSendMail($appointmentMetaData->id); 
                Notification::StoreNotificaiton(Notification::appointmentScheduled, $allAppoinmentData['user_id'], 'users', Auth::user()->id, 'admin', 0);
                Notification::StoreNotificaiton(Notification::appointmentScheduled, $allAppoinmentData['nutritionist_id'], 'web_users', Auth::user()->id, 'admin', 0);

                return true;
            }
        }
    }

    public function AppoinmentSeheduledStore($zoomData)
    {
        $allAppoinmentScheduledData = Session::get('allAppoinmentScheduledData');
        // dd($allAppoinmentScheduledData);
        if ($allAppoinmentScheduledData) {
            $start_appoinment_date = str_replace("/", "-", $allAppoinmentScheduledData['appoinment_date']);
            $date = date('Y-m-d', strtotime($start_appoinment_date));
            $time = $allAppoinmentScheduledData['appoinment_start_time'];
            $combinedDT = date('Y-m-d H:i:s', strtotime("$date $time"));

            $AppointmentMetaData = AppointmentMetaData::where('id', $allAppoinmentScheduledData['id'])->first();
            $AppointmentMetaData->appointment_time = $combinedDT;
            $AppointmentMetaData->meeting_id = $zoomData['id'];
            $AppointmentMetaData->appointment_join_url = $zoomData['join_url'];
            $AppointmentMetaData->appointment_response = json_encode($zoomData);
            $AppointmentMetaData->start_time = $allAppoinmentScheduledData['appoinment_start_time'];
            $AppointmentMetaData->end_time = $allAppoinmentScheduledData['appoinment_end_time'];
            $AppointmentMetaData->status = Status::where(['module_name' => 'Appointment', 'slug' => 'scheduled'])->value('id');

            if ($AppointmentMetaData->save()) {
            
                //Store Notification in Notificaiton table.....

                // $appoinments = Appointment::where('id', $allAppoinmentScheduledData['id'])->first();
                // Notification::StoreNotificaiton(7, $appoinments['user_id'], 'users', Auth::user()->id, 'admin', 0);

                // Notification::StoreNotificaiton(7, $appoinments['invitee_id'], 'web_users', Auth::user()->id, 'admin', 0);

                $this->ScheduledAppointmentSendMail($allAppoinmentScheduledData['id']);

                return response()->json([
                    'status' => 'success',
                    'message' => "Appointment has been Scheduled successfully !",
                ]);
            }

        }

    }

    public function regenerateAccesToken($accessToken, $which_function = null)
    {
        try {

            $ZoomRefreshToken = ConfidentialApiKey::where(['slug' => 'zoom', 'key_slug' => 'zoom_refresh_token'])->first();

            $client = new \GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode(Appointment::clientId() . ':' . Appointment::clientSecret()),
                ],
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "refresh_token" => $ZoomRefreshToken->value,
                ],
            ]);

            $token = json_decode($response->getBody(), true);

            // dd($data);

            $access_token = $token['access_token'];
            $refresh_token = $token['refresh_token'];

            $allTokens = array('zoom_access_token' => $token['access_token'], 'zoom_refresh_token' => $token['refresh_token']);
            //Store key in DB
            //delete previous token
            ConfidentialApiKey::where(['slug' => 'zoom', 'key_slug' => 'zoom_access_token'])->delete();
            ConfidentialApiKey::where(['slug' => 'zoom', 'key_slug' => 'zoom_refresh_token'])->delete();

            foreach ($allTokens as $key => $value) {
                $ConfidentialApiKey = new ConfidentialApiKey();
                $ConfidentialApiKey->slug = 'zoom';
                $ConfidentialApiKey->key_slug = 'zoom';
                $ConfidentialApiKey->key = 'Zoom';
                $ConfidentialApiKey->key_slug = $key;
                $ConfidentialApiKey->value = $value;
                $ConfidentialApiKey->save();
            }

            if ($which_function == 'form_create_side') {
                return $this->createZoomMeeting($token['access_token']);
            } else if ($which_function == 'form_update_side') {
                return $this->updateZoomMeeting($token['access_token']);
            } else if ($which_function == 'form_scheduled_side') {
                return $this->ScheduledZoomMeeting($token['access_token']);
            } else {
                return response()->json([
                    'success' => 0,
                    'message' => "Something went to wrong..",
                ]);
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {

            return redirect()
                ->route("appointments_list")
                ->with("success", $e->getMessage());
        }

    }

    public function deleteAppointment(Request $request)
    {

        try {

            if (!empty($request->meeting_id)) {

                $ZoomAccessToken = ConfidentialApiKey::where(['slug' => 'zoom', 'key_slug' => 'zoom_access_token'])->first();

                $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);

                $response = $client->request('DELETE', '/v2/meetings/' . $request->meeting_id, [
                    "headers" => [
                        "Authorization" => "Bearer " . $ZoomAccessToken->value,
                    ],
                ]);

                if (204 == $response->getStatusCode()) {
                    $Appointment = AppointmentMetaData::where('id', $request->id)->first();
                    if ($Appointment) {
                        $Appointment->delete();
                        return response()->json([
                            'success' => 1,
                        ]);
                    } else {
                        return response()->json([
                            'success' => 0,
                        ]);
                    }
                }
            } else {
                $Appointment = AppointmentMetaData::where('id', $request->id)->first();
                if ($Appointment) {
                    $Appointment->delete();
                    return response()->json([
                        'success' => 1,
                    ]);
                } else {
                    return response()->json([
                        'success' => 0,
                    ]);
                }
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {

            if (401 == $e->getCode()) {
                // dd($accessToken);
                return $this->regenerateAccesToken($ZoomAccessToken->value, 'form_delete');
            } else {
                //return $e->getMessage();
                return response()->json([
                    'success' => 0,
                    'message' => $e->getMessage(),
                ]);
            }

        }

    }

    public function createZoomCode()
    {
        $fullUrl = $this->createCode();
        return redirect($fullUrl);
    }

    public function createCode()
    {
        return $url = "https://zoom.us/oauth/authorize?response_type=code&client_id=" . Appointment::clientId() . "&redirect_uri=" . Appointment::redirectUrl();
    }
    public function zoomAuth(Request $request)
    {
        //dd($request->all());

        try {
            $client = new \GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);

            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode(Appointment::clientId() . ':' . Appointment::clientSecret()),
                ],
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "code" => $_GET['code'],
                    "redirect_uri" => Appointment::redirectUrl(),
                ],
            ]);

            $token = json_decode($response->getBody()->getContents(), true);
            // dd($token);
            $access_token = $token['access_token'];
            $refresh_token = $token['refresh_token'];

            $allTokens = array('zoom_access_token' => $token['access_token'], 'zoom_refresh_token' => $token['refresh_token']);
            //Store key in DB

            //delete previous token
            ConfidentialApiKey::where(['slug' => 'zoom', 'key_slug' => 'zoom_access_token'])->delete();
            ConfidentialApiKey::where(['slug' => 'zoom', 'key_slug' => 'zoom_refresh_token'])->delete();

            foreach ($allTokens as $key => $value) {
                $ConfidentialApiKey = new ConfidentialApiKey();
                $ConfidentialApiKey->slug = 'zoom';
                $ConfidentialApiKey->key_slug = 'zoom';
                $ConfidentialApiKey->key = 'Zoom';
                $ConfidentialApiKey->key_slug = $key;
                $ConfidentialApiKey->value = $value;
                $ConfidentialApiKey->save();
            }

            //Generate key...

            return redirect()
                ->route("apiKey_list")
                ->with("success", "Token has been generated successfully!");

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function refreshZoomCode($Refreshtoken)
    {

        try {
            $client = new \GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode(Appointment::clientId() . ':' . Appointment::clientSecret()),
                ],
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "refresh_token" => $Refreshtoken,
                ],
            ]);

            $token = json_decode($response->getBody(), true);

            // dd($data);

            $access_token = $token['access_token'];
            $refresh_token = $token['refresh_token'];

            return $allTokens = array('zoom_access_token' => $token['access_token'], 'zoom_refresh_token' => $token['refresh_token']);
            //Store key in DB
            //delete previous token
            ConfidentialApiKey::where(['slug' => 'zoom', 'key_slug' => 'zoom_access_token'])->delete();
            ConfidentialApiKey::where(['slug' => 'zoom', 'key_slug' => 'zoom_refresh_token'])->delete();

            foreach ($allTokens as $key => $value) {
                $ConfidentialApiKey = new ConfidentialApiKey();
                $ConfidentialApiKey->slug = 'zoom';
                $ConfidentialApiKey->key_slug = 'zoom';
                $ConfidentialApiKey->key = 'Zoom';
                $ConfidentialApiKey->key_slug = $key;
                $ConfidentialApiKey->value = $value;
                $ConfidentialApiKey->save();
            }

            return "success";

        } catch (\GuzzleHttp\Exception\ClientException $e) {

            return redirect()
                ->route("apiKey_list")
                ->with("success", $e->getMessage());
        }

    }

    public function todayAppointment(Request $request)
    {

        $appoinment_date = str_replace("/", "-", $request->date);
        $requested_date = date('Y-m-d', strtotime($appoinment_date));

        $requested_nutritionist = $request->nutritionist_id;
        // $AppointmentList = Appointment::with('AppointmentMetaData', 'User', 'Nutritionist')->where('invitee_id',$requested_nutritionist)->get();

        $AppointmentList = Appointment::with(['Nutritionist', 'User', "AppointmentMetaData" => function ($q) use ($requested_date) {
            $q->whereDate('appointment_time', '=', $requested_date)->get();
            //$q->where('some other field', $someId);
        }])->where('invitee_id', $requested_nutritionist)->get();

        $result_view = view('appointment.partial', ['AppointmentLists' => $AppointmentList])->render();

        return json_encode(['html' => $result_view, 'status' => true]);

    }

    public function create_time_range($start, $end, $interval = '30 mins', $format = '24')
    {
        $startTime = strtotime($start);
        $endTime = strtotime($end);
        $returnTimeFormat = ($format == '12') ? 'g:i:s A' : 'G:i:s';

        $current = time();
        $addTime = strtotime('+' . $interval, $current);
        $diff = $addTime - $current;

        $times = array();
        while ($startTime < $endTime) {
            $times[] = date($returnTimeFormat, $startTime);
            $startTime += $diff;
        }
        $times[] = date($returnTimeFormat, $startTime);
        return $times;
    }

    public function checkAppointmentExist(Request $request)
    {
        //    dd($request->all());
        $start_time = $request->start_time; //"18:14";
        $end_time = $request->end_time; //"18:13";
        $nutritionist_id = $request->nutritionist_id; //"10"; //$request->nutritionist_id;
        $appoinment_date = $request->appoinment_date; //"13/01/2023"; //$request->appoinment_date;

// return  $times = $this->create_time_range($start_time,$end_time, '1 mins');

        $appoinment_date = str_replace("/", "-", $appoinment_date);
        $requested_date = date('Y-m-d', strtotime($appoinment_date));
        $flag = 0;

        $getAllAppoinmentIds = Appointment::where('invitee_id', $nutritionist_id)->get();
        if (count($getAllAppoinmentIds) != 0) {
            $allIds = $getAllAppoinmentIds->pluck('id');
            foreach ($allIds as $allId) {
                $particularData = AppointmentMetaData::where('appointment_id', $allId)->whereDate('appointment_time', '=', $requested_date)->first();
                if ($particularData) {
                    $timesArrayDB = $this->create_time_range($particularData->start_time, $particularData->end_time, '1 mins');

                    $timesArraySelected = $this->create_time_range($start_time, $end_time, '1 mins');

                    if (array_intersect($timesArrayDB, $timesArraySelected)) {
                        $flag++;
                    }

                } else {
                    // return "Not Found";
                    return response()->json([
                        'success' => 'false',
                    ]);
                }

                // $currentTime = date('H:i:s', strtotime($start_time));
                // $startTime = date('H:i:s', strtotime($particularData->start_time));
                // $endTime = date('H:i:s', strtotime($particularData->end_time));
                // if (($currentTime >= $startTime) && ($currentTime <= $endTime)){
                //   $flag++;
                // }else{
                //   echo "Current time is not between two time";
                // }
            }

        } else {
            // return "Appointment not found";
            return response()->json([
                'success' => 'false',
            ]);
        }

        if ($flag) {

            return response()->json([
                'success' => 'true',
            ]);

        } else {
            return response()->json([
                'success' => 'false',
            ]);
        }

    }

    public function ScheduledAppointment(Request $request)
    {
        //$data = Appointment::with('AppointmentMetaData', 'User', 'Nutritionist')->where('id', $request->id)->first();

        $data = AppointmentMetaData::with('Appointment', 'Appointment.User', 'Appointment.Nutritionist')->orderBy('status')->orderBy('appointment_time')->where('id', $request->id)->first();

        $NutritionistList = Nutritionist::ACTIVE_NUTRITIONIST();

        $result_view = view("appointment.partials", [
            "data" => $data,
            "NutritionistList" => $NutritionistList,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function ScheduledAppointmentSave(Request $request)
    {
       // dd($request->all()); // This is pending may be zoom link created in app also...
        
        $appoinment_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->appoinment_date)->format('Y-m-d');
        $start_time = now()->parse($request->appoinment_start_time)->addMinute()->format("H:i:s");
        $end_time = now()->parse($request->appoinment_end_time)->format("H:i:s");
        $nutritionist_id = $request->nutritionist_id;
        $metadataid = $request->id;
        $check_data = Appointment::checkAppointmentExistOrNot($nutritionist_id, $appoinment_date, $start_time, $end_time, $metadataid);
        if ($check_data == true) {
             return response()->json([
                'status' => 'failed',
                'message' => 'Appointment already exists this date and time',
            ]);
        } else {
            $allAppoinmentScheduledData = $request->all(); 
            $allAppoinmentScheduledData['appoinment_start_time'] = now()->parse($request->appoinment_start_time)->format("H:i:s");
            $allAppoinmentScheduledData['appoinment_end_time'] = now()->parse($request->appoinment_end_time)->format("H:i:s");
            Session::put('allAppoinmentScheduledData', $allAppoinmentScheduledData);
            $ZoomAccessToken = ConfidentialApiKey::where(['slug' => 'zoom', 'key_slug' => 'zoom_access_token'])->first();
            if (!empty($ZoomAccessToken)) {
                return $this->ScheduledZoomMeeting($ZoomAccessToken->value);
            }

        }

    }

    public function ScheduledAppointmentSendMail($id = 6)
    {
      
         // dd($id);
         $Appdetails['id'] = $id;
         dispatch(new SendEmailJob($Appdetails));

        // return "success";

    }


        

    public function zoomEndWebhook(Request $request)
    {

        Log::info($request);
        $parameters = $request;

        if ($parameters['event'] == 'endpoint.url_validation') {
            $this->VaildateUrl($parameters);
        }

        if ($parameters['event'] == 'meeting.ended') {
            $this->updateZoomMeetingStatus($parameters);
        }

        // Update Zoom Status...........

    }

    public function VaildateUrl($parameters)
    {
        $parameters = $parameters;
        $plainToken = $parameters['payload']['plainToken'];
        Log::info("------------------------------------------------------------------");
        Log::info($plainToken);
        $encryptedToken = hash_hmac('sha256', $plainToken, Appointment::secretToken(), false);
        $hashForValidate = $encryptedToken;
        $return = ["plainToken" => $plainToken, "encryptedToken" => $hashForValidate];
        Log::info("--------------return----------------------------------------------------");
        Log::info($return);
        $response = json_encode($return);
        Log::info("--------------response----------------------------------------------------");
        Log::info($response);
        return $response;

    }

    public function updateZoomMeetingStatus($parameters)
    {

        $data = $parameters;
        $meetingId = $data['payload']['object']['id'];
        $AppointmentMetaData = AppointmentMetaData::where('meeting_id', $meetingId)->first();
        $AppointmentMetaData->status = Status::where(['module_name' => 'Appointment', 'slug' => 'appointmentend'])->value('id');
        $AppointmentMetaData->update();

    }

    public function FilterAppointment(Request $request)
    {
        if ($request->status_value == 0) {
            $AppointmentList = AppointmentMetaData::with('Appointment', 'Appointment.User', 'Appointment.Nutritionist')->orderBy('status')->orderBy('appointment_time')->get();
        } else {
            $AppointmentList = AppointmentMetaData::where('status', $request->status_value)->with('Appointment', 'Appointment.User', 'Appointment.Nutritionist')->orderBy('status')->orderBy('appointment_time')->get();
        }

        $result_view = view("appointment.appointment_type_partial", [
            "AppointmentList" => $AppointmentList,
        ])->render();

        return json_encode(["html" => $result_view, "status" => true]);

    }

    public function CancelAppointment(Request $request)
    {
        $appoinmentcancel = AppointmentMetaData::where('id', $request->id)->update([
            'status' => Status::where(['module_name' => 'Appointment', 'slug' => 'appointmentcancel'])->value('id'),
        ]);
        if ($appoinmentcancel) {
            return "success";
        }
    }

}
