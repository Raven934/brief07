<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function store(CourseRequest $request)
    {
        
        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' =>  $request->user()->id,
        ]);

        return response()->json($course);
    }

    public function show($id)
    {
        $course = Course::find($id);
        return response()->json($course);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($course);
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return response()->json(['message' => 'Course deleted']);
    }

            public function enroll(Request $request, $id){
        $user=$request->user();
        $user->courses()->attach($id);
        return response()->json([
        'message' => 'Enrolled successfully',
        'course_id' => $id
        ]);
        }

        public function unenroll(Request $request ,$id){
        $user = $request->user();

        $user->courses()->detach($id);
        return response()->json([
        'message' => 'Unenrolled successfully',
        ]);
        }

}