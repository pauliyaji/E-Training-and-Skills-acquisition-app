<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(){
       $data['settings'] = Setting::where('user_id', Auth::user()->id)->get();
       return view('settings.index', $data);
    }

    public function create(){
        $id = Auth::user()->id;
        $data['settings'] = Setting::where('user_id', $id)->get();
        $states['states'] = State::all();
        return view('settings.create', $data, $states);
    }

    public function store(Request $request)
    {
       // return response()->json($request->all());
        $validator = $request->validate([
            'institution' => 'required',
            'phone' => 'required',
            'center' => 'required',
            'image' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $imgPath = $request->file('image')->storeAs('public/images', $name);

            $data = Setting::where('id', 1)->first();

            if ($data->image){
                Storage::delete('/public/images/'.$data->image);
            }

            $data->institution = $request->institution;
            $data->description = $request->description;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->center = $request->center;
            $data->description = $request->description;
            $data->image = $name;
            $data->save();
            return view('home.index');
        }
        $data = Setting::where('id', 1)->first();
        $data->institution = $request->institution;
        $data->description = $request->description;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->center = $request->center;
        $data->description = $request->description;
        $data->save();
        return redirect()->route('dashboard');


    }

    public function edit(Request $request)
    {
        $setting = Setting::find($request->id)->first();

        return response()->json([
            'success'=>200,
            'message'=>$setting]);
    }

    public function destroy(Request $request)
    {
        $setting = Setting::find($request->id)->first();
        $setting->delete();

        return response()->json(['success'=>200,
            'message'=>'Settings Deleted Successfully']);
    }

}
