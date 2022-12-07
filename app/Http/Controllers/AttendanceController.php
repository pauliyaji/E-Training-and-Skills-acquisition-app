<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Course;
use App\Models\Mentor;
use App\Models\Period;
use App\Models\Set;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Studentmentor;
use App\Models\Subject;
use App\Models\SubjectAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{
    public function index(){
        $students = SubjectAttendance::all();/*get()->groupBy('period_id', 'course_id');*/
        //return response()->json($students);
        return view('attendance.index', compact('students'));
    }

    public function create(){
        $batches = Batch::all();
        $subjects = Subject::all();
        $sessions = Period::all();
        $courses = Course::all();
        return view('attendance.create', compact('courses', 'batches', 'subjects',
        'sessions'));
    }

    public function mark(Request $request){

        $students = Set::where('batch_id','=', $request->batch_id)
            ->where('sets.course_id', '=', $request->course_id)
            ->where('period_id', '=', $request->session_id)
            ->join('students', 'students.id','=', 'sets.student_id')
            ->join('users', 'users.id', '=', 'students.user_id')
            ->get();
        //return response()->json($students);
        foreach($students as $student){
            $addtocart = new Cart();
            $addtocart->class_id = $student->batch_id;
            $addtocart->course_id = $student->course_id;
            $addtocart->subject_id = $request->subject_id;
            $addtocart->period_id = $student->period_id;
            $addtocart->student_id = $student->student_id;
            $addtocart->user_id = $student->user_id;
            $addtocart->student_no = $student->student_no;
            $addtocart->auth_id = Auth::user()->id;
            $addtocart->save();
        }
            Session::put('students', $students);

            $batches = Batch::find($request->batch_id);
            Session::put('batches', $batches);
            $sub = Subject::find($request->subject_id);
            Session::put('sub', $sub);
            $sessions = Period::find($request->session_id);
            Session::put('sessions', $sessions);
            $courses = Course::find($request->course_id);
            Session::put('courses', $courses);
            $studentInCart = Cart::all();

            return redirect()->route('attendance.register', compact('studentInCart', 'sub', 'students', 'courses', 'batches',
                'sessions'));
    }

    public function register(Request $request){
        $batches = Session::get('batches');
        $sub = Session::get('sub');
        $sessions = Session::get('sessions');
        $courses = Session::get('courses');
        $students = Session::get('students');
        $studentInCart = Cart::all();
        return view('attendance.register', compact('studentInCart', 'sub', 'students', 'courses', 'batches',
                'sessions'));
    }

    public function markRegister(Request $request)
    {
        if($request->present == 1){
            $id= $request->student_id;
            $present = Cart::find($id);
            $present->present = $request->present;
            $present->absent = 0;
            $present->update();
            return response()->json(['success'=>'Student status change successfully.']);
        }else{
            $id= $request->student_id;
            $present = Cart::find($id);
            $present->absent = 1;
            $present->present = 0;
            $present->update();
            return response()->json(['success'=>'Student status change successfully.']);
        }

    }

    public function submit(Request $request){
                $carts = Cart::where('auth_id', Auth::user()->id)->get();
                foreach($carts as $cart) {
                    $sub_attend = new SubjectAttendance();
                    $sub_attend->batch_id = $cart->class_id;
                    $sub_attend->course_id = $cart->course_id;
                    $sub_attend->subject_id = $cart->subject_id;
                    $sub_attend->student_id = $cart->student_id;
                    $sub_attend->period_id = $cart->period_id;
                    $sub_attend->present = $cart->present;
                    $sub_attend->absent = $cart->absent;
                    $sub_attend->date = $request->date;
                    $sub_attend->user_id = $cart->user_id;
                    $sub_attend->auth_id = Auth::user()->id;
                    $sub_attend->save();

                    $course = Course::find($cart->course_id)->first();
                    $student_attend = StudentAttendance::where('user_id', $cart->user_id)->first();
                    if($student_attend == null){
                        $newrec = new StudentAttendance();
                        $newrec->course_id = $course->id;
                        $newrec->batch_id = $cart->class_id;
                        $newrec->expected_attendance = $course->duration;
                        $newrec->minimum_attendance = $course->minimum_attendance;
                        $newrec->student_id = $sub_attend->student_id;
                        $newrec->user_id = $sub_attend->user_id;
                        $newrec->student_total_attendance = $sub_attend->present;
                        $newrec->status = 'On-going';
                        $newrec->save();
                    }else{
                        $st_attendance = StudentAttendance::where('student_id', $cart->student_id)->first();
                        $minimum_att = $st_attendance->minimum_attendance;
                        $expected_att = $st_attendance->expected_attendance;
                        $stattendance = (int)$st_attendance->student_total_attendance + (int)$cart->present;
                        $st_attendance->student_total_attendance = $stattendance;
                        if($stattendance >= $minimum_att and $stattendance == $expected_att){
                            $st_attendance->status = 'Completed';
                        }else{
                            $st_attendance->status = 'On-going';
                        }
                        $st_attendance->update();
                    }
                }
                    Cart::truncate();  //to clear the carts table using eloquent

        return redirect()->route('attendance.create')->with('success', 'Attendance successfully recorded');

    }

    public function summary(){
        $data = StudentAttendance::all();
        return view('attendance.summary', compact('data'));
    }
}
