<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthMetrics extends Model
{
    use HasFactory;

    public $fillable = ['sugar_level', 'pulse_rate', 'blood_pressure_top_value', 'blood_pressure_bottom_value', 'user_id'];
}
