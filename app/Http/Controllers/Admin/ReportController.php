<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Company;
use App\models\Survey;
use App\models\Question;
use App\models\Location;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ReportTrait;
use App\Http\Traits\ExportSurveyReportTrait;
use App\Http\Service\ReportService;
use Carbon\Carbon;
use App\Exports\SurveyExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
	use ReportTrait, ExportSurveyReportTrait;

    public function index(Request $request)
    {
        $dates     = dateRange($request);
        $companies = $this->_companiesWithSurveys($dates['from'], $dates['to']);
        return view('admin.reports.index')->with('companies',$companies);
    }

    // public function loadMoreCompanies(Request $request)
    // {
    //     $dates     = dateRange($request);
    // if($request->ajax())
    //  {
    //   if($request->id > 0)
    //   {
    //     $companies = $this->_companiesWithSurveysAjax($dates['from'], $dates['to'],$request->id);
    //   }
    //   else
    //   {
    //     $companies = $this->_companiesWithSurveysAjaxNew($dates['from'], $dates['to']);
    //   }
    //     return response()->json(['data'=>$companies]);
    //  }
    // }

    public function byLocation(Request $request, $companyId, $locationId=null)
    {
        $locations = Location::whereCompanyId($companyId)->get();
        $surveys   = array();
        if (isValid($locations)) {
    		if (is_null($locationId)) {
    	        $locationId = $locations[0]->id;
    	    }

    	    $location      = Location::find($locationId);
        	$deviceSurveys = $location->deviceSurveys;
        	$surveys['surveys'] = $this->_deployedServeys($deviceSurveys);
            $surveys['locationId'] = $locationId;
        }

        $data['locations'] = $locations;
        $data['surveys']   = $surveys;
        $data['type']      = 'admin';
        $data['companyId']  = $companyId;
        $data['locationId'] = $locationId;

        if ($request->ajax()) {
            return json_encode($surveys);
        }
    	return view('admin.reports.by-location', ['response' => $data]);
    }

    public function surveyByLocation($locationId, $surveyId)
    {
        $survey    = Survey::with('questions')->has('questions')->whereId($surveyId)->first();

        $from = parse_by_format($survey->created_at, 'Y-m-d');
        $to   = Carbon::now()->toDateString();

        $questions = $survey->questions;
        if (isValid($questions)) {
            $response = $this->_surveyDetailsByLocation($survey, $questions[0], $locationId,$from, $to);
            $response['type'] = 'admin';
            $response['locationId'] = $locationId;
            $response['fromDate'] = parse_by_format($from, 'F d, Y');
            $response['toDate']   = parse_by_format($to, 'F d, Y');
        }

        return view('admin.reports.by-location-show', ['reportData' => $response]);
    }

    public function surveyQuestionByLocation($surveyId, $questionId, $locationId)
    {
        $survey   = Survey::with('questions')->has('questions')->whereId($surveyId)->first();

        $from = parse_by_format($survey->created_at, 'Y-m-d');
        $to   = Carbon::now()->toDateString();

        $question = Question::whereId($questionId)->get();
        if (isValid($question)) {
            $response = $this->_surveyDetailsByLocation($survey, $question[0], $locationId,$from, $to);
            $response['type'] = 'admin';
            $response['locationId'] = $locationId;
        }

        return json_encode($response);
    }

    public function show($surveyId)
    {
        $survey    = Survey::with('questions')->has('questions')->whereId($surveyId)->first();

        $from = parse_by_format($survey->created_at, 'Y-m-d');
        $to   = Carbon::now()->toDateString();

        $questions = $survey->questions;
        if (isValid($questions)) {
            $response = $this->_surveyDetails($survey, $questions[0], $from, $to);
            $response['type'] = 'admin';
        }

    	return view('admin.reports.show', ['reportData' => $response]);
    }

    public function surveyQuestion(Request $request, $surveyId, $questionId)
    {
        $dates = dateRange($request);
        $from  = $dates['from'];
        $to    = $dates['to'];

        $errors   = array();
        $errors['message'] = '';
        
        $survey   = Survey::with('questions')->has('questions')->whereId($surveyId)->first();
        $question = $survey->questions()->whereId($questionId)->get();
        if (isValid($question)) {
            $response = $this->_surveyDetails($survey, $question[0], $from, $to);
        }else{
            $errors['message'] = "Survey is incomplete!";
        }
        return json_encode($response);
    }

    public function export($surveyId) 
    {
        $lstmfD = Carbon::now()->startOfMonth()->subMonth()->toDateString();
        $lstmlD = Carbon::now()->toDateString();

        $survey    = Survey::with('questions')->has('questions')->whereId($surveyId)->first();
        $questions = $survey->questions;
        if (isValid($questions)) {
            $response   = $this->_surveyDetailsQuestionBasedExport($survey, $questions, $lstmfD, $lstmlD);
            $reportName = 'Surveyapp-Report-'.strtolower($survey->name);
            return Excel::download(new SurveyExport($survey, $response), $reportName.'.xlsx');
        }
        return redirect()->back()->with('error', 'Can\'t export survey into excel as no questions found!');
    }

    public function exportByLocation($surveyId, $locationId)
    {
        $lstmfD = Carbon::now()->startOfMonth()->subMonth()->toDateString();
        $lstmlD = Carbon::now()->toDateString();

        $survey    = Survey::with('questions', 'feedback')->has('questions')->whereId($surveyId)->first();
        $deviceId = 0;
        foreach ($survey->device as $key => $device) {
            if ($device->location_id == $locationId) {
                $deviceId = $device->id;
                break;
            }
        }
        $questions = $survey->questions;
        if (isValid($questions)) {
            $response   = $this->_surveyDetailsQuestionBasedExport($survey, $questions, $deviceId, $lstmfD, $lstmlD);
            $reportName = 'Surveyapp-Report-'.strtolower($survey->name);
            return Excel::download(new SurveyExport($survey, $response), $reportName.'.xlsx');
        }
        return redirect()->back()->with('error', 'Can\'t export survey into excel as no questions found!');
    }
}
