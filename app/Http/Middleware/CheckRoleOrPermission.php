<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleOrPermission
{
    public function handle($request, Closure $next, ...$permissions)
    {
        $user = Auth::user();

        // Check if user is authenticated
        if (!$user) {
            return redirect('/'); // Redirect if not authenticated
        }
        // Flatten the permissions array to handle multiple permissions
        $flattenedPermissions = [];
        foreach ($permissions as $perm) {
            // Explode the string if it contains multiple permissions
            $flattenedPermissions = array_merge($flattenedPermissions, explode('|', $perm));
        }

        // Check if user has any of the specified permissions
        $hasPermission = $user->hasAnyPermission($flattenedPermissions);

        if (!$hasPermission) {
            return redirect('/'); // Redirect if no permissions
        }

        return $next($request);
    }
}
