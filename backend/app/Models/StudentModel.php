<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = ['std_dni', 'std_name', 'std_lastname','std_phone','std_email','std_address','std_city','std_semester'];  
    use HasFactory;
}
