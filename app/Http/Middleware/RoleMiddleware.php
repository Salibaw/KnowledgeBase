<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized - Not logged in');
        }

        $user = Auth::user();

        // Langsung ambil dari kolom role (string)
        $userRole = $user->role; // ← ini string 'admin', 'teknisi', atau 'pelanggan'

        if (!$userRole) {
            abort(403, 'Unauthorized - User has no role');
        }

        // Case-insensitive comparison
        if (strtolower($userRole) !== strtolower($role)) {
            abort(403, "Unauthorized - Role mismatch. You are: {$userRole}");
        }

        return $next($request);
    }
}