<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferralPatient;
use Auth;
class ReferralPatientController extends Controller
{
 public function ReferralPatientList(){
   if (Auth::user()->can('referral_patients_management')) {
      $ReferralPatients =  ReferralPatient::orderBy('created_at','DESC')->get();
     return view('referral_patients.list',compact('ReferralPatients'));
 } else {
    return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
}
}

public function viewReferralPatient($id){
   if (Auth::user()->can('view_referral_patients')) {
     $data =  ReferralPatient::where('id',$id)->first();
     return view('referral_patients.view',compact('data'));
 } else {
    return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
}
}

public function DeleteReferralPatient(Request $request){
  $ReferralPatient = ReferralPatient::where('id', $request->id)->delete();
  if ($ReferralPatient) {
    $res['success'] = 1;
    return json_encode($res);
} else {
    $res['success'] = 0;
    return json_encode($res);
}
}
}
