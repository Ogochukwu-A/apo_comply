<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugxCategory extends Model
{
    use HasFactory;

    public $fillable = ['drug_id','drug_category_id'];

    public $table = 'drugxcategory';
}
