<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lga;
use App\Models\Location;
use App\Models\Mentor;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Models\Usertype;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Keygen\Keygen;

class MentorController extends Controller
{
    public function index(){
        $mentors = Mentor::all();
        $categories = Category::all();
        $types = Usertype::all();
        return view('mentors.index', compact('mentors',
            'categories', 'types'));
    }

    public function create(){
        $categories = Category::all();
        $types = Usertype::all();
        $lgas = Lga::all();
        return view('mentors.create', compact('categories', 'types', 'lgas'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required:unique',
            'phone' => 'required',
            'position'=> 'required',
            'area' => 'required',
            'company'=> 'required',
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
            $user->password = $request->password;
            $user->photo = $filenamewithExt;
            $user->status = 0;
            $user->setting_id = 1;
            $user->usertype_id = 3;
            $user->save();

            $mentor_serial = Keygen::numeric('5')->generate();
            $dateyear = Carbon::now()->format('Y');
            $year = substr($dateyear, -2);

            $mentor = new Mentor;
            $mentor->mentor_no = "MN" . $year . $mentor_serial;
            $mentor->user_id = $user->id;
            $mentor->position = $request->position;
            $mentor->area = $request->area;
            $mentor->address = $request->address;
            $mentor->company = $request->company;
            $mentor->lga_depts = $request->lga_depts;
            $mentor->category_id = 1;
            $mentor->save();
        }else{
            $settings = Setting::where('id', 1)->first();
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password;
            $user->status = 0;
            $user->setting_id = 1;
            $user->usertype_id = 3;
            $user->save();

            $mentor_serial = Keygen::numeric('5')->generate();
            $dateyear = Carbon::now()->format('Y');
            $year = substr($dateyear, -2);

            $mentor = new Mentor;
            $mentor->mentor_no = "MN" . $year . $mentor_serial;
            $mentor->user_id = $user->id;
            $mentor->position = $request->position;
            $mentor->area = $request->area;
            $mentor->address = $request->address;
            $mentor->company = $request->company;
            $mentor->lga_depts = $request->lga_depts;
            $mentor->category_id = 1;
            $mentor->save();
        }
        return redirect()->route('mentors.index')->with('success', 'New recored created successfully');
    }

    public function edit($id)
    {
        $mentor = Mentor::find($id);
        $categories = Category::all();
        $types = Usertype::all();
        return view('mentors.edit', compact('mentor', 'categories', 'types'));
    }
    public function show($id){
        $menprofile = Mentor::find($id);
        $data = User::where('id', $menprofile->user_id)->first();
        return view('mentors.show', compact('menprofile', 'data'));
    }

    public function update(Request $request, $id){
        $mentor = Mentor::find($id);
        $mentor->lga_depts = $request->lga_depts;
        $mentor->address = $request->address;
        $mentor->position = $request->position;
        $mentor->company = $request->company;
        $mentor->area = $request->area;
        $mentor->update();
        return redirect()->route('mentors.index')->with('success', 'Record successfully updated');
    }

    public function profileupdate(Request $request, $id){
        if($request->hasFile('photo')) {
            $filenamewithExt = $request->file('photo')->getClientOriginalName();
            $imgPath = $request->file('photo')->storeAs('public/imgs', $filenamewithExt);
            if (auth()->user()->photo){
                Storage::delete('/public/imgs/'.auth()->user()->photo);
            }
            $mentor = User::find($id);
            $mentor->name = $request->name;
            $mentor->email = $request->email;
            $mentor->phone = $request->phone;
            $mentor->photo = $filenamewithExt;
            $mentor->update();
        }
        $mentor = User::find($id);
        $mentor->name = $request->name;
        $mentor->email = $request->email;
        $mentor->phone = $request->phone;
        $mentor->update();
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
        $mentor = User::find($id);
        $mentor->password = $request->password;
        $mentor->save();
        return redirect()->back()->with('success', 'Record updated successfully');
    }

    //Already created just uncomment when needed if needed
    public function destroy(Request $request)
    {
        /*$id = $request->id;
        $mentor = Mentor::find($id);
        $mentor->delete();

        return response()->json(['success'=>200,
            'message'=>'mentor Deleted Successfully']);*/
    }
}
