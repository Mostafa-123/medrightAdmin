<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

        public function index(){
            $permissions = Permission::select('id', 'group', 'name')->get();
            return view('Dashboard.dashboard.permissions.index',['permissions'=>$permissions]);
        }

    public function show($id)
    {
        $permission = Permission::find($id);


        return view('Dashboard.dashboard.permissions.permission', ['permission'=>$permission]);
    }

    public function create()
    {
        return view('Dashboard.dashboard.permissions.new');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'group' => 'required',

        ]);
        $permissionfounded=Permission::where('name',$request->name)->first();

        if($permissionfounded){
            return back()->with('fail', 'Please know that your entered name is already exists');
        }else{
            $permission = Permission::create(['name' => $request->name,'group' => $request->group]);
        if($permission){
            return redirect(route('permissions.index'))->with('success', $permission->name . ' added succesfully');
        }else{
            return back()->with('fail', 'Something went wrong');
        }
        }

    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        if($permission){
            return view('Dashboard.dashboard.permissions.new', ['permission'=>$permission]);
        }else{
            return abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $permission = Permission::find($id);
        if($permission){
            $request->validate([
                'name' => 'required',
                'group' => 'required',
                ]);
                $permissionfounded=Permission::where('name',$request->name)->where('id','!=',$id)->first();
                if($permissionfounded){
                    return back()->with('fails', 'Please know that your entered name is already exists');
                }else{
                    $permission->name = $request->name;
                    $permission->group = $request->group;
                    $saved=$permission->save();
                    if($saved){
                        return redirect(route('permissions.index'))->with('success', $permission->name . ' updated successfully');

                    }else{
                        return back()->with('fails', 'Something went wrong');
                    }


                }
        }else{
            return abort(404);
        }

    }

    public function delete($id){
        $role = Permission::find($id);

        if($role){
            $role->delete();
            return redirect('admin/permissions')->with('success',' deleted successfully');
        }else{
            return back()->with('fail', 'Error occured');
        }
    }
}
