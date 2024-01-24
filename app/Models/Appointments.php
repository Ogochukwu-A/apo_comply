<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    public $table = 'appointment';


    public $fillable = ['patient_name','patient_email','patient_subject', 'patient_appointment_time', 'patient_appointment_date', 'patient_description', 'user_id', 'code'];
}
