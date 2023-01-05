<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel as Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }
    public function store(Request $request)
    {
        $course = new Course([
            'crs_name' => $request->input('crs_name'),
            'crs_description' => $request->input('crs_description'),
            'crs_credits' => $request->input('crs_credits'),
            'crs_area' => $request->input('crs_area'),
            'crs_type' => $request->input('crs_type')
        ]);
        try {
            $course->save();
        } catch (\Exception $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return response([
                    'msg'=>'Duplicate Entry, please try with another Identification Number'
                ], 500);
            }
        }
        return response()->json('Course created!');
    }
    public function show($id)
    {
        $course = Course::find($id);
        return response()->json($course);
    }
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $course->update($request->all());
        return response()->json('Course updated!');
    }
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return response()->json('Course deleted!');
    }
}
