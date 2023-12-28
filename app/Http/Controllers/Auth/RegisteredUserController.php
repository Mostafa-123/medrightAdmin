<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Spatie\Permission\Models\Permission;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('Dashboard.auth.signup');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20', 'min:8', Rule::unique('users')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $role=Role::where('name','admin')->first();
        if($role){
            $permission=Permission::where('name','admin')->first();
            if($permission){
                $role->givePermissionTo($permission);
            }else{
                $permission = Permission::create(['name' => 'admin','group'=>'admin']);
                $role->givePermissionTo($permission);

            }
            $user->assignRole($role);
        }else{
            $role = Role::create(['name' => 'admin']);
            $permission=Permission::where('name','admin')->first();
            if($permission){
                $role->givePermissionTo($permission);
            }else{
                $permission = Permission::create(['name' => 'admin','group'=>'admin']);
                $role->givePermissionTo($permission);

            }
            $user->assignRole($role);
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
