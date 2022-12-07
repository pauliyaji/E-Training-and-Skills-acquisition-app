<?php

namespace App\Http\Controllers;

use App\Models\Starterpack;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StarterController extends Controller
{
    public function index(){
        $starters = Starterpack::all();
        $users = User::where('usertype_id', 2)->get();
        return view('starters.index', compact('starters', 'users'));
    }

    public function create(){
        $data['starters'] = Starterpack::all();
        $users['users'] = User::where('usertype_id', 2)->get();
        return view('starters.create', $data, $users);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'device' => 'required',
            'user_id' => 'required',
            'date_of_issuance'=>'required',
        ]);
        $starter = Starterpack::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'device'=> $request->device,
                'serial_no'=> $request->serial_no,
                'date_of_issuance'=> $request->date_of_issuance,
                'user_id'=> $request->user_id,
            ]);
        return response()->json(['success' => true]);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $starter = Starterpack::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$starter,
           ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $starter = Starterpack::find($id);
        $starter->delete();

        return response()->json(['success'=>200,
            'message'=>'Starterpack Deleted Successfully']);
    }
}
