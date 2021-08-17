<?php

namespace App\Http\Controllers\Company;
use App\models\Device;
use App\models\Location;
use App\models\DeviceSurvey;
use App\models\CompanySetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DataTables;

class DeviceController extends Controller
{
    public function companyId()
    {
      return  getCompanyId();
    }

    public function index(Request $request)
    {
        $devices = Device::where('company_id',$this->companyId())->orderBy('id', 'DESC')->get();
        foreach($devices as $device)
        {
            $surveyOnDevice = DeviceSurvey::where('device_id', $device->id)->count();
            if($surveyOnDevice==0)
            {
                $device['isDeployed'] = "NO";
            }
            else
            {
                $device['isDeployed'] = "YES";
            }
        } 

        if ($request->ajax()) {
            return Datatables::of($devices)
                
                ->addColumn('name', function($name){

                    return $name->name;
                })
                ->addColumn('pin', function($pin){

                    return $pin->pin;
                })
                ->addColumn('deploy', function($deploy){

                    return $deploy->isDeployed;
                })
                ->addColumn('action', function($row){

                $btn = '<a href="'. route('deviceEdit', $row->id) .'" class="btn btn-sm btn-icon waves-effect waves-light btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Category"><i class="fa fa-edit"></i></a>';
                
                $delBtn = ' <span onclick="myFunction('.$row->id.')" data-toggle="modal" data-target="#myModal"> <a class="btn btn-sm btn-icon waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Device"><i class="far fa-trash-alt"></i></a></span>';

                $qr = '';

                if($row->isDeployed=="YES")
                {
                    $qr = '<a href="'. route('generate-qrcode', $row->id) .'" class="btn btn-sm btn-icon waves-effect waves-light btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print QR"><i class="fa fa-print"></i></a>';
                }

                return $btn.' '.$delBtn.' '.$qr;
            })
                ->rawColumns(['name', 'pin', 'deploy', 'action'])
                ->make(true);     
        }


        return view('company.Device.list');
     }
   

    public function create()
    {
        $loctions = Location::where('status', 1)->where('company_id',$this->companyId())->get();
        return view('company.Device.create', ['loctions' => $loctions]);
    }

    public function store(Request $request)
    {
        $company = $this->companyId();

        Session::put('request', $request->name);

        $this->validate($request, [
            'name' => 'required|string|max:255|unique:devices,name,NULL,id,company_id,' .$company,
            'location_name' => 'required|exists:locations,id'    
        ]);

        Session::pull('request');

        /*Create random pin*/
        $randStr = rand(100, 999).''.$request->location_id;
        $pin = str_pad($randStr, 6, rand(1,9));

        $deviceData = [
            'name' => $request->name,
            'location_id' => $request->location_name,
            'pin' => $pin,
            'company_id' => $company
        ];

        Device::create($deviceData);
        Session::put('success','Device Created Successfully');
        return redirect('company/device/list');
    }

    public function edit($id)
    {       

        $device = Device::find($id);
        $loctions = Location::where('status', 1)->where('company_id',$this->companyId())->get();
        return view('company.Device.edit', ['device' => $device,'locations'=>$loctions]);
    }

    public function update(Request $request)
    {
        $company = $this->companyId();
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:devices,name,'.$request->id.' NULL,id,company_id,'.$company,
            'location_name' =>'required'

        ]);

        $device = Device::find($request->id);

        $locationData = [
            'name' => $request->name,
            'location_id' => $request->location_name,
        ];

        $device->update($locationData);
        Session::put('success','Device Updated Successfully');
        return redirect()->back();
    }

    public function remove($id)
    {
        $device = Device::findOrFail($id);
        if(isset($device))
            $device->delete();
        else
            return redirect()->route('deviceList');

            Session::put('success','Device Removed Successfully');
        return redirect()->back();
    }

    public function generate_QrCode($id)
    {
        $company = CompanySetting::where('company_id', $this->companyId())->first();
        return view('company.Device.qrcode', ['id' => $id,'qr_title'=>$company->qr_title]);
    }

}
