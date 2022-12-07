<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(){

        $feedbacks = Feedback::orderby('created_at','desc')->get();

        return view('feedbacks.index', compact('feedbacks', ));
    }
    public function myfeedback(){
        $id = Auth::user()->id;
        $feedbacks = Feedback::where('user_id', $id)->orderby('created_at', 'desc')->get();

        return view('feedbacks.myfeedback', compact('feedbacks', ));
    }

    public function create(){
        $data['feedbacks'] = Feedback::all();
        return view('feedbacks.create', $data);
    }

    public function store(Request $request)
    {
        $myId = Auth::user()->id;
        $usertype = Auth::user()->usertype_id;

        $feedback = Feedback::updateOrCreate(
            [
                'id' => $request->id
            ],
            [

                'feedback'=> $request->feedback,
                'user_id'=> $myId,
                'usertype_id'=>$usertype,
            ]);
        return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $feedback = Feedback::where('id', $id)->where('user_id', '=', Auth::user()->id)->first();
        return response()->json([
            'success'=>200,
            'message'=>$feedback,
            ]);
    }

    public function destroy(Request $request)
    {

        if (Auth::user()->id == 1) {
            $id = $request->id;
            $feedback = Feedback::where('id', $id)
                ->first();
            $feedback->delete();
            return response()->json(['success' => 200,
                'message' => 'Feedback Deleted Successfully']);
        }
        return response()->json(['status' => 401,
            'message' => 'Sorry you are not allowed please contact an admin staff']);


    }
}
