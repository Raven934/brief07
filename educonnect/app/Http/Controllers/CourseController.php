<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => $request->user()->id,
        ]);

        return response()->json($course);
    }

    public function show($id)
    {
        $course = Course::find($id);
        return response()->json($course);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);
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

    public function enroll(Request $request, $id)
    {
        $user = $request->user();
        $user->courses()->attach($id);
        return response()->json(['message' => 'Enrolled successfully']);
    }
}
