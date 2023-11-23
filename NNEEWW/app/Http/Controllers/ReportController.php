<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\School;
use \App\Models\StudentCourse;
use Carbon\Carbon;
use DB;

class ReportController extends Controller
{
    public function students(){

        $types = \App\Models\School::schoolTypes();

        $school_data = [];
        foreach($types as $type){
            $school_ids = School::where('type',$type)->pluck('id');
            $school_ids = array_unique($school_ids->toArray());

            $total = 0;
            foreach($school_ids as $school_id){
                $school = School::find($school_id);
                foreach($school->courses as $course){

                    if(date('Y',strtotime($course->created_at))==date('Y')){
                        $total += $course->students->count();
                    }
                }
            }

            $obj = array('name'=>$type,'count'=>$total);
            array_push($school_data, $obj);
        }
          


        // monthly students registered
        $year = date('Y');
        $date = Carbon::createFromDate($year);

        $startOfYear = $date->copy()->startOfYear();
        $endOfYear   = $date->copy()->endOfYear();

        $users = User::where('role_id',3)->select('id', 'created_at')
        ->whereBetween('created_at', [
            $startOfYear,
            $endOfYear,
        ])
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($usermcount[$i])){
                $userArr[$i] = $usermcount[$i];    
            }else{
                $userArr[$i] = 0;    
            }
        }
        // monthly students registered

        // gender wise students
        $male_student_count = User::where('gender','male')->where('role_id',3)->count();
        $female_student_count = User::where('gender','female')->where('role_id',3)->count();
        $total_student_count = User::where('role_id',3)->count();
        // gender wise students
        
        return view('reports.students')->with(['total_student'=>$total_student_count,'male_student_count'=>$male_student_count,'female_student_count'=>$female_student_count,'userArr'=>$userArr,'school_data'=>json_encode($school_data)]);
    }

    public function teachers(){
        // $schools = School::with('teacherSchools')->get();

        $types = \App\Models\School::schoolTypes();

        $schools = [];
        foreach($types as $type){
            $school_ids = School::where('type',$type)->pluck('id');
            $school_ids = array_unique($school_ids->toArray());

            $total = 0;
            foreach($school_ids as $school_id){
                $school = School::find($school_id);
                foreach($school->courses as $course){
                    
                    $total += \App\Models\courseInstructor::where('course_id',$course->id)->whereYear('created_at',date('Y'))->count();
                }
            }

            $obj = array('name'=>$type,'count'=>$total);
            array_push($schools, $obj);
        }
       
        // type ends


        $year = date('Y');
        $date = Carbon::createFromDate($year);

        $startOfYear = $date->copy()->startOfYear();
        $endOfYear   = $date->copy()->endOfYear();

        $users = User::where('role_id',2)->select('id', 'created_at')
        ->whereBetween('created_at', [
            $startOfYear,
            $endOfYear,
        ])
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($usermcount[$i])){
                $userArr[$i] = $usermcount[$i];    
            }else{
                $userArr[$i] = 0;    
            }
        }

        $male_teacher_count = User::where('gender','male')->where('role_id',2)->count();
        $female_teacher_count = User::where('gender','female')->where('role_id',2)->count();
        $total_teacher_count = User::where('role_id',2)->count();
        
        return view('reports.teachers')->with(['total_teacher'=>$total_teacher_count,'male_teacher_count'=>$male_teacher_count,'female_teacher_count'=>$female_teacher_count,'userArr'=>$userArr,'schools'=>json_encode($schools)]);
    }

    // payments
    public function payments(){
       
        $year = date('Y');
        $date = Carbon::createFromDate($year);

        $startOfYear = $date->copy()->startOfYear();
        $endOfYear   = $date->copy()->endOfYear();

        $users = \App\Models\PaymentTransaction::select('id','amount', 'created_at')
        ->whereBetween('created_at', [
            $startOfYear,
            $endOfYear,
        ])
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $paymentAmount = [];
        $paymentArr = [];

        foreach ($users as $key => $value) {
            $paymentAmount[(int)$key] = $value->sum('amount');
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($paymentAmount[$i])){
                $paymentArr[$i] = $paymentAmount[$i];    
            }else{
                $paymentArr[$i] = 0;    
            }
        }
        // return $paymentArr;

        $paid = StudentCourse::whereYear('created_at',$year)->where('payment_status','paid')->count() * 50;
        $unpaid = StudentCourse::whereYear('created_at',$year)->where('payment_status','!=','paid')->count() * 50;

        return view('reports.payments')->with(['paymentArr'=>json_encode($paymentArr),'paid'=>$paid,'unpaid'=>$unpaid]);
    }

    public function filterPaymentsReport(Request $request){
        $year = $request->year;
        $date = Carbon::createFromDate($year);

        $startOfYear = $date->copy()->startOfYear();
        $endOfYear   = $date->copy()->endOfYear();

        $users = \App\Models\PaymentTransaction::select('id','amount', 'created_at')
        ->whereBetween('created_at', [
            $startOfYear,
            $endOfYear,
        ])
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $paymentAmount = [];
        $paymentArr = [];

        foreach ($users as $key => $value) {
            $paymentAmount[(int)$key] = $value->sum('amount');
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($paymentAmount[$i])){
                $paymentArr[$i] = $paymentAmount[$i];    
            }else{
                $paymentArr[$i] = 0;    
            }
        }

        $paid = StudentCourse::whereYear('created_at',$year)->where('payment_status','paid')->count() * 50;
        $unpaid = StudentCourse::whereYear('created_at',$year)->where('payment_status','!=','paid')->count() * 50;

        $res['paymentArr'] = $paymentArr;
        $res['paid'] = $paid;
        $res['unpaid'] = $unpaid;

        // return json_encode($paymentArr);
        return json_encode($res);
    }
    // payments


    public function filterStudentsReport(Request $request){
        $year = $request->year;

        $types = \App\Models\School::schoolTypes();

        $school_data = [];
        foreach($types as $type){
            $school_ids = School::where('type',$type)->pluck('id');
            $school_ids = array_unique($school_ids->toArray());

            $total = 0;
            foreach($school_ids as $school_id){
                $school = School::find($school_id);
                foreach($school->courses as $course){
                   if(date('Y',strtotime($course->created_at))==$year){
                        $total += $course->students->count();
                    }
                }
            }

            $obj = array('name'=>$type,'count'=>$total);
            array_push($school_data, $obj);
        }

        // monthly students registered
        $date = Carbon::createFromDate($year);

        $startOfYear = $date->copy()->startOfYear();
        $endOfYear   = $date->copy()->endOfYear();

        $users = User::where('role_id',3)->select('id', 'created_at')
        ->whereBetween('created_at', [
            $startOfYear,
            $endOfYear,
        ])
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($usermcount[$i])){
                $userArr[$i] = $usermcount[$i];    
            }else{
                $userArr[$i] = 0;    
            }
        }
        // monthly students registered

        // gender wise students
        $male_student_count = User::where('gender','male')->whereYear('created_at',$year)->where('role_id',3)->count();
        $female_student_count = User::where('gender','female')->whereYear('created_at',$year)->where('role_id',3)->count();
        $total_student_count = User::where('role_id',3)->whereYear('created_at',$year)->count();
        // gender wise students

        $res['male_student_count'] = $male_student_count;
        $res['female_student_count'] = $female_student_count;
        $res['total_student_count'] = $total_student_count;
        $res['userArr'] = $userArr;
        $res['school_data'] = $school_data;
        return json_encode($res);
    }


    public function filterTeachersReport(Request $request){
        $year = $request->year;

        $types = \App\Models\School::schoolTypes();

        $schools = [];
        foreach($types as $type){
            $school_ids = School::where('type',$type)->pluck('id');
            $school_ids = array_unique($school_ids->toArray());

            $total = 0;
            foreach($school_ids as $school_id){
                $school = School::find($school_id);
                foreach($school->courses as $course){
                    
                    $total += \App\Models\courseInstructor::where('course_id',$course->id)->whereYear('created_at',$year)->count();
                }
            }

            $obj = array('name'=>$type,'count'=>$total);
            array_push($schools, $obj);
        }


        // monthly students registered
        $date = Carbon::createFromDate($year);

        $startOfYear = $date->copy()->startOfYear();
        $endOfYear   = $date->copy()->endOfYear();

        $users = User::where('role_id',2)->select('id', 'created_at')
        ->whereBetween('created_at', [
            $startOfYear,
            $endOfYear,
        ])
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($usermcount[$i])){
                $userArr[$i] = $usermcount[$i];    
            }else{
                $userArr[$i] = 0;    
            }
        }
        // monthly students registered

        // gender wise students
        $male_teacher_count = User::where('gender','male')->whereYear('created_at',$year)->where('role_id',2)->count();
        $female_teacher_count = User::where('gender','female')->whereYear('created_at',$year)->where('role_id',2)->count();
        $total_teacher_count = User::where('role_id',2)->whereYear('created_at',$year)->count();
        // gender wise teachers

        $res['male_teacher_count'] = $male_teacher_count;
        $res['female_teacher_count'] = $female_teacher_count;
        $res['total_teacher_count'] = $total_teacher_count;
        $res['userArr'] = $userArr;
        $res['schools'] = $schools;
        return json_encode($res);
    }

}
