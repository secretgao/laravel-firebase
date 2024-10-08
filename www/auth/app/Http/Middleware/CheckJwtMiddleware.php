<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckJwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        //登录会设置 jwt token 存入session ，以便判断没有session 跳转登录页面
        if (!Session::has('jwt_token')) {
            return redirect('/login');
        }
        return $next($request);
    }
}
