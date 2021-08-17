<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\TemplateOption;
use App\models\Template;
use Hash;
use DataTables;

class TemplateOptionController extends Controller
{
    public function index(Request $request)
    {
        $icons = TemplateOption::orderBy('id', 'DESC')->with('template')->get();

        if ($request->ajax()) {
            return Datatables::of($icons)
                ->addColumn('name', function($name){
                    return $name->name;
                })
                ->addColumn('label', function($label){
                    return $label->label;
                })
                ->addColumn('selection', function($selection){

                    return $selection->template->name;
                })
                   ->addColumn('action', function($row){

                    $btn = '<a href="'. route('templateoptionsEdit', $row->id) .'" class="btn btn-sm btn-icon waves-effect waves-light btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Category"><i class="fa fa-edit"></i></a>';
                    
                    $delBtn = '<span onclick="myFunction('.$row->id.')" data-toggle="modal" data-target="#myModal"><a class="btn btn-sm btn-icon waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Category"><i class="far fa-trash-alt"></i></a></span>';

                    return $btn.' '.$delBtn;
            })
                ->rawColumns(['label'. 'selection', 'action'])
                ->make(true);     
        }
        
        return view('admin.icons.list');
    }

    public function create()
    {
        $templates = Template::get();
        return view('admin.icons.create', ['templates' => $templates]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:template_options,name,NULL,id,template_id,' .$request->templateName,
            'templateName' =>'required',
            'label' => 'required',
        ]);

        $templateoptionsData = [
            'name' => $request->name,
            'template_id' => $request->templateName,
            'label' => $request->label 
        ];
        TemplateOption::create($templateoptionsData);
        return redirect('admin/template/option/list')->with('success', 'Template Options Created Successfully');
    }

    public function edit($id)
    {
        $icon = TemplateOption::find($id);
        $templates = Template::get();
        return view('admin.icons.edit', ['icon' => $icon,'templates'=>$templates]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:template_options,name,'.$request->id.' NULL,id,template_id,'.$request->templateName,
            'templateName' =>'required',
            'label' => 'required'

        ]);

        $icons = TemplateOption::find($request->id);
        $templateoptionsData = [
            'name' => $request->name,
            'template_id' => $request->templateName,
            'label' => $request->label
        ];
        $icons->update($templateoptionsData);
        return redirect('admin/template/option/list')->with('success', 'Template Options Updated Successfully');
    }

    public function remove($id)
    {
        $icons = TemplateOption::findOrFail($id);
        $icons->delete();
        return redirect('admin/template/option/list')->with('success', 'Template Options Removed Successfully');
    }
}
