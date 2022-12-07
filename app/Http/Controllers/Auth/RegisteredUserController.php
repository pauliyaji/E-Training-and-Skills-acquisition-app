<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Dps;
use App\Models\Lga;
use App\Models\Location;
use App\Models\Sccu;
use App\Models\Setting;
use App\Models\State;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Models\Usertype;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Keygen\Keygen;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $setting = Setting::where('id', 1)->first();
        $data = Subject::all();
        $courses = Course::all();
        $subjects = Subject::all();
        $locations = Location::all();
        $types = Usertype::all();
        $lgas = Lga::all();
        return view('auth.register', compact('setting','data', 'courses',
        'subjects', 'locations', 'types', 'lgas'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
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
                //'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
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
            $user->status = 1;
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
            $user->status = 1;
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
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
