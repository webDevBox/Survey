<?php

namespace App\Http\Controllers\Company;

use App\models\CompanySetting;
use App\models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Camroncade\Timezone\Facades\Timezone;
use Illuminate\Http\File;
use Image;

class CompanySettingController extends Controller
{

    public function companyId()
    {
      return  getCompanyId();
    }

    public function edit(Request $request, CompanySetting $companySetting)
    {
        $companySetting = CompanySetting::where('company_id' ,$this->companyId())->with("company")->first();  

        $timezone_select = Timezone::selectForm(
            $companySetting->timezone, 
            '', 
            ['class' => 'form-control', 'name' => 'timezone']
        );
        return view('company.companySetting.edit', ['companySetting' => $companySetting], compact('timezone_select'));
    }

    public function update(Request $request)
    {
        $imageUrl="";
        $this->validate($request, [
        	// 'bg_color'         => 'required',
        	'btn_submit_color' => 'required',
        	// 'btn_cancel_color' => 'required',
            'qr_code_title'    => 'required|max:100',
            'backgroun_image'  => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);

        $companySetting = CompanySetting::find($request->id);

        $company = Company::find($companySetting->company_id);


        $removeFileFlag = $request->removeFile;
        //Company Settings
        if ($request->hasFile('backgroun_image')) {

            Storage::delete('company/'.$companySetting->bg_image);

            $image = $request->backgroun_image;
            $fileName = $image->getClientOriginalName();

            $ext = pathinfo($fileName, PATHINFO_EXTENSION);

            if($ext == 'jfif')
                $ext = 'jpg';

            $imageUrl = time() .'.'.$ext;
            
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(1440,2960);
            $image_resize->save(public_path('images/company/'.$imageUrl));

           // $imageUrl = $request->backgroun_image->store('company');        

        }
        
        if($imageUrl!=null && $removeFileFlag == "false" )
        {
            $previousImg = $companySetting->bg_image;
            $companySettingData = [
                'bg_image' =>$imageUrl,   
            ];
            $companySetting->update($companySettingData);
            removeImage($previousImg);
        }

        if ($removeFileFlag == "true") {
            $previousImg = $companySetting->bg_image;
            $companySettingData = [
                'bg_image' => "background.png",   
            ];
            $companySetting->update($companySettingData);
            removeImage($previousImg);
        }


        $companySettingData = [
            // 'bg_color' => $request->bg_color,
            'btn_submit_color' =>$request->btn_submit_color,
            // 'btn_cancel_color' =>$request->btn_cancel_color,
            'qr_title' => $request->qr_code_title,
            'timezone' => $request->timezone
        ];
        $companySetting->update($companySettingData);
        Session::put('success', 'Settings Updated Successfully');
        return redirect()->back();
    }
}
