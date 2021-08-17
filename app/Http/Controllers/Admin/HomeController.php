<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Admin;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Auth;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:191',
            'password' => 'required|min:3',
        ]);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }

        if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('adminDashboard');
        } else {
            $arrayWithErrors = [
                'error' => "Incorrect Email or Password! Or Your Email is not Verified Yet!",
      
            ];       
            return back()->withErrors($arrayWithErrors)->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('showAdminLogin');
    }

    public function termsAndPrivacy(Request $request)
    {
        return view('termsAndPrivacy');
    }
}
