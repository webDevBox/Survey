<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Company;
use App\models\Survey;
use App\models\Location;
use App\models\Question;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ReportTrait;
use App\Http\Traits\ExportSurveyReportTrait;

use App\Exports\SurveyExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DataTables;

class ReportController extends Controller
{
    use ReportTrait, ExportSurveyReportTrait;

    public function index(Request $request)
    {
        $company = getCompany();

        if ($request->ajax()) {
            $surveys = Survey::with('device')->has('latestFeedback')->whereCompanyId($company->id)->orderBy('id', 'desc')->get();
            return Datatables::of($surveys)
                    ->addColumn('name', function($survey){
                        return $survey->name;
                    })
                    ->addColumn('total_devices', function($survey){
                        return (isValid($survey->device))?count($survey->device):0;
                    })
                    ->addColumn('created_at', function($survey){
                        return parse_by_format(optional($survey->latestFeedback[0])->created_at, "M d, Y g:i A");
                    })
                    ->addColumn('action', function($survey){
                        $btn = '<a href="'.route('company.survey.feedbacks', $survey->id).'"  class="btn btn-sm btn-icon waves-effect waves-light btn-primary ml-1" data-toggle="tooltip" data-placement="top" title="Feedback Responses"> <i class="far fa-comment-dots"></i></a>';

                        $btn = $btn.'<a href="'.route('company.reports.show', $survey->id).'" class="btn btn-sm btn-icon waves-effect waves-light btn-primary ml-1" data-toggle="tooltip" data-placement="top" title="Question Wise Survey Report"><i class="fas fa-chart-line"></i></a>';

                        $btn = $btn.'<a href="'.route('company.export', $survey->id).'" class="btn btn-sm btn-icon waves-effect waves-light btn-primary ml-1" data-toggle="tooltip" data-placement="top" title="Export Survey Report Excel Format"> <i class="far fa-file-excel"></i></a>';

                        $btn = $btn.'<a href="'.route('company.reports.overall.survey', $survey->id).'" class="btn btn-sm btn-icon waves-effect waves-light btn-primary ml-1" data-toggle="tooltip" data-placement="top" title="Overall Report"> <i class="fa fa-bar-chart-o"></i></a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('company.reports.index');
    }

    public function show($surveyId)
    {
        $survey    = Survey::with('questions')->has('questions')->whereId($surveyId)->first();

        $from = parse_by_format($survey->created_at, 'Y-m-d');
        $to   = Carbon::now()->toDateString();

        $questions = $survey->questions;
        if (isValid($questions)) {
            $response = $this->_surveyDetails($survey, $questions[0], $from, $to);
            $response['type'] = 'company';
        }

        $response['fromDate'] = parse_by_format($from, 'F d, Y');
        $response['toDate']   = parse_by_format($to, 'F d, Y');

    	return view('company.reports.show', ['reportData' => $response]);
    }

    public function overallSurveyReport(Request $request, $surveyId)
    {
        $survey    = Survey::whereId($surveyId)->first();

        $dates = dateRange($request);
        if (empty($dates)) {
            $dates['from'] =  parse_by_format($survey->created_at, 'Y-m-d');
            $dates['to']   =  Carbon::now()->toDateString();
        }

        $response = $this->_overallSurveyReport($surveyId, $dates['from'], $dates['to']);

        return view('company.reports.overall', ['response' => json_encode($response)]);
    }

    public function surveyQuestion(Request $request, $surveyId, $questionId)
    {
        $dates = dateRange($request);
        $from  = $dates['from'];
        $to    = $dates['to'];

        $errors = array();
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

    public function byLocation(Request $request, $locationId=null)
    {
        $company = getCompany();

        $data = array();
        $surveys   = array();
        $locations = $company->locations;
        if (isValid($locations)) {
            if (is_null($locationId)) {
                $locationId = $locations[0]->id;
            }

            $location      = Location::find($locationId);
            $deviceSurveys = $location->deviceSurveys;
            $surveys['surveys']    = $this->_deployedServeys($deviceSurveys);
            $surveys['locationId'] = $locationId;
        }

        $data['locations'] = $locations;
        $data['surveys']   = $surveys;
        $data['type']      = 'company';
        $data['locationId'] = $locationId;
        if ($request->ajax()) {
            return json_encode($surveys);
        }
        return view('company.reports.by-location', ['response' => $data]);
    }

    public function surveyByLocation($locationId, $surveyId)
    {
        $survey = Survey::with('questions')->has('questions')->whereId($surveyId)->first();
        $from   = parse_by_format($survey->created_at, 'Y-m-d');
        $to     = Carbon::now()->toDateString();

        $questions = $survey->questions;
        if (isValid($questions)) {
            $response = $this->_surveyDetailsByLocation($survey, $questions[0], $locationId,$from, $to);
            $response['type'] = 'company';
            $response['locationId'] = $locationId;
            $response['fromDate'] = parse_by_format($from, 'F d, Y');
            $response['toDate']   = parse_by_format($to, 'F d, Y');
        }

        return view('company.reports.by-location-show', ['reportData' => $response]);
    }

    public function surveyQuestionByLocation($surveyId, $questionId, $locationId)
    {
        $survey = Survey::with('questions')->has('questions')->whereId($surveyId)->first();

        $from = parse_by_format($survey->created_at, 'Y-m-d');
        $to   = Carbon::now()->toDateString();

        $question = Question::whereId($questionId)->get();
        if (isValid($question)) {
            $response = $this->_surveyDetailsByLocation($survey, $question[0], $locationId,$from, $to);
            $response['type'] = 'company';
            $response['locationId'] = $locationId;
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
            $response   = $this->_surveyDetailsQuestionBasedExport($survey, $questions, null ,$lstmfD, $lstmlD);
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
            return Excel::download(new SurveyExport($survey, $response), $reportName.'-by-location.xlsx');
        }
        return redirect()->back()->with('error', 'Can\'t export survey into excel as no questions found!');
    }
}
