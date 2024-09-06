<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManageUsersMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
