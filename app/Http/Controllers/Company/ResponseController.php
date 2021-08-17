<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ReportTrait;
use App\models\Feedback;
use App\models\Survey;
use DataTables;

class ResponseController extends Controller
{
    public function indexOld(Request $request, $surveyId)
    {
        $page_no = ($request->has('page_no'))?(int)$request->page_no:0;

        $feedbacks = Feedback::where('survey_id', $surveyId)->orderBy('id', 'desc');
        $paginatedCollection = $this->_pagination($feedbacks, $page_no);
        if ($request->ajax()) {
            return $paginatedCollection;
        }
    	return view('company.responses.index', ['response' => $paginatedCollection]);
    }

    public function index(Request $request, $surveyId)
    {
        if ($request->ajax()) {
            $feedbacks = Feedback::where('survey_id', $surveyId)->orderBy('id', 'desc')->get();
            return Datatables::of($feedbacks)
                    ->addColumn('id', function($feedback){
                        return makeResponseNumber($feedback->id);
                    })
                    ->addColumn('created_at', function($feedback){
                        return parse_by_format($feedback->created_at, "M d, Y g:i A");
                    })
                    ->addColumn('action', function($feedback){
                        $btn = '<a href="'.route('company.survey.feedback.detail', $feedback->id).'" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('company.responses.index');
    }

    public function surveyResponseByLocation(Request $request, $surveyId, $locationId)
    {
        $survey = Survey::with('feedback')->where('id', $surveyId)->first();
        $deviceId = 0;
        foreach ($survey->device as $key => $device) {
            if ($device->location_id == $locationId) {
                $deviceId = $device->id;
                break;
            }
        }

        if ($request->ajax()) {
            $feedbacks = Feedback::where('device_id', $deviceId)->where('survey_id', $surveyId)->orderBy('id', 'desc')->get();
            return Datatables::of($feedbacks)
                    ->addColumn('id', function($feedback){
                        return makeResponseNumber($feedback->id);
                    })
                    ->addColumn('created_at', function($feedback){
                        return parse_by_format($feedback->created_at, "M d, Y g:i A");
                    })
                    ->addColumn('action', function($feedback){
                        $btn = '<a href="'.route('company.survey.feedback.detail', $feedback->id).'" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('company.responses.by-location-index');
    }

    public function show($feedbackId)
    {
    	$feedback = Feedback::with('survey', 'survey.questions' , 'survey.questions.options','feedbackDetails', 'customer')->findOrFail($feedbackId);
        
    	return view('company.responses.show', ['feedback' => $feedback]);
    }
}
