<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;


class PermissionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->status == 1){

        $permissions = Permission::all();

        return view('permissions.index', [
            'permissions' => $permissions
        ]);
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    /**
     * Show form for creating permissions
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->status == 1){
        return view('permissions.create');
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if(Auth::user()->status == 1){
            $request->validate([
            'name' => 'required|unique:users,name'
        ]);

        Permission::create($request->only('name'));

        return redirect()->route('permissions.index')
            ->with('success', 'Permission added successfully');
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        if(Auth::user()->status == 1){
            return view('permissions.edit', [
            'permission' => $permission
        ]);
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Permission $permission)
    {
        if(Auth::user()->status == 1){
            $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id
        ]);

        $permission->update($request->only('name'));

        return redirect()->route('permissions.index')
            ->with('success', 'Permission updated successfully');
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    public function destroy(Permission $permission)
    {
        if(Auth::user()->status == 1){
            $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully');
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

}
