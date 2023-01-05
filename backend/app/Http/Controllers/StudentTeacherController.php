<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\CourseModel as Course;
use App\Models\StudentModel as Student;
use App\Models\TeacherModel as Teacher;
use App\Models\StudentTeacherModel as StudentTeacher;

class StudentTeacherController extends Controller
{
    public function index()
    {
        $relationships = collect(
            StudentTeacher::with('student', 'teacher', 'course')->get()
        )->groupBy(function ($item, $key) {
            return $item['student']->std_dni;
        });
        return response()->json($relationships);
    }
    public function getInfo()
    {
        $students = collect(Student::with('studentwithoutregister')->get())
            ->filter(function ($item, $key) {
                if (!$item['studentwithoutregister']) {
                    return $item;
                }
            })
            ->all();
        $teachers = Teacher::all();
        $courses = Course::all();
        $areas = collect($courses)
            ->groupBy('crs_area')
            ->keys()
            ->all();
        return response()->json(
            compact('students', 'teachers', 'courses', 'areas')
        );
    }

    public function getInfoStudent($id)
    {
        $studentInfo = collect(
            Student::where('id', $id)
                ->with('courses', 'courses.teacher', 'courses.course')
                ->get()
        )->first();
        return response()->json($studentInfo);
    }

    public function store(Request $request)
    {
        $relationship = new StudentTeacher([
            'credits' => $request->input('credits'),
            'std_id' => $request->input('std_id'),
            'tch_id' => $request->input('tch_id'),
            'crs_id' => $request->input('crs_id'),
        ]);

        $registerInfo = StudentTeacher::where([
            ['std_id', '=', $request->input('std_id')],
            ['crs_id', '=', $request->input('crs_id')],
        ])->get();

        if (count($registerInfo) > 0) {
            return response(
                [
                    'msg' =>
                        'The student already has the course registered. Please select another.',
                ],
                500
            );
        } else {
            $relationship->save();
        }
        return response()->json('Registration created!');
    }

    public function show($id)
    {
        $relationship = StudentTeacher::find($id);
        $students = collect(Student::get())
            ->all();
        $teachers = Teacher::all();
        $courses = Course::all();
        $areas = collect($courses)
            ->groupBy('crs_area')
            ->keys()
            ->all();
        return response()->json(
            compact('students', 'teachers', 'courses', 'areas')
        );
        return response()->json(compact('relationship','students','teachers','courses','areas'));
    }

    public function update(Request $request, $id)
    {
        $relationship = StudentTeacher::find($id);
        $relationship->update($request->all());
        return response()->json('Registration updated!');
    }
    public function destroy($id)
    {
        $relationship = StudentTeacher::find($id);
        $relationship->delete();
        return response()->json('Registration deleted!');
    }
    public function destroyAll($id)
    {
        $relationship = StudentTeacher::where('std_id', '=', $id)->delete();
        return response()->json('Registration deleted!');
    }
}
