<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{

    public function getAllRolesList(Request $request)
    {
        // dd(1);
        $roles = Role::where('name', 'like', '%' . $request->input('q')  . '%')
            ->pluck('name', 'id')
            ->map(function ($text, $id) {
                return (object) ['text' => $text, 'id' => $id];
            })
            ->toArray();

        $data = array_values($roles);

        return $data;
    }




    public function index(){
        $roles = Role::pluck('name', 'id');
        return view('Dashboard.dashboard.roles.index',['roles'=>$roles]);
    }

    public function show($id)
    {
        $role = Role::find($id);


        $data = [
            'role' => $role,
        ];

        return view('Dahboard.dashboard.roles.role', $data);
    }

    public function create()
    {
        return view('Dashboard.dashboard.roles.new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            ]);
            $foundedRole=Role::where('name',$request->only(['name']))->first();
            if($foundedRole){
                return redirect()->back()->with('fail','please know that your entered name of role is already exists');
            }else{
                $role=Role::create(array_merge($request->only(['name'])));
                $role->givePermissionTo($request->input('permissions'));
                return redirect('admin/roles')->with('success',' added successfully');

            }

    }

    public function error()
    {
            return view('havntRole');

    }
    public function edit($id)
    {
        $role = Role::findById($id);
        if($role){
            return view('Dashboard.dashboard.roles.new', ['role'=>$role]);
        }else{
            return abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $role = Role::findById($id);
        if($role){
            $request->validate([
                'name' => 'required',
                ]);

                    $role->update(array_merge($request->only('name')));
        Log::channel('permissions')->info('=============START LOG===========');
        Log::channel('permissions')->info('=======Request_URL======'.$request->fullUrl().'===========');
        Log::channel('permissions')->info('=======REQUEST_DATA======'.json_encode($request->input()).'===========');
        Log::channel('permissions')->info('=============Change Role:'.json_encode($role).'===========');
        Log::channel('permissions')->info('Permission changes from '.json_encode($role->permissions));
        $role->syncPermissions($request->input('permissions'));
        Log::channel('permissions')->info('Permission changes to '.json_encode($request->input('permissions')));
        Log::channel('permissions')->info('Using User '.auth()->id());
        Log::channel('permissions')->info('============END LOG============');
        return redirect('admin/roles')->with('success',' updated successfully');

    }else{
            return abort(404);
        }

    }

    public function delete($id){
       // dd($id);
        $role = Role::find($id);
        $role->deleted_by=auth()->id();
        $role->save();

        if($role){
            $role->delete();
            return redirect('admin/roles')->with('success',' deleted successfully');
        }else{
            return back()->with('fail', 'Error occured');
        }
    }


}
