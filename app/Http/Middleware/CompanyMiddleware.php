<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\models\Company;

class CompanyMiddleware
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
        if (Auth::guard('company')->check() || Auth::guard('admin')->check()) {
          if ($request->companyId) {
            $company = Company::findOrFail($request->companyId);
          }elseif(\Session::get('companyIdM')){
            $company = Company::findOrFail(\Session::get('companyIdM'));
          }else{
            $company = Auth::guard('company')->user();
          }

          saveCompanyIdIntoSession($company->id);
          
          $companyFlag = false;
          if ($company->active()) {
            $companyFlag = true;
          }
          app()->instance('active', $companyFlag);

          $timezone = "UTC";
          if (isset($company->setting)) {
            $timezone = $company->setting->timezone;
          }
          app()->instance('companyTimezone', $timezone);
          
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
        return redirect('/company/login');
    }
}
