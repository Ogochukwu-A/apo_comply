<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Prescriptions extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'prescription';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public $fillable = ['medication_name','user_id','medication_mode','code', 'start_date', 'end_date', 'medication_frequency','daily_time'];
}
