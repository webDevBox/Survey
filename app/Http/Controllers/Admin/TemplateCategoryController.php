<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\TemplateCategory;
use Hash;
use DataTables;

class TemplateCategoryController extends Controller
{
    public function index(Request $request)
    {
         $templateCategories = TemplateCategory::orderBy('id', 'DESC')->get();

         if ($request->ajax()) {
            return Datatables::of($templateCategories)
                ->addColumn('name', function($name){
                    return $name->name;
                })
                ->addColumn('selection', function($selection){

                    return $selection->selection_type;
                })
                   ->addColumn('action', function($row){

                    $btn = '<a href="'. route('templateCategoryEdit', $row->id) .'" class="btn btn-sm btn-icon waves-effect waves-light btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Category"><i class="fa fa-edit"></i></a>';
                    
                    $delBtn = '<span onclick="myFunction('.$row->id.')" data-toggle="modal" data-target="#myModal"><a class="btn btn-sm btn-icon waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Category"><i class="far fa-trash-alt"></i></a></span>';

                    return $btn.' '.$delBtn;
            })
                ->rawColumns(['name', 'selection', 'action'])
                ->make(true);     
        }

         return view('admin.TemplateCategory.list');
    }

    public function create()
    {
        return view('admin.TemplateCategory.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:template_categories,name',
            'selection_type' =>'required'
        ]);

        $categoryData = [
            'name' => $request->name,
            'selection_type'=> $request->selection_type
        ];
        TemplateCategory::create($categoryData);
        return redirect('admin/template/category/list')->with('success', 'Template Category Created Successfully');
    }

    public function edit($id)
    {
        $templateCategory = TemplateCategory::find($id);
        return view('admin.TemplateCategory.edit', ['templateCategory' => $templateCategory]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:template_categories,name,'.$request->id ,
            'selection_type' =>'required'
        ]);

        $templateCategory = TemplateCategory::find($request->id);
        $templateCategoryData = [
            'name' => $request->name,
            'selection_type'=> $request->selection_type
        ];
        $templateCategory->update($templateCategoryData);
        $templateCategory->save();
        return redirect('admin/template/category/list')->with('success', 'Template Category Updated Successfully');
    }

    public function remove($id)
    {
        $templateCategory = TemplateCategory::findOrFail($id);
        $templateCategory->delete();
        return redirect('admin/template/category/list')->with('success', 'Template Category Deleted Successfully');
    }
}
