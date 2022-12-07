<?php

namespace App\Http\Controllers;

use App\Mail\Mentorsfirstmail;
use App\Mail\MentorshipAssignment;
use App\Mail\Mentorsmail;
use App\Models\Category;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Studentmentor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MentorshipController extends Controller
{
    public function index(){
        $data = Studentmentor::all();
        $students = Student::all();
        $mentors = Mentor::all();
        $categories = Category::all();
        return view('mentorships.index', compact('categories','data', 'students', 'mentors'));
    }

    public function mymentees(){
        $id = Auth::user()->id;
        $mentors_id = Mentor::where('user_id', $id)->first();
        $data = Studentmentor::where('mentor_id', $mentors_id->id)->get();

        $students = Student::all();
        $mentors = Mentor::all();
        $categories = Category::all();
        return view('mentorships.mymentees', compact('categories','data', 'students', 'mentors'));
    }

    public function add($id){
        $data = StudentAttendance::find($id);
        $mentors = Mentor::all();
        return view('mentorships.create', compact('data', 'mentors'));
    }

    public function store(Request $request)
    {
        //return response()->json($request->all());
        $validator = $request->validate([
            'user_id' => 'required',
            'mentor_id'=> 'required',
            'duration' => 'required',
        ]);
        $stno = Student::where('user_id', $request->user_id)->first();
        $stu_no = $stno->student_no;
        $stu_mentor = Mentor::where('id', $request->mentor_id)->first();
           $studentmentor = new Studentmentor();
           $studentmentor->user_id= $request->user_id;
           $studentmentor->student_no = $stu_no;
           $studentmentor->mentor_id= $request->mentor_id;
           $studentmentor->mentor_user_id= $stu_mentor->user_id;
           $studentmentor->duration= $request->duration;
           $studentmentor->start_date= $request->start_date;
           $studentmentor->end_date= $request->end_date;
           $studentmentor->total_assignment_expected = $request->total_assignment_expected;
           $studentmentor->mentorship_status_id = 2;
           $studentmentor->auth_id= Auth::user()->id;
           $studentmentor->date_assigned = Carbon::now();
           $studentmentor->save();

           $student = StudentAttendance::where('user_id', $studentmentor->user_id)->first();
           $student->status = 'Assigned to Mentor';
           $student->update();
           $studentcourse = $student->courses->title;

           //student
           $data = User::where('id', $studentmentor->user_id)->first();
           $username = $data->name;
           $email = $data->email;
           //mentor
            $mentor = Mentor::where('id',$request->mentor_id)->first();
            $datamentor = User::where('id', $mentor->user_id)->first();

            $mentorname = $datamentor->name;
            $mentoremail = $datamentor->email;

            Session::put('data', $username);
            Session::put('email', $email);
            Session::put('stu_no', $stu_no);
            Session::put('course', $studentcourse);
            Session::put('mentorname', $mentorname);
            Session::put('mentoremail', $mentoremail);

            //mail to mentee
            Mail::to($email)->send(new MentorshipAssignment());
            //mail to mentor
            Mail::to($mentoremail)->send(new Mentorsmail());
        return redirect()->route('mentorships.index')->with('success', 'Mentorship assignment was successful');

    }

    public function edit($id)
    {
        $data = Studentmentor::find($id);
        //$mentors = Mentor::all();
        return view('mentorships.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $stno = Student::where('user_id', $request->user_id)->first();
        $stu_no = $stno->student_no;
        $studentmentor = Studentmentor::find($id);
        $studentmentor->user_id= $request->user_id;
        $studentmentor->student_no = $stu_no;
        $studentmentor->mentor_id= $request->mentor_id;
        $studentmentor->duration= $request->duration;
        $studentmentor->start_date= $request->start_date;
        $studentmentor->end_date= $request->end_date;
        $studentmentor->total_assignment_expected = $request->total_assignment_expected;
        $studentmentor->mentorship_status_id = 2;
        $studentmentor->auth_id= Auth::user()->id;
        $studentmentor->date_assigned = Carbon::now();
        $studentmentor->update();

        $student = StudentAttendance::where('user_id', $studentmentor->user_id)->first();
        $student->status = 'Assigned to Mentor';
        $student->update();
        $studentcourse = $student->courses->title;

        //student
        $data = User::where('id', $studentmentor->user_id)->first();
        $username = $data->name;
        $email = $data->email;
        //mentor
        $mentor = Mentor::where('id',$request->mentor_id)->first();
        $datamentor = User::where('id', $mentor->user_id)->first();

        $mentorname = $datamentor->name;
        $mentoremail = $datamentor->email;

        Session::put('data', $username);
        Session::put('email', $email);
        Session::put('stu_no', $stu_no);
        Session::put('start', $studentmentor->start_date);
        Session::put('end', $studentmentor->end_date);
        Session::put('mentorname', $mentorname);
        Session::put('mentoremail', $mentoremail);

        //mail to mentee
        Mail::to($email)->send(new Mentorsfirstmail());
        //mail to mentor
        return redirect()->back()->with('success', 'Record updated and sent to the Mentee');

    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $mentorship = Studentmentor::find($id);
        $mentorship->delete();

        return response()->json(['success'=>200,
            'message'=>'Mentorship Deleted Successfully']);
    }
}
