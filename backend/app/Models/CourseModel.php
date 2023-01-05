<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $fillable = ['crs_name', 'crs_description', 'crs_credits','crs_area','crs_type'];  
    use HasFactory;
}
