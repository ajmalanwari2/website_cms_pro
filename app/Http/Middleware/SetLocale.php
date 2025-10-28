<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): \Symfony\Component\HttpFoundation\Response
    {
        // check if local session exists then updte the local
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        }
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Retrieve the language from the user table and set the application's locale
            if ($user->lang) {
                App::setLocale($user->lang);
            }
        }
        return $next($request);
    }
}
