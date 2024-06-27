<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectToHomepage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming request instance.
     * @param  \Closure  $next  The next middleware to be called.
     * @return mixed  The response to the request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the current route is 'dashboard'
        if ($request->routeIs('dashboard')) {
            // If the route is 'dashboard', redirect to the homepage
            return redirect('/');
        }

        // If the route is not 'dashboard', proceed with the next middleware or request
        return $next($request);
    }
}
