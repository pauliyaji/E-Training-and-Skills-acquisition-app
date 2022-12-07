<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BatchController extends Controller
{
    public function index(){
        $batches = Batch::all();
        return view('batches.index', compact('batches'));
    }

    public function create(){
        $data['batches'] = Batch::all();
        return view('batches.create', $data);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required',
        ]);
        $batch = Batch::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'title'=> $request->title,
                'description'=> $request->description,
                'start_date'=> $request->start_date,
                'end_date'=> $request->end_date,
            ]);
        return response()->json(['success' => true]);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $batch = Batch::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$batch,
            ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $batch = Batch::find($id);
        $batch->delete();
        return response()->json(['success'=>200,
            'message'=>'Batch Deleted Successfully']);
    }
}
