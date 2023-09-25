<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Joinus;
use DB;
use Illuminate\Http\Request;

class JoinUsController extends Controller
{

    // 01 - Join us list

    public function JoinUsList()
    {
        $joinUsList = Joinus::orderByDesc('id')->get();
        $join_us_status = DB::table('md_dropdowns')->where('slug', 'join_us_status')->get()->toArray();

        return view('join_us.list', compact('joinUsList', 'join_us_status'));
    }

    //change status
    public function statusUpdate(Request $request)
    {
        $Joinus = Joinus::find($request->id);
        $Joinus['status'] = $request->status;
        $Joinus->save();
        if ($Joinus) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => true]);
        }
    }

    //Join Us view

    public function JoinUsView($id)
    {
        $joinus = Joinus::where('id', $id)->first();

        $interested_city = City::whereIn('id', json_decode($joinus->interested_city))->get();
        json_decode($joinus->interested_city)[0];
        $join_us_status = DB::table('md_dropdowns')->where('slug', 'join_us_status')->get()->toArray();
        return view('join_us.view', compact('joinus', 'join_us_status', 'interested_city'));

    }

    //delete records
    public function deleteJoinUs(Request $request)
    {

        $Joinus = Joinus::where('id', $request->id)->first();

        $Joinus = $Joinus->delete();

        if ($Joinus) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }

    }

}
