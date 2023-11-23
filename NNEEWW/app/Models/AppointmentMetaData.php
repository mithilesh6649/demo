<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentMetaData extends Model
{
    use HasFactory;

    protected $table = 'appointment_metadata';
    protected $appends = ['calculated_duration','appointment_start_time','appointment_end_time'];
    public function getCalculatedDurationAttribute(){
        return  round(abs(strtotime($this->start_time) - strtotime($this->end_time)) / 60,2);
    }
    
    public function getAppointmentStartTimeAttribute(){
        return date('g:i A', strtotime($this->start_time));
    }

    public function getAppointmentEndTimeAttribute(){
      
      return date('g:i A', strtotime($this->end_time));
    }


    public function AppointmentStatus(){
        return $this->belongsTo(Status::class,'status');
    }
    public function Appointment(){
        return $this->belongsTo(Appointment::class);
    }
      
}
