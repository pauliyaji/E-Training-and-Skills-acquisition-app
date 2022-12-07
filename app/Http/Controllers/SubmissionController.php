<?php

namespace App\Http\Controllers;

use App\Mail\AssignmentSubmission;
use App\Mail\MentorshipAssignment;
use App\Models\Assignment;
use App\Models\Assstatus;
use App\Models\Studentmentor;
use App\Models\Subject;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SubmissionController extends Controller
{
    public function index(){
        $data = Submission::all();
        return view ('submissions.index', compact('data'));
    }

    public function makesubmission($id){
        $data = Assignment::find($id);
        return view('submissions.create', compact('data'));
    }


    public function store(Request $request){
        //return response()->json($request->all());
        $validator = $request->validate([
           'description'=>'required'
        ]);

        $mentor = User::where('id', $request->mentor_id)->first();
        $email = $mentor->email;
        $user = User::find(Auth::user()->id);
        $student = $user->name;
        Session::put('email', $email);
        Session::put('student', $student);
        Session::put('ass_no', $request->ass_no);

        if($request->hasFile('file')) {
            $filenamewithExt = $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('public/assignments', $filenamewithExt);
            $submission = new Submission();
            $submission->student_no = $request->student_no;
            $submission->mentor_id = $request->mentor_id;
            $submission->ass_id = $request->ass_id;
            $submission->description = $request->description;
            $submission->file = $filenamewithExt;
            $submission->status = 2;
            $submission->save();

            $assignment = Assignment::find($request->ass_id);
            $assignment->status = 2;
            $assignment->update();

        }else{
            $submission = new Submission();
            $submission->student_no = $request->student_no;
            $submission->mentor_id = $request->mentor_id;
            $submission->ass_id = $request->ass_id;
            $submission->description = $request->description;
            $submission->status = 2;
            $submission->save();

            $assignment = Assignment::find($request->ass_id);
            $assignment->status = 2;
            $assignment->update();
        }

        Mail::to($email)->send(new AssignmentSubmission());


        return redirect()->back()->with('success', 'Assignment successfully sent to your mentor');

    }

    public function edit($id){

        $data = Submission::find($id);

        $statuses = Assstatus::all();
        return view('submissions.edit', compact('data', 'statuses'));
    }

    public function downloadFile($id){
        $file = Submission::find($id);
        if($file->file != null){
            $myFile = storage_path("app/public/assignments/".$file->file);
            return response()->download($myFile);
        }else{
            return redirect()->back()->with('error', 'No file found');
        }
    }

    public function update(Request $request, $id){
       // return response()->json($request->all());
        $submission = Submission::find($id);
        if($submission->status == 3){
            return redirect()->back()->with('error', 'You have already reviewed and accepted this submission.');
        }
        $submission->status = $request->status;
        $submission->remarks = $request->remarks;
        $submission->update();

        $assignment = Assignment::find($request->ass_id);
        $assignment->status = $request->status;
        $assignment->update();

        if($request->status == 3){
            $student = Studentmentor::where('student_no', $request->student_no)->first();
            $student->assignment_done = (int)($student->assignment_done + 1);
            if($student->assignment_done == $student->total_assignment_expected){
                $student->mentorship_status_id = 3;
            }
            $student->update();
        }

        return redirect()->back()->with('success', 'Submission has been updated');
    }
}
