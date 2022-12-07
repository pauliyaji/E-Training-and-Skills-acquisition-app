<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lga;
use App\Models\Location;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectAttendance;
use App\Models\User;
use App\Models\Usertype;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Keygen\Keygen;


class StudentController extends Controller
{
    public function index(){
        $students = Student::all();
        $subjects = Subject::all();
        $courses = Course::all();
        $locations = Location::all();
        $types = Usertype::all();
        return view('students.index', compact('students',
            'subjects', 'courses', 'locations', 'types'));
    }

    public function create(){
        $data = Subject::all();
        $courses = Course::all();
        $subjects = Subject::all();
        $locations = Location::all();
        $types = Usertype::all();
        $lgas = Lga::all();
        return view('students.create', compact('data', 'courses',
            'subjects', 'locations', 'types', 'lgas'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required:unique',
            'phone' => 'required',
            'course_id'=> 'required',
            'location_id' => 'required',
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => [
                'required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'confirmed'
            ]
        ]);
        if($request->hasFile('photo')) {
            $filenamewithExt = $request->file('photo')->getClientOriginalName();
            $imgPath = $request->file('photo')->storeAs('public/imgs', $filenamewithExt);
            $settings = Setting::where('id', 1)->first();
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->photo = $filenamewithExt;
            $user->status = 0;
            $user->setting_id = 1;
            $user->usertype_id = 2;
            $user->save();
            $user->syncRoles(3);


            $stu_serial = Keygen::numeric('5')->generate();
            $dateyear = Carbon::now()->format('Y');
            $year = substr($dateyear, -2);
            $inst = substr($settings->institution, 0, 3);

            $student = new Student;
            $student->student_no = $inst . $year . $stu_serial;
            $student->user_id = $user->id;
            $student->center_location = $request->location_id;
            $student->institution = $settings->institution;
            $student->lga_depts = $request->lga_depts;
            $student->course_id = $request->course_id;
            $student->category_id = 1;
            $student->save();
        }else{
            $settings = Setting::where('id', 1)->first();
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->status = 0;
            $user->setting_id = 1;
            $user->usertype_id = 2;
            $user->save();
            $user->syncRoles(3);


            $stu_serial = Keygen::numeric('5')->generate();
            $dateyear = Carbon::now()->format('Y');
            $year = substr($dateyear, -2);
            $inst = substr($settings->institution, 0, 3);

            $student = new Student;
            $student->student_no = $inst . $year . $stu_serial;
            $student->user_id = $user->id;
            $student->center_location = $request->location_id;
            $student->institution = $settings->institution;
            $student->lga_depts = $request->lga_depts;
            $student->course_id = $request->course_id;
            $student->category_id = 1;
            $student->save();
        }
        return redirect()->route('students.index')->with('success', 'New recored created successfully');
    }

    public function edit($id)
    {
        $student = Student::find($id);
        $data = Subject::all();
        $courses = Course::all();
        $subjects = Subject::all();
        $locations = Location::all();
        $types = Usertype::all();
        return view('students.edit', compact('student', 'data', 'courses',
            'subjects', 'locations', 'types'));
    }

    public function update(Request $request, $id){
        return response()->json($request->all());
        $student = Student::find($id);
        $student->course_id = $request->course_id;
        $student->center_location = $request->location_id;
        $student->update();

        return redirect()->route('students.index')->with('success', 'Record successfully updated');
    }

    public function profileupdate(Request $request, $id){
        if($request->hasFile('photo')) {
            $filenamewithExt = $request->file('photo')->getClientOriginalName();
            $imgPath = $request->file('photo')->storeAs('public/imgs', $filenamewithExt);
            if (auth()->user()->photo){
                Storage::delete('/public/imgs/'.auth()->user()->photo);
            }
            $student = User::find($id);
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->photo = $filenamewithExt;
            $student->update();
        }
        $student = User::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->update();
        return redirect()->back()->with('success', 'Record updated successfully');
    }

    public function passwordupdate(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'password' => [
                'required',
                'min:8',
                'confirmed'
            ]
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error', 'Errors were found in your choice of password')->withErrors($validator);
        }
        $student = User::find($id);
        $student->password = $request->password;
        $student->save();
        return redirect()->back()->with('success', 'Record updated successfully');
    }

    public function show($id){
        $profile = Student::find($id);
        $data = User::where('id', $profile->user_id)->first();
        return view('students.show', compact('profile', 'data'));
    }

    public function mycourses($id){
        $id = Auth::user()->id;
        $course = Student::where('user_id', $id)->first();
        $subjects = Subject::where('course_id', $course->course_id)->get();
        $comps = SubjectAttendance::where('course_id', $course->course_id)->where('user_id', Auth::user()->id)->get();
        return view('students.mycourses', compact('subjects', 'comps', 'course'));
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
