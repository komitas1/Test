<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ManagerMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if(  Auth::user()->role == User::USER_MANAGER ){
            return $next($request);
        }else{
            abort(403);
        }
    }
}
