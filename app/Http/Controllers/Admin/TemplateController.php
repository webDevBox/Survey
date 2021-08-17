<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Template;
use Illuminate\Http\File;
use App\models\TemplateCategory;
use Hash;
use DataTables;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
         $tempaltes = Template::orderBy('id', 'DESC')->with("template_category")->get();

         if ($request->ajax()) {
            return Datatables::of($tempaltes)
                ->addColumn('name', function($name){
                    return $name->name;
                })
                ->addColumn('selection', function($selection){

                    return $selection->template_category->name;
                })
                   ->addColumn('action', function($row){

                    $btn = '<a href="'. route('templateEdit', $row->id) .'" class="btn btn-sm btn-icon waves-effect waves-light btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Category"><i class="fa fa-edit"></i></a>';
                    
                    $delBtn = '<span onclick="myFunction('.$row->id.')" data-toggle="modal" data-target="#myModal"><a class="btn btn-sm btn-icon waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Category"><i class="far fa-trash-alt"></i></a></span>';

                    return $btn.' '.$delBtn;
            })
                ->rawColumns(['name', 'selection', 'action'])
                ->make(true);     
        }

         return view('admin.Template.list');
    }
 
    public function create()
    {
        $templateCategories = TemplateCategory::get();
        return view('admin.Template.create', ['templateCategories' => $templateCategories]);
    }

    public function store(Request $request)
    {
        $imageUrl="";
        $this->validate($request, [
            'name' => 'required|unique:templates,name,NULL,id,template_category_id,' .$request->categoryName,
            'categoryName' =>'required',
            'image' => 'required|dimensions:max_width=340,max_height=56'
        ]);
        
        if ($request->hasFile('image')) {

            $imageUrl = $request->image->store('templates');
        } 

        $data = [
            'name' => $request->name,
            'template_category_id' => $request->categoryName,
            'imageUrl' =>  $imageUrl
        ];
        Template::create($data);
        return redirect()->route('templateList')->with('success', 'Template Created Successfully');
    }

    public function edit($id)
    {       
        $template = Template::find($id);
        $templateCategories = TemplateCategory::get();      
        return view('admin.Template.edit', ['template' => $template,'templateCategories'=>$templateCategories]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:templates,name,'.$request->id.' NULL,id,template_category_id,'.$request->categoryName,
            'categoryName' =>'required',
            'image' => 'nullable|dimensions:max_width=340,max_height=56'
        ]);

        $template = Template::find($request->id);


        $templateData = [
            'name' => $request->name,
            'template_category_id' => $request->categoryName,
        ];

        $template->update($templateData);
       
        if ($request->hasFile('image')) {

            Storage::delete($template->imageUrl);

            $imageUrl = $request->image->store('templates');
            $template->update(['imageUrl'=> $imageUrl]);
        } 
        return redirect('admin/template/list')->with('success', 'Template Updated Successfully');
    }

    public function remove($id)
    {
        $template = Template::findOrFail($id);
        $template->delete();
        return redirect('admin/template/list')->with('success', 'Template Removed Successfully');
    }
}
