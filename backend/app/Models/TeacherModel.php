<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherModel extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $fillable = ['tch_dni', 'tch_name', 'tch_lastname','tch_phone','tch_email','tch_address','tch_city'];  
    use HasFactory;
}
