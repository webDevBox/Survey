<?php

namespace App\Http\Controllers\Admin;
use App\models\Company;
use App\models\CompanySetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use DataTables;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
         $companies = Company::orderBy('id', 'DESC')->get();

         if ($request->ajax()) {
            return Datatables::of($companies)
                
                ->addColumn('name', function($name){

                    return $name->name;
                })
                ->addColumn('email', function($email){

                    return $email->email;
                })
                ->addColumn('status',function ($status) {
                    if ($status->status == 1) return 'Yes';
                    if ($status->status == 0) return 'No';
                   })
                ->addColumn('verified',function ($verified) {
                    if ($verified->email_verified_at == null) return 'No';
                    if ($verified->email_verified_at != null) return 'Yes';
                   })
                   ->addColumn('action', function($row){

                    $btn = '<a href="'. route('companyDashboard', $row->id) .'" class="btn btn-sm btn-icon waves-effect waves-light btn-success" target="_blank">Login</a>';

                    return $btn;
            })
                ->rawColumns(['name', 'email', 'status', 'verified', 'action'])
                ->make(true);     
        }
        
         return view('admin.company.index');
    }

    public function create()
    {
        return view('admin.company.create');    
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:companies,name|max:40|regex:/^[a-zA-Z 0-9]+$/u', 
            'email' => 'required|unique:companies|email|regex:/^[a-zA-Z._@0-9]+$/u',
        ]);

        $token = md5(rand());
        $companyData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' =>"123456",
            'logo' =>"default.jpg",
            'remember_token' => $token,
        ];
       $company =  Company::create($companyData);
       $companySettingData = [
            'company_id' => $company->id,
            'bg_color' => "	#FFFFFF",
            'bg_image' =>"background.png",
            'btn_submit_color' =>"#09B785",
            'btn_cancel_color' => "#F2F2F2",
            'qr_title' => "Please Scan QrCode and give us Feedback"
        ];
        CompanySetting::create($companySettingData);
        $url = env('APP_URL');
        try {
           $mail = Mail::to($request->email)->send(new \App\Mail\CompanyRegistration($request->name, $url, $token));  
        } catch (\Exception $th) {
            $th->getMessage();
        }                                      
        return redirect('admin/company/list')->with('success', 'Company Created Successfully');
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'companyId' => 'required|integer|exists:companies,id',
            'password'  => 'required|min:6|confirmed',
        ]);

        $company = Company::find($request->companyId);

        $company->password = Hash::make($request->password);
        $company->save();

        return redirect()->back()->with('success', 'Password has been successfully reset!');
    }

    public function updateStatus(Request $request)
    {
        $company = Company::findOrFail($request->companyId);
        DB::beginTransaction();
        try {

            $company->status = !$company->status;
            $company->reason = (!is_null($request->reason))?$request->reason:null;
            $company->save();
            // $subject = ($company->status)?"Enable":"Disable";
            $subject = "Company Account Enabled";
            if($company->status == 0)
            {
                $subject = "Company Account Disabled";
            }
            
            $mail = Mail::to($company->email)->send(new \App\Mail\EnableDisableComapny($company, $subject));

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            \Log::alert('Email not being sent "'.$e->getMessage().'"'.json_encode($company));
            return redirect()->back()->with('error', 'There is error while sending email, kindly contact with Administration!');
        }

        return redirect()->back()->with('success', $subject);
    }
}
