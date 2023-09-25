<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function inquiries(){
        return view('inquiries.list');
    }

    public function viewInquirie(){
        return view('inquiries.view');
    }
}
