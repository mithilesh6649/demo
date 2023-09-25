<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use DB;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    public function contactUsMessagesList(Request $request)
    {
        //if(Auth::user()->can('view_contact_us')) {
        $contactUsMessagesList = ContactUs::orderByDesc('id')->get();
        $contact_us_status = DB::table('md_dropdowns')->where('slug', 'contact_us_status')->get()->toArray();
        return view('contact_us/contact_us_list', compact('contactUsMessagesList', 'contact_us_status'));
//      }
        //      else {
        //          return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        //      }
    }

    public function viewContactUsMessage($id)
    {
        //if(Auth::user()->can('view_contact_us')) {
        $contactUsMessage = ContactUs::find($id);
        $contact_us_status = DB::table('md_dropdowns')->where('slug', 'contact_us_status')->get()->toArray();
        return view('contact_us/view_contact_us_message', compact('contactUsMessage', 'contact_us_status'));
//      }
        //      else {
        //          return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        //      }
    }

    public function statusUpdate(Request $request)
    {
        $contactUs = ContactUs::find($request->id);
        $contactUs['status'] = $request->status;
        $contactUs->save();
        if ($contactUs) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => true]);
        }
    }

}
