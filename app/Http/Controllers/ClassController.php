<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Period;
use App\Models\Set;
use App\Models\Student;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(){
        $classes = Set::orderBy('id', 'DESC')->get();
        return view('classes.index',compact('classes'));
    }

    public function addclass($id){
        $batches = Batch::find($id);
        $courses = Course::all();
        $students = Student::all();
        $periods = Period::all();

        return view('classes.create', compact('periods', 'batches', 'courses', 'students'));
    }

    public function studentadd($id){

        $batches = Batch::all();
        $courses = Course::all();
        $students = Student::find($id);
        $periods = Period::all();

        return view('classes.studentadd', compact('periods', 'batches', 'courses', 'students'));
    }

    public function summary(){
        $summaries = Set::selectRaw("COUNT(student_id) as student_id")
            ->selectRaw('batch_id as batch_id')
            ->selectRaw('course_id as course_id')
            ->groupBy('course_id', 'batch_id')
            ->get();
//return response($summaries);
        return view('classes.summary', compact('summaries'));
    }

    public function create(){
            //
         }

    public function store(Request $request){
        $validate = $request->validate([
            'batch_id' => 'required',
            'course_id' => 'required',
            'student_id' => 'required',
        ]);
        $batch = Batch::where('title',$request->batch_id)->first();
        $class = new Set;
        $class->batch_id = $batch->id;
        $class->course_id = $request->course_id;
        $class->student_id = $request->student_id;
        $class->period_id = $request->period_id;

        $class->save();
        return redirect()->route('classes.index')->with('message', 'Record successfully added');
    }

    public function storestudent(Request $request){
        $validate = $request->validate([
            'batch_id' => 'required',
            'course_id' => 'required',
            'student_id' => 'required',
        ]);

        $class = new Set;
        $class->batch_id = $request->batch_id;
        $class->course_id = $request->course_id;
        $class->student_id = $request->student_id;
        $class->period_id = $request->period_id;

        $class->save();
        return redirect()->route('classes.index')->with('message', 'Record successfully added');
    }

    public function edit($id){
        $class = Set::find($id);
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, $id){
        $class = Set::find($id);
        $class->batch_id = $request->batch_id;
        $class->course_id = $request->course_id;
        $class->student_id = $request->student_id;
        $class->period_id = $request->period_id;
        $class->update();

        return redirect()->route('classes.index')->with('message', 'Record successfully updated');
    }

    public function destroy($id){
        $class = Set::find($id);
        $class->delete();
        return redirect()->route('classes.index')->with('message', 'Class successfully deleted');
    }
}
