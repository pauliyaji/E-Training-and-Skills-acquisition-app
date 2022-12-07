<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index(){
        $subjects = Subject::all();
        $courses = Course::all();
        return view('subjects.index', compact('subjects', 'courses'));
    }

    public function create(){
        $data['subjects'] = Subject::all();
        $courses['courses'] = Course::all();
        return view('subjects.create', $data, $courses);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required',
            'course_id'=> 'required'
        ]);
        $id = Auth::user()->id;
        if($request->hasFile('file')){
            $name = $request->file('file')->getClientOriginalName();
            $imgPath = $request->file('file')->storeAs('public/files', $name);
            $setting = Subject::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'title'=> $request->title,
                    'duration' => $request->duration,
                    'description' => $request->description,
                    'course_id' => $request->course_id,
                    'file' => $name,
                    'user_id' => $id,
                ]);
            return response()->json(['success' => true]);
        }else {
            $setting = Subject::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'title' => $request->title,
                    'duration' => $request->duration,
                    'description' => $request->description,
                    'course_id' => $request->course_id,
                    'user_id' => $id,
                ]);
            return response()->json(['success' => true]);
        }
    }

    public function downloadFile($id){
        $file = Subject::find($id);
        if($file->file != null){
            $myFile = storage_path("app/public/files/".$file->file);
            return response()->download($myFile);
        }else{
            return redirect()->back()->with('error', 'No file found');
        }

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $subject = Subject::find($id);
        $courses = Course::all();
        return response()->json([
            'success'=>200,
            'message'=>$subject,
            'courses' => $courses]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $subject = Subject::find($id);
        $subject->delete();

        return response()->json(['success'=>200,
            'message'=>'subject Deleted Successfully']);
    }
}
