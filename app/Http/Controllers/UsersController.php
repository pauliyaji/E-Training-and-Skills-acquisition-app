<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lga;
use App\Models\Location;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\SubjectAttendance;
use App\Models\User;
use App\Models\Usertype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;


class UsersController extends Controller
{
    public function index()
    {
        if(Auth::user()->status == 1){
            $users = User::with('audits')->get();
            return view('users.index', compact('users'));
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }

    }

    public function create()
    {
        if(Auth::user()->status == 1){
            $usertypes = Usertype::all();

            return view('users.create', compact('usertypes', ));
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    public function store(Request $request)
    {
        if(Auth::user()->status == 1){
            $validator = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users',
                'phone' => 'required',
                'password' => ['required', Password::min(8)],
            ]);

            if($request->hasFile('photo')){
                $filenamewithExt = $request->file('photo')->getClientOriginalName();
                $imgPath = $request->file('photo')->storeAs('public/imgs', $filenamewithExt);
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->setting_id = 1;
                //$user->password = Hash::make($request->password);
                $user->password = $request->password;
                $user->photo = $filenamewithExt;
                $user->status = 0;
                $user->usertype_id = $request->usertype_id;
                $user->save();
            }
            else{
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->setting_id = 1;
                $user->status = 0;
                $user->usertype_id = $request->usertype_id;
                $user->password = $request->password;

                $user->save();
            }
            return redirect()->back()->with('success', 'User added successfully');
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    public function show($id)
    {
        if(Auth::user()->status == 1){
            $data = User::find($id);

            return view('users.show', compact('data', ));
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    public function profile(){
        $courses = Course::all();
        $locations = Location::all();
        $lgas = Lga::all();
        $type = Auth::user()->usertype_id;
        if($type == 2){
            $students = SubjectAttendance::where('user_id', Auth::user()->id)->get();
           //return response()->json($students);
            $data = User::where('id', '=', Auth::user()->id)
                ->where('usertype_id', '=', 2)->first();
            $student = Student::where('user_id', Auth::user()->id)->first();

            $summary = StudentAttendance::where('user_id', Auth::user()->id)->first();
            return view('students.profile', compact('summary','student', 'students', 'data', 'courses', 'locations', 'lgas'));
        }else if($type == 3){
            $data = User::where('id', '=', Auth::user()->id)
                ->where('usertype_id', '=', 3)->first();
            $mentor = Mentor::where('user_id', Auth::user()->id)->first();

            return view('mentors.profile', compact('locations','data', 'mentor', 'lgas'));
        }else{
            $data = User::where('id', '=', Auth::user()->id)->first();
            return view('users.show', compact('data'));
        }

    }

    public function edit(User $user)
    {
        if(Auth::user()->status == 1){
            return view('users.edit', [
                'user' => $user,
                'userRole' => $user->roles->pluck('name')->toArray(),
                'roles' => Role::latest()->get(),
                'usertypes'=> Usertype::all(),
            ]);
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    public function changeUserStatus(Request $request)
    {
        if(Auth::user()->status == 1){
            $user = User::find($request->user_id);
            $user->status = $request->status;
            $user->save();

            return response()->json(['success'=>'User status change successfully.']);
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    public function update(Request $request, $id)
    {
        /*$validator = $request->validate([
           'email'=>'required|unique:users',
        ]);*/

        if(Auth::user()->status == 1){
            if($request->hasFile('photo')){

                $filenamewithExt = $request->file('photo')->getClientOriginalName();
                $imgPath = $request->file('photo')->storeAs('public/imgs', $filenamewithExt);
                $user = User::find($id);
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->usertype_id = $request->usertype_id;


                if($request->password){
                    $request->validate([
                        'password' => ['required','min:8'],
                    ]);
                    $user->password = $request->password;
                }
                $user->photo = $filenamewithExt;
                $user->save();
                $user->syncRoles($request->get('role'));
            }
            else{

                $user = User::find($id);
                $user->name = $request->name;
                if($request->password){
                    $request->validate([
                        'password' => ['required','min:8'],
                    ]);
                    $user->password = $request->password;
                }
                $user->phone = $request->phone;
                $user->usertype_id = $request->usertype_id;
                $user->save();
                $user->syncRoles($request->get('role'));
            }
            $data = $id;
            return redirect()->back()->with('success', 'User updated successfully');
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    public function destroy()
    {
        //
    }
}
