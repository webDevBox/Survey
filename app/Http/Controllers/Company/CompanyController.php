<?php

namespace App\Http\Controllers\Company;
use App\models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Validator;
use Auth;

class CompanyController extends Controller
{
    public function companyId()
    {
       return  getCompanyId();
    }

    public function edit()
    {
        $company = Company::where('id' ,$this->companyId())->first();  
        return view('company.account.edit', ['company' => $company]);
    }

    public function update(Request $request)
    {
        if(isset($request->submit) && $request->submit == 'Update')
        {
        $messages = [
            'dimensions' => 'Image Dimension must be 500x500',
        ];
        $this->validate($request, [
        'logo' => 'image | mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'required|max:40|regex:/^[a-zA-Z 0-9]+$/u|unique:companies,name,'.$request->id ,
        'contact_person_name'=> 'nullable|max:40|regex:/^[a-zA-Z ]+$/u',
        'contact_person_phone' =>'nullable|max:20|regex:/^[-+0-9]+$/',
        'password' => 'nullable|min:6|confirmed'
        ],$messages);

        $imageUrl='';

        //Company 
        $company = Company::find($this->companyId());
        
        if ($request->hasFile('logo')) {

            Storage::delete($company->logo);

            $imageUrl = $request->logo->store('company');            
        }
        

        if($imageUrl!=null)
        {
            $companyData = [
                'logo' =>$imageUrl,   
            ];
            $company->update($companyData);
        } 
        $companyData = [
            'name' => $request->name,
            'contact_person_name' => $request->contact_person_name,
            'contact_person_phone' => $request->contact_person_phone
        ];
        $company->update($companyData);

          if($request->password)
          {  $userData = [
            'password' => Hash::make($request->password),
                         ];
         $company = Company::find($this->companyId());
         $company->update($userData);
            }
            
        }
        Session::put('success','Profile Updated Successfully');
            
        return redirect()->back();
    }


    //Verify Company
    public function company_verification(Request $request)
    {
        $expired = false;
        $count_company = Company::where('remember_token', $request->get('token'))->count();
        if ($count_company == 0) {
            $expired = true;
        }

        return view('company.account.company_verification', ['expired' => $expired]);
    }

    //Set password
    public function set_password(Request $request)
    {     
        $company = Company::where('remember_token', $request->post('token'))->first();      
        $loginData = [
            'password' => Hash::make($request->post('password')),
            'remember_token' => "",
            'email_verified_at' => now(),
        ];

        if($company!=null)
        {
            $company->update($loginData);
            return redirect('company/login')->with('message', 'your password is reset please login');
        }
        else
        {
            print ' <div class="alert alert-danger msg_password_mismatch" role="alert">
            Sorry!!! link is expired.
      </div>';
        } 
    }

    public function logout(Request $request)
    {
        $request->session()->forget('companyIdM');
        Auth::guard('company')->logout();
        return redirect()->route('company-login');
    }

    //Return Company Login page
    public function login(Request $request)
    {
        $request->session()->forget('companyIdM');
        return view('company.account.company_login');
    }

    //Authenticate login Info
    public function add_login(Request $request)
    {
        $request->session()->forget('companyIdM');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|regex:/^[a-zA-Z._@0-9]+$/u',
            'password' => 'required',
        ]);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }

        if (Auth::guard('company')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('companyDashboard');
        } else {
            // return redirect()->back()->with('loginerror', 'Incorrect Email or Password! Or Your Email is not Verified Yet!');
            $arrayWithErrors = [
                'error' => "Incorrect Email or Password! Or Your Email is not Verified Yet!",
      
            ];
           
            return back()->withErrors($arrayWithErrors)->withInput();
        }
    }
}
