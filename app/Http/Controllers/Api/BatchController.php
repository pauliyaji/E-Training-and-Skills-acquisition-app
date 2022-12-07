<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index(){
       // $data = Batch::all('id', 'title', 'start_date');
        $data = Batch::all();
        if($data->count() > 0){
            return response()->json([
                'status'=>200,
                'message'=>$data
            ]);
        }else{
            return response()->json([
                'status'=>403,
                'message'=>'Record not found'
            ]);
        }

    }

    public function store(Request $request){
        $data = new Batch();
        $data->create($request->all());
        return response()->json(
            [
                'status' => 201,
                'message' => 'new batch created successfully'
            ]
        );
    }

    public function update(Request $request, $id){
        $data = Batch::find($id);
        $data->update($request->all());
        return response()->json([
            'status'=> 200,
            'message' => 'Record updated successfully'
        ]);
    }

    public function destroy($id){
        $data = Batch::find($id);
        $data->delete();
        return response()->json([
            'status'=>200,
            'message'=> 'Record successfully removed'
        ]);
    }
}
