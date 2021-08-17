<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user() != null) {
            app()->instance('companyTimezone', "UTC");
            $handle = $next($request);

            if(method_exists($handle, 'header')){
                // Standard HTTP request.
                return $handle->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                ->header('Pragma','no-cache')
                ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
            }

            // Download Request?
            $handle->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
            $handle->headers->set('Pragma','no-cache');
            $handle->headers->set('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
            return $handle;
        }
        return redirect('/admin/login');
    }
}
