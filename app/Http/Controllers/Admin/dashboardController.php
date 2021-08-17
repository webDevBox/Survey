<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\User;
use App\models\TemplateCategory;
use App\models\Song;
use App\models\Admin;
use App\models\Tag;
use App\models\VideoTag;
use App\models\Company;
use App\models\Template;
use App\models\Location;
use App\models\Device;
use App\models\Feedback;
use App\models\Survey;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use Hash;
use Auth;

class dashboardController extends Controller
{
    public function index()
    {
        $totalCompanies = Company::whereNotNull('email_verified_at')->count();
        $totalTemplateCategories = TemplateCategory::count();
        $totalTemplates = Template::count();
        $totalLocations = Location::count();
        $totalDevices = Device::count();
        $totalFeedback = Feedback::count();
        $totalSurvey = Survey::count();

        return view('admin.dashboard.dashboard', ['totalCompanies' => $totalCompanies, 'totalTemplateCategories' => $totalTemplateCategories,
        'totalTemplates' => $totalTemplates, 'totalLocations' => $totalLocations, 'totalDevices' => $totalDevices,
        'totalFeedback' => $totalFeedback, 'totalSurvey' => $totalSurvey]);
    }

    public function account()
    {
        $admin = Admin::where('id' ,Auth::guard('admin')->id())->first();
        return view('admin.account.edit',['admin' => $admin]);
    }

    public function UpdateAccount(Request $request)
    {
        $messages = [
            'dimensions' => 'Image Dimension must be 500x500',
        ];
        $request->validate([
            'logo' => 'image | mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|max:40|regex:/^[a-zA-Z ]+$/u',
            'password' => 'nullable|min:6|confirmed'
        ],$messages);
        $imageUrl = "";
        $AdminUser = Admin::where('id' ,Auth::guard('admin')->id())->first();

        if ($request->hasFile('logo')) {

            Storage::delete($AdminUser->logo);

            $imageUrl = $request->logo->store('admin');            
        }

        if($imageUrl!=null)
        {
            $user = [
                'logo' =>$imageUrl,   
            ];
            $AdminUser->update($user);
        } 


        $user = [
            'name' => $request->name,
        ];

        $AdminUser->update($user);

        if($request->password)
        {    $userData = [
            'password' => Hash::make($request->password),
        ];
        $AdminUser->update($userData);
        }     
        return redirect()->back()->with('success', 'Profile Updated Successfully');       
    }
}
