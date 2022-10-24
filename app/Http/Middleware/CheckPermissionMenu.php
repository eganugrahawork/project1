<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\MenuAccess;
use Closure;
use Illuminate\Http\Request;

class CheckPermissionMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $url)
    {
dd($url);
            $menu_id = Menu::select('id')->where(['url' => $url])->first();
            $role_id = auth()->user()->role_id;

            $check = MenuAccess::where(['role_id' => $role_id, 'menu_id' => $menu_id->id])->first();

            if($check){
                return $next($request);
            }else{
                return redirect('/blocked');
            }
    }
}
