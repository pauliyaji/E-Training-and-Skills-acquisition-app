<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::all();
        $categories = Category::all();
        return view('courses.index', compact('courses', 'categories'));
    }

    public function create(){
        $data['courses'] = Course::all();
        $categories['categories'] = Category::all();
        return view('courses.create', $data, $categories);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required',
        ]);
        $course = Course::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'title'=> $request->title,
                'description'=> $request->description,
                'duration'=> $request->duration,
                'no_of_subjects'=> $request->no_of_subjects,
                'minimum_attendance'=> $request->minimum_attendance,
                'category_id'=> $request->category_id,
                'user_id'=> Auth::user()->id,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $course = Course::find($id);
        $categories = Category::all();
        return response()->json([
            'success'=>200,
            'message'=>$course,
            'cats' => $categories]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $course = Course::find($id);
        $course->delete();

        return response()->json(['success'=>200,
            'message'=>'Course Deleted Successfully']);
    }
}
