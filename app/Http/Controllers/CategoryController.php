<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create(){
        $data['categories'] = Category::all();
        return view('categories.create', $data);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'category' => 'required',
        ]);
            $category = Category::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'category'=> $request->category,
                ]);
            return response()->json(['success' => true]);

    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        return response()->json([
            'success'=>200,
            'message'=>$category]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        $category->delete();

        return response()->json(['success'=>200,
            'message'=>'Categories Deleted Successfully']);
    }

}
