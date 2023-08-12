<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\BindRole;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        $userId = auth()->user()->id;
        $role = BindRole::where('user_id', $userId)->first();
        if($role && $role->role_id === 1){
            return $next($request);
        }
        return redirect()->intended('/login');
    }
}
