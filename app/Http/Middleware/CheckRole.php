<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function getRoute(){
        return Route::current()->getName();
    }
    public function handle($request, Closure $next)
    {
        //return $next($request);
        if (auth()->check()){
            $type=null;
            $page=null;
            if(str_contains($this->getRoute(),'.')){
                list($type,$page)=explode('.',$this->getRoute());
            }
            if($this->getRoute()=='admin_home'||PerUser($this->getRoute())||($page=='multi_destroy'&&PerUser($type.'.destroy'))
            ||($page=='store'&&PerUser($type.'.create'))||($page=='update'&&PerUser($type.'.edit'))||($page=='change_status'&&PerUser($type.'.edit'))||
            in_array($this->getRoute(),['dashboard','users.profile','users.profile_update'])){
                return $next($request);}else{
                    return redirect()->route('error.view');
                }
        }
        return redirect()->route('redirect');
    }
}
