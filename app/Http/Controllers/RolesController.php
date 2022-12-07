<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->status == 1){
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->status == 1){
            $permissions = Permission::get();
        return view('roles.create', compact('permissions'));
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
            $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        if(Auth::user()->status == 1){

        $role = $role;
        $rolePermissions = $role->permissions;

        return view('roles.show', compact('role', 'rolePermissions'));
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if(Auth::user()->status == 1){
        $role = $role;
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();

        return view('roles.edit', compact('role', 'rolePermissions', 'permissions'));
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Role $role, Request $request)
    {
        if(Auth::user()->status == 1){

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update($request->only('name'));

        $role->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        if(Auth::user()->status == 1){

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
            return view('users.create');
        }else{
            return redirect()->back()->with('error', 'You do not have the permission to view the requested page');
        }
    }

}
