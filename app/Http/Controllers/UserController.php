<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function per(){
        $user=User::where('id',1)->first();
        $role=Role::where('name','admin')->first();
        if($role){
            $user->assignRole($role);
        }else{
            $role = Role::create(['name' => 'admin']);
            $user->assignRole($role);
        }
    }
    public function index(UsersDataTable $dataTable){
        // $user=User::where('id',2)->first();
        // // $user->roles->map(function($role) {
        // //    // dd($role->name);
        // // });
        // dd($user->permissions);
        // foreach($user->roles->toArray() as $role){
        //     dd($role['name']);
        // }
        return $dataTable->render('Dashboard.dashboard.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('Dashboard.dashboard.users.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateUsers($request);

        $roleNames = Role::whereIn('id', $request->input('role_id'))->pluck('name')->toArray();

        $user=User::create(array_merge($request->only(['name','email','phone']),['password'=>Hash::make($request->password)]));

        $user->syncRoles($roleNames);
        $user->syncPermissions($request->input('permissions'));


        //
        return redirect(route('users.index'))->with('success',' added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('Dashboard.dashboard.users.create_edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
{
    $roleNames = Role::whereIn('id', $request->input('role_id'))->pluck('name')->toArray();

    $array = [];
    if ($request->password) {
        $array['password'] = Hash::make($request->password);
    }

    $updateData = array_merge($request->only('name', 'email', 'phone'), $array);
    $user->update($updateData);

    $user->syncRoles($roleNames);

    $user->syncPermissions($request->input('permissions'));

    return redirect(route('users.index'))->with('success', 'Updated successfully');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->deleted_by=auth()->id();
        $user->save();
        $user->delete();
        return redirect(route('users.index'))->with('success',' deleted successfully');
    }

    public function validateUsers($request){
        $valid=[
            'name'=>'required',
        ];
        if($request->user){

//            $valid['email']='required|email|unique:users,email,'.$request->user->id.',NULL,deleted_at,NULL';
            $valid['email']=['required','email',Rule::unique('users','email')->whereNull('deleted_at')->ignore($request->user->id,'id')];
            $valid['phone']=['required','min:8',Rule::unique('users','phone')->whereNull('deleted_at')->ignore($request->user->id,'id')];
        }else{
            $valid['email']=['required','email',Rule::unique('users','email')];
            $valid['phone']=['required','min:8',Rule::unique('users','phone')];

            $valid['password']='required|min:5';
        }
        return $request->validate($valid);
    }
    public function profile(){
        $user=auth()->user();
        return view('Dashboard.dashboard.users.profile',compact('user'));
    }
    public function profileUpdate(Request $request){
        $user=auth()->user();
        $request->validate([
            'name'=>'required',
            'email'=>['required','email',Rule::unique('users','email')->whereNull('deleted_at')->ignore($user->id,'id')],
            'old_password'=>'required',
            'new_password'=>'same:confirm_password'
        ]);
        if(!Hash::check($request->old_password,$user->password)){
            return redirect()->back()->withErrors(['old_password'=>__('Old password not matched')]);
        }
        $array=[];
        if($request->new_password){
            $array['password']=Hash::make($request->new_password);
        }
        $user->update(array_merge($request->only('name','email','phone'),$array));
        return redirect()->back()->with('success',' updated successfully');
    }

    public function rolesPermissions( Request $request)
    {
        $data = DB::table('role_has_permissions')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
            ->select('permissions.id', 'permissions.name', 'permissions.group', 'roles.id as role_id', 'roles.name as role_name')
            ->whereIN('role_id', json_decode(   $request['array']))
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

}
