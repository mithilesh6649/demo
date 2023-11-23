<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsultantSession;
use Auth; 
class ConsultantSessionController extends Controller
{
  public function ConsultationSessionList(){
     if (Auth::user()->can('consultation_session_management')) {
         $ConsultantSession = ConsultantSession::with('consultant')->orderBy('created_at','DESC')->get();
         return view('consultation_sessions.list',compact('ConsultantSession'));
     } else {
        return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
    }
}

public function viewConsultationSession($id){
   if (Auth::user()->can('view_consultation_session')) {
       $data = ConsultantSession::where('id',$id)->first();
       return view('consultation_sessions.view',compact('data'));
   } else {
    return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
}
}


public function DeleteConsultationSession(Request $request){
  $ConsultantSession = ConsultantSession::where('id', $request->id)->delete();
  if ($ConsultantSession) {
    $res['success'] = 1;
    return json_encode($res);
} else {
    $res['success'] = 0;
    return json_encode($res);
}
}

}
