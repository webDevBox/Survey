<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Location;
use Hash;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{

    public function companyId()
    {
      return  getCompanyId();
    }

    public function index(Request $request)
    {
         $locations = Location::where('company_id',$this->companyId())->orderBy('id', 'DESC')->get();

         if ($request->ajax()) {
            return Datatables::of($locations)
                
                ->addColumn('name', function($name){

                    return $name->name;
                })
                ->addColumn('status',function ($status) {

                    if ($status->status == 1) 
                    {
                    return ' <div class="button r pull-left mr-2" id="button-1" >
                    <input type="checkbox" class="checkbox" id="'.$status->id.'" onclick="updateCompanyStatus(this)" checked>
                    <div class="knobs"></div>
                    <div class="layer"></div>
                  </div>
                  <div class="clearfix"></div>';
                    }
                    else
                    {
                        return ' <div class="button r pull-left mr-2" id="button-1" >
                    <input type="checkbox" class="checkbox" id="'.$status->id.'" onclick="updateCompanyStatus(this)" >
                    <div class="knobs"></div>
                    <div class="layer"></div>
                  </div>
                  <div class="clearfix"></div>';
                    }
                    
                   })
                   ->addColumn('action', function($row){

                    $btn = '<a href="'. route('locationEdit', $row->id) .'" class="btn btn-sm btn-icon waves-effect waves-light btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Category"><i class="fa fa-edit"></i></a>';
                    
                    $delBtn = '<span onclick="myFunction('.$row->id.')" data-toggle="modal" data-target="#myModal"><a class="btn btn-sm btn-icon waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Category"><i class="far fa-trash-alt"></i></a></span>';

                    return $btn.' '.$delBtn;
            })
                ->rawColumns(['name', 'status', 'action'])
                ->make(true);     
        }
         
         return view('company.Location.list');
    }
 
    public function create()
    {
        return view('company.Location.create');
    }

    public function store(Request $request)
    {
        $company =$this->companyId();

        Session::put('request', $request->name);
        Session::put('Description', $request->Description);
        Session::put('tags', $request->tags);

        $this->validate($request, [
            'name'        => 'required|string|max:255|unique:locations,name,NULL,id,company_id,' .$company,
            'Description' => 'nullable|string|max:255',
            'tags'        => 'nullable|string|max:255',
            'status'      => 'required',
        ]);

        Session::pull('request');
        Session::pull('Description');
        Session::pull('tags');
        
        $locationData = [
            'name' => $request->name,
            'status' => $request->status,
            'Description' =>$request->Description,
            'tags' => $request->tags,
            'company_id' => $company
        ];

        Location::create($locationData);
        Session::put('success','Outlet Created Successfully');
        return redirect('company/location/list');
    }

    public function edit($id)
    {
        $location = Location::find($id);
        return view('company.Location.edit', ['location' => $location]);
    }

    public function update(Request $request)
    {
        $company =$this->companyId();

        $this->validate($request, [
            'name'        => 'required|string|max:255|unique:locations,name,'.$request->id.' NULL,id,company_id,'.$company,
            'Description' => 'nullable|string|max:255',
            'tags'        => 'nullable|string|max:255',
            'status'      => 'required',
        ]);

        $location = Location::find($request->id);

        $locationData = [
            'name' => $request->name,
            'status' => $request->status,
            'Description' =>$request->Description,
            'tags' => $request->tags

        ];

        $location->update($locationData);
        $location->save();

        Session::put('success','Outlet Updated Successfully');
        return redirect()->back();
    }

    public function remove($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        Session::put('success','Outlet Deleted Successfully');
        return redirect()->back();
    }

    public function activeInactive(Request $request, $id)
    {
        $location = Location::find($id);
        $location->status = !$location->status;
        $location->save();
        return response()->json(['status' => true]);
    }
}
