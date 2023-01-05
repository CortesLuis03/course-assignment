<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\StudentModel as Student;
use App\Models\TeacherModel as Teacher;
use App\Models\CourseModel as Course;

class StudentTeacherModel extends Model
{
    protected $table = 'student_teacher';
    protected $primaryKey = 'id';
    protected $fillable = ['std_id', 'tch_id', 'crs_id', 'credits'];
    use HasFactory;

    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'std_id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'id', 'tch_id');
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'crs_id');
    }
}
