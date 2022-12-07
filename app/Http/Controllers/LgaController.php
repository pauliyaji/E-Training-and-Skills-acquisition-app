<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use Illuminate\Http\Request;

class LgaController extends Controller
{
    public function index(){
        $lgas = Lga::all();
        return view('lgas.index', compact('lgas'));
    }

    public function create(){
        $data['lgas'] = Lga::all();
        return view('lgas.create', $data);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|unique:lgas',
        ]);
        $lga = Lga::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'title'=> $request->title,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $lga = Lga::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$lga]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $lga = Lga::find($id);
        $lga->delete();

        return response()->json(['success'=>200,
            'message'=>'lgas Deleted Successfully']);
    }

}
