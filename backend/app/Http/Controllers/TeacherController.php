<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeacherModel as Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return response()->json($teachers);
    }
    public function store(Request $request)
    {
        $teacher = new Teacher([
            'tch_dni' => $request->input('tch_dni'),
            'tch_name' => $request->input('tch_name'),
            'tch_lastname' => $request->input('tch_lastname'),
            'tch_phone' => $request->input('tch_phone'),
            'tch_email' => $request->input('tch_email'),
            'tch_address' => $request->input('tch_address'),
            'tch_city' => $request->input('tch_city'),
            'tch_semester' => $request->input('tch_semester'),
        ]);
        try {
            $teacher->save();
        } catch (\Exception $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response([
                    'msg'=>'Duplicate Entry, please try with another Identification Number'
                ], 500);
            }
        }
        return response()->json('Teacher created!');
    }
    public function show($id)
    {
        $teacher = Teacher::find($id);
        return response()->json($teacher);
    }
    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        $teacher->update($request->all());
        return response()->json('Teacher updated!');
    }
    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return response()->json('Teacher deleted!');
    }
}
