<?php

namespace App\Http\Controllers\Company;
use App\models\Question;
use App\Http\Controllers\Controller;
use App\models\Survey;
use App\models\TemplateCategory;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
          $questions = Question::where('survey_id',$id)->with('options')->orderBy('id', 'DESC')->withTrashed()->paginate(10); 
          $templates = TemplateCategory::whereHas('template')->get();
          return view('company.Question.index', ['questions' => $questions,'templates' =>$templates,'survey_id'=>$id]);
    }

    public function destroy(request $request)
    {
        $question = Question::findOrFail($request['id']);
        if($request['value']=="true")
        {
            Question::withTrashed()->find($request['id'])->restore();
        }
        else
        {
            $question->delete();
        }      
        return response()->json(['success'=>'Form is successfully submitted!','result'=>$request['id']]);
    }
}
