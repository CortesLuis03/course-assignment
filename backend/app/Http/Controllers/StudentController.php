<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentModel as Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }
    public function store(Request $request)
    {
        $student = new Student([
            'std_dni' => $request->input('std_dni'),
            'std_name' => $request->input('std_name'),
            'std_lastname' => $request->input('std_lastname'),
            'std_phone' => $request->input('std_phone'),
            'std_email' => $request->input('std_email'),
            'std_address' => $request->input('std_address'),
            'std_city' => $request->input('std_city'),
            'std_semester' => $request->input('std_semester'),
        ]);
        try {
            $student->save();
        } catch (\Exception $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response([
                    'msg'=>'Duplicate Entry, please try with another Identification Number'
                ], 500);
            }
        }
        return response()->json('Student created!');
    }
    public function show($id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->update($request->all());
        return response()->json('Student updated!');
    }
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return response()->json(' deleted!');
    }
}
