<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $adminId = session('admin');

        if (!$adminId || !Admin::find($adminId)) {
            session()->forget('admin');
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
