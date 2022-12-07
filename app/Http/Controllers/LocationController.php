<?php

namespace App\Http\Controllers;


use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(){
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    public function create(){
        $data['locations'] = Location::all();
        return view('locations.create', $data);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'location' => 'required',
        ]);
        $Location = Location::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'location'=> $request->location,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $location = Location::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$location]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $location = Location::find($id);
        $location->delete();

        return response()->json(['success'=>200,
            'message'=>'locations Deleted Successfully']);
    }
}
