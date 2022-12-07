<?php

namespace App\Http\Controllers;

use App\Mail\Assignmentemail;
use App\Mail\MentorshipAssignment;
use App\Models\Assignment;
use App\Models\Assstatus;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\Studentmentor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Keygen\Keygen;

class AssignmentController extends Controller
{
    public function index(){
        $data = Assignment::where('mentor_id', Auth::user()->id)->get();

        return view ('assignments.index', compact('data'));
    }

    public function mine($id){
        $student = Student::where('user_id', $id)->first();
        $data = Assignment::where('student_no', $student->student_no)->get();
        return view ('assignments.mine', compact('data'));
    }

    public function mentorsview(){
        $id = Auth::user()->id;
        $data = Assignment::where('mentor_id', $id)->get();

        return view ('assignments.mentorsview', compact('data'));
    }

    public function create(){

        $status = Assstatus::all();
        $id = Auth::user()->id;
        $mentors_id = Mentor::where('user_id', $id)->first();
        $students = Studentmentor::where('mentor_id', $mentors_id->id)->get();

        return view ('assignments.create', compact( 'status', 'students'));
    }

    public function store(Request $request){
        $validator = $request->validate([
           'description'=>'required',
           'student_id'=>'required',
        ]);
        $ass_no = Keygen::numeric('5')->generate();

        $stu = Student::where('id', $request->student_id)->first();
        $data = new Assignment();
        $data->ass_no = $ass_no;
        $data->description = $request->description;
        $data->student_no = $stu->student_no;
        $data->mentor_id = Auth::user()->id;
        $data->status = 1;
        $data->save();

        $stu_email = User::where('id', $stu->user_id)->first();
        $email = $stu_email->email;
        Session::put('email', $email);
        $mentname = User::where('id', Auth::user()->id)->first();
        $mentorname = $mentname->name;
        Session::put('stu_no', $stu->student_no);
        Session::put('data', $stu_email->name);
        Session::put('mentorname', $mentorname);
        Session::put('ass_no', $ass_no);

        Mail::to($email)->send(new Assignmentemail());

        return redirect()->back()->with('success', 'Assignment successfully sent to mentee');
    }

    public function update(Request $request, $id){
        $data = Assignment::find($id);
        $data->description = $request->description;
        $data->student_no = $request->student_no;
        $data->mentor_id = $request->mentor_id;
        $data->status = $request->status;
        $data->update();
        return redirect()->route('assignments.index')->with('success', 'Record successfully updated');
    }

    public function delete($id){
        $data = Assignment::find($id);
        $data->delete();
        return redirect()->route('assignments.index');
    }
}
