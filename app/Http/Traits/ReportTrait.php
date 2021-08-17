<?php

namespace App\Http\Traits;
use App\models\Survey;
use App\models\Company;
use App\models\Question;
use App\models\Feedback;
use App\models\Device;
use Illuminate\Support\Facades\Auth;

trait ReportTrait {
    public function _latestSurveysWithDevicesDepricated($companyId)
    {
    	$surveys = Survey::with('device', 'latestFeedback')->has('latestFeedback')->whereCompanyId($companyId)->orderBy('id', 'desc')->get();
    	return $surveys;
    }

    public function surveyDetailsOld($surveyId)
    {
    	$survey = Survey::with('questions','feedbackDetail')->has('questions')->whereId($surveyId)->first();
    	$data = array();
        $data['survey']           = $survey;
        $data['overallResponses'] = responseCount($survey->feedback->count());
        $data['questions']     	  = $survey->questions;
        $optionsArr               = $this->breakdown($survey->feedbackDetail);
        $data['breakdown']        = $optionsArr;
        $data['pieChartData']	  = $this->pieChartData($optionsArr);
        return $data;
    }

    public function _surveyDetails($surveyObj, $questionObj, $fromDate=null, $toDate=null)
    {
    	$questionOptionsArr = $questionObj->options;
    	$feedbackIds        = $surveyObj->feedbackByDates($fromDate, $toDate);
        $qfbDetail          = $surveyObj->questionFeedbackDetail($questionObj->id, $feedbackIds);
        $response           = $this->questionBasedbreakdown($questionOptionsArr, $qfbDetail);
    	$optionsArr         = $response['breakdown'];

    	$data = array();
        $data['survey']           = $surveyObj;
        $data['overallResponses'] = responseCount($surveyObj->feedback->count());
        $data['latestOResponses'] = $this->latestQuestionOptions($qfbDetail);
        $data['questionCount']    = $response['questionCount'];;
        $data['questions']     	  = $surveyObj->questions;
        $data['questionOptions']  = $questionOptionsArr;
        $data['breakdown']        = $optionsArr;
        $data['pieChartData']	  = $this->pieChartData($optionsArr);

        return $data;
    }

    public function _surveyDetailsByLocation($surveyObj, $questionObj, $locationId, $fromDate, $toDate)
    {
        $questionOptionsArr = $questionObj->options;
        $deviceObj = Device::whereLocationId($locationId)->first();
        $feedbackIds        = $surveyObj->feedbackByDeviceWithDates($deviceObj->id, $fromDate, $toDate);
        $qfbDetail          = $surveyObj->questionFeedbackDetail($questionObj->id, $feedbackIds);
        $response           = $this->questionBasedbreakdown($questionOptionsArr, $qfbDetail);
        $optionsArr         = $response['breakdown'];
        $data = array();
        $data['survey']           = $surveyObj;
        $data['overallResponses'] = responseCount(count($feedbackIds));
        $data['latestOResponses'] = $this->latestQuestionOptions($qfbDetail);
        $data['questionCount']    = $response['questionCount'];;
        $data['questions']        = $surveyObj->questions;
        $data['questionOptions']  = $questionOptionsArr;
        $data['breakdown']        = $optionsArr;
        $data['pieChartData']     = $this->pieChartData($optionsArr);

        return $data;
    }

    public function _overallReportOld($companyId, $from, $to)
    {
        $surveys = Survey::with('questions', 'device', 'feedbackDetail', 'feedback')->whereHas('feedback', function($query) use($from, $to){
            return $query->whereDate('feedback.created_at', '>=', $from)->whereDate('feedback.created_at', '<=', $to);
        })->whereCompanyId($companyId)->orderBy('id', 'desc')->get();

        $data = array();
        foreach ($surveys as $key => $survey) {
            $temp = array();
            $temp['id']   = $survey->id;
            $temp['name'] = $survey->name;
            $temp['questions']        = $survey->questions;
            $temp['totalDevices']     = $survey->device->count();
            $temp['overallResponses'] = responseCount($survey->feedback->count());
            $temp['latestOResponses'] = $this->latestOptions($survey->feedbackDetail);
            $temp['breakdown']        = [];
            if (isValid($temp['questions'])) {
                $questionOptions   = $survey->questions[0]->options;
                $temp['breakdown'] = $this->breakdown($questionOptions, $survey->questionFeedbackDetail($temp['questions'][0]->id));
            }

            $data[] = $temp;
        }

        return $data;
    }

    public function _overallReport($companyId, $from, $to)
    {
        $surveys = Survey::with('questions', 'device', 'feedbackDetail', 'feedback')->whereHas('feedback', function($query) use($from, $to){
            return $query->whereDate('feedback.created_at', '>=', $from)->whereDate('feedback.created_at', '<=', $to);
        })->whereCompanyId($companyId)->orderBy('id', 'desc')->get();

        $data = array();
        foreach ($surveys as $key => $survey) {
            $temp = array();
            $temp['id']   = $survey->id;
            $temp['name'] = $survey->name;
            $temp['questions']        = $survey->questions;
            $temp['totalDevices']     = $survey->device->count();
            $temp['overallResponses'] = responseCount($survey->feedback->count());
            // $temp['latestOResponses'] = $this->latestOptions($survey->feedbackDetail);
            $temp['latestOResponses'] = array();
            $temp['breakdown']        = array();
            $temp['questionCount']    = 0;
            if (isValid($temp['questions'])) {
                $feedbackIds              = $survey->feedback()->pluck('id');
                $questionOptions          = $survey->questions[0]->options;
                $questionFeedbackDetails  = $survey->questionFeedbackDetail($temp['questions'][0]->id, $feedbackIds);
                $temp['latestOResponses'] = $this->latestOptions($questionFeedbackDetails);

                $response                 = $this->breakdown($questionOptions, $questionFeedbackDetails);
                $temp['breakdown']        = $response['breakdown'];
                $temp['questionCount']    = $response['questionCount'];
            }

            $data[] = $temp;
        }

        return $data;
    }

    public function _overallSurveyReport($surveyId, $from, $to)
    {
        // dd('survey id '.$surveyId.' from '.$from.' to '.$to);
        $survey = Survey::with('questions', 'feedbackDetail', 'feedback')->whereHas('feedback', function($query) use($from, $to){
            return $query->whereDate('feedback.created_at', '>=', $from)->whereDate('feedback.created_at', '<=', $to);
        })->whereId($surveyId)->orderBy('id', 'desc')->first();

        $output = array();
        $output['survey']    = $survey;
        $output['questions'] = array();
        $questionTemp = array();
        foreach ($survey->questions as $key => $question) {
            $temp = array();
            $temp['id']       = $question->id;
            $temp['question'] = $question->question;
            $temp['type']     = $question->type;
            $temp['options']  = array();
            $questionTemp[$question->id] = $temp;
            foreach ($question->options as $key => $option) {
                $optTemp = array();
                $optTemp['id']     = $option->id;
                $optTemp['label']  = $option->label;
                $optTemp['value']  = $option->value;
                $optTemp['colour'] = $option->colour;
                $optTemp['totalResponse'] = 0;

                $questionTemp[$question->id]['options'][$option->id] = $optTemp;
            }
        }

        foreach ($survey->feedbackDetail as $key => $feedbackDetail) {
            if (array_key_exists($feedbackDetail->question_id, $questionTemp)) {
                $questionTemp[$feedbackDetail->question_id]['options'][$feedbackDetail->question_option_id]['totalResponse'] += 1;
            }
        }
        $output['questions'] = $questionTemp;

        return $output;
    }

    public function questionBased($surveyId, $questionId)
    {
    	// $question = Question::with('survey')->whereId($questionId)->whereSurveyId($surveyId)->first();
    	// $survey = $question->survey;
    	// $questionOptions = $survey->questionOptions()->whereQuestionId($questionId)->get();
    	// dd($questionOptions);

    	$survey = Survey::whereHas('questions', function($query) use ($questionId){
    			$query->where('id', '=', $questionId);
    	})->whereId($surveyId)->first();
    	dd($survey->questions);
    }

    public function pieChartData($optionsArr)
    {
    	$output = array();
    	foreach ($optionsArr as $key => $option) {
    		$temp = array();
    		$temp['option']        = $option['value'];
            $temp['color']         = $option['color'];
    		$temp['totalResponse'] = $option['totalResponse'];

    		$output[] = $temp;
    	}
    	return $output;
    }

    public function latestOptions($feedbackDetails)
    {
        $latestOptionsCount = config('constants.COMPANY.DASHBOARD')['LATEST_RESPONSE'];
    	$output = array();
    	if (isValid($feedbackDetails)) {
    		foreach ($feedbackDetails as $key => $feedbackDetail) {
                if (count($output) < $latestOptionsCount) {
                    $option = $feedbackDetail->questionOptions;
                    $temp   = array();
                    $temp['label'] = $option->label;
                    $temp['value'] = $option->value;
                    $temp['color'] = $option->colour;
                    $temp['type']  = $option->question->type;
                    $output[]      = $temp;
                }else{
                    break;
                }
	    	}
    	}
    	return $output;
    }

    public function latestQuestionOptions($feedbackDetails)
    {
        $latestOptionsCount = config('constants.COMPANY.DASHBOARD')['LATEST_RESPONSE'];
        $output = array();
        if (isValid($feedbackDetails)) {
            foreach ($feedbackDetails as $key => $fbDetail) {
                if (count($output) < $latestOptionsCount) {
                    $option = $fbDetail->questionOptions;
                    $temp   = array();
                    $temp['label'] = $option->label;
                    $temp['value'] = $option->value;
                    $temp['color'] = $option->colour;
                    $temp['type']  = $option->question->type;
                    $output[]      = $temp;
                }else{
                    break;
                }
            }
        }

        return $output;
    }

    public function options($optionsArr)
    {
    	$output = array();
    	foreach ($optionsArr as $key => $option) {
    		$output[$option->id] = $option->value;
    	}

    	return $output;
    }

    public function breakdown($questionOptions, $feedbackDetails)
    {
    	$output = array();
        $tempFeedbacks = array();
        if (isValid($questionOptions)) {
            foreach ($questionOptions as $key => $option) {
                $temp = array();
                $temp['label'] = $option->label;
                $temp['value'] = $option->value;
                $temp['color'] = $option->colour;
                $temp['type']  = $option->question->type;
                $temp['totalResponse'] = 0;
                $output[$option->id]   = $temp;
            }

            foreach ($feedbackDetails as $key => $fbDetail) {
                $date = date_format($fbDetail->created_at, 'Y-m-d');
                $tempFeedbacks[$date][] = $fbDetail->feedback_id;

                if (array_key_exists($fbDetail->question_option_id, $output)) {
                    $output[$fbDetail->question_option_id]['totalResponse'] += 1;
                }
            }
        }
        $data['breakdown']     = $output;
        $data['questionCount'] = 0;
        foreach ($tempFeedbacks as $date => $feedbackIds) {
            $data['questionCount'] += count(array_unique($feedbackIds));
        }
        // $data['questionCount'] = count(array_unique($tempFeedbacks));
        return $data;
    }

    public function questionBasedbreakdownOld($questionOptions, $feedbackDetails)
    {
    	$output = array();
    	if (isValid($questionOptions)) {
    		foreach ($questionOptions as $key => $option) {
    			$temp = array();
				$temp['label'] = $option->label;
				$temp['value'] = $option->value;
                $temp['color'] = $option->colour;
				$temp['totalResponse'] = 0;
				$output[$option->id]   = $temp;
    		}

    		foreach ($feedbackDetails as $key => $fbDetail) {
				if (array_key_exists($fbDetail->question_option_id, $output)) {
					$output[$fbDetail->question_option_id]['totalResponse'] += 1;
				}
			}
    	}
    	return $output;
    }

    public function questionBasedbreakdown($questionOptions, $feedbackDetails)
    {
        $output = array();
        $tempFeedbacks = array();
        if (isValid($questionOptions)) {
            foreach ($questionOptions as $key => $option) {
                $temp = array();
                $temp['label'] = $option->label;
                $temp['value'] = $option->value;
                $temp['color'] = $option->colour;
                $temp['type']  = $option->question->type;
                $temp['totalResponse'] = 0;
                $output[$option->id]   = $temp;
            }

            foreach ($feedbackDetails as $key => $fbDetail) {
                $date = date_format($fbDetail->created_at, 'Y-m-d');
                $tempFeedbacks[$date][] = $fbDetail->feedback_id;
                if (array_key_exists($fbDetail->question_option_id, $output)) {
                    $output[$fbDetail->question_option_id]['totalResponse'] += 1;
                }
            }

            $data['breakdown']     = $output;
            /* Total Question Hit Count */
                $data['questionCount'] = 0;
                foreach ($tempFeedbacks as $date => $feedbackIds) {
                    $data['questionCount'] += count(array_unique($feedbackIds));
                }
            /* End Question Count */

            /*Latest Options question vice*/

        }
        return $data;
    }

    // public function questionBasedbreakdown($questionOptions, $fbDetails)
    // {
    //     // dd($fbDetails);
    //     $output = array();
    //     $tempFeedbacks = array();
    //     if (isValid($questionOptions)) {
    //         foreach ($questionOptions as $key => $option) {
    //             $temp = array();
    //             $temp['label'] = $option->label;
    //             $temp['value'] = $option->value;
    //             $temp['color'] = $option->colour;
    //             $temp['type']  = $option->question->type;
    //             $temp['totalResponse'] = 0;
    //             $output[$option->id]   = $temp;
    //         }

    //         // foreach ($feedbackDetailsDateVice as $date => $fbDetails) {
    //             foreach ($fbDetails as $key => $fbDetail) {
    //                 $date = date_format($fbDetail->created_at, 'Y-m-d');
    //                 $tempFeedbacks[$date][] = $fbDetail->feedback_id;
    //                 // $tempFeedbacks[] = $fbDetail->feedback_id;
    //                 if (array_key_exists($fbDetail->question_option_id, $output)) {
    //                     $output[$fbDetail->question_option_id]['totalResponse'] += 1;
    //                 }
    //             }
    //         // }

    //         $data['breakdown']     = $output;
    //         /* Total Question Hit Count */
    //             $data['questionCount'] = 0;
    //             foreach ($tempFeedbacks as $date => $feedbackIds) {
    //                 $data['questionCount'] += count(array_unique($feedbackIds));
    //             }
    //         /* End Question Count */

    //         /*Latest Options question vice*/

    //     }
    //     return $data;
    // }

    public function _deployedServeys($deviceSurveys)
    {
        $surveyIds = array();
        foreach ($deviceSurveys as $key => $device) {
            $surveyIds[] = optional($device->survey)->id;
        }
        $surveyIds = array_unique($surveyIds);

        $surveys = Survey::with('latestFeedback')->has('latestFeedback')->whereIn('id', $surveyIds)->orderBy('id', 'desc')->get();

        return $surveys;
    }

    public function _companiesWithSurveys($from, $to)
    {
        $companies = Company::with('locations', 'devices', 'surveys', 'feedbacks')->whereHas('feedbacks', function($query) use ($from, $to){
            return $query->whereDate('feedback.created_at', '>=', $from)->whereDate('feedback.created_at', '<=', $to);
        })->orderBy('id', 'desc')->paginate(10);
        
        return $companies;
    }
    
    //This Code is working for ajax calls of companies with load more functionality
    // public function _companiesWithSurveysAjax($from, $to, $id)
    // {
    //     $companies = Company::with('locations', 'devices', 'surveys', 'feedbacks')->where('id', '<', $id)->whereHas('feedbacks', function($query) use ($from, $to){
    //         return $query->whereDate('feedback.created_at', '>=', $from)->whereDate('feedback.created_at', '<=', $to);
    //     })->orderBy('id', 'desc')->limit(1)->get();
        
    //     return $companies;
    // }
    // public function _companiesWithSurveysAjaxNew($from, $to)
    // {
    //     $companies = Company::with('locations', 'devices', 'surveys', 'feedbacks')->whereHas('feedbacks', function($query) use ($from, $to){
    //         return $query->whereDate('feedback.created_at', '>=', $from)->whereDate('feedback.created_at', '<=', $to);
    //     })->orderBy('id', 'desc')->limit(1)->get();
        
    //     return $companies;
    // }

    /*Remove this method once survey feedbacks integrated*/
    public function companyFeedbacks($companyId)
    {
        $surveyIds = Survey::with('feedback')->whereCompanyId($companyId)->pluck('id');
        $feedbacks = array();
        if (isValid($surveyIds)) {
            $feedbacks = Feedback::whereIn('survey_id', $surveyIds)->orderBy('id', 'desc')->get();
        }
        return $feedbacks;
    }

    public function _latestSurveyByDevice($deviceObj)
    {
        $output = array();
        $survey = $deviceObj->survey()->orderBy('id', 'desc')->first();
        if ($survey->count()) {
            $tempSur         = array();
            $tempSur['id']   = $survey->id;
            $tempSur['name'] = $survey->name;
            $tempSur['status']        = (bool)$survey->status;
            $tempSur['language']      = $survey->language;
            $tempSur['company_id']    = $survey->company->id;
            $tempSur['company']       = $survey->company;
            // $tempSur['company_logo']  = asset('storage/app/'.$survey->company->logo);
            // $tempSur['company_status'] = $survey->company->active();
            $tempSur['location_id']   = $deviceObj->location->id;
            $tempSur['location']      = $deviceObj->location;

            if (!is_null($survey->questions)) {
                foreach ($survey->questions as $key => $question) {
                    $tempQst = array();
                    $tempQst['id']       = $question->id;
                    $tempQst['question'] = $question->question;
                    $tempQst['type']     = $question->type;
                    
                    $questionOptions = $question->options;
                    $tempOpt = array(); 
                    foreach ($questionOptions as $key => $option) {
                        $temp = array();
                        $temp['id']     = $option->id;
                        $temp['label']  = $option->label;
                        $temp['value']  = $option->value;
                        $temp['colour'] = $option->colour;

                        $tempOpt[] = $temp;
                    }
                    $tempQst['options'] = $tempOpt;

                    $tempSur['questions'][] = $tempQst;
                }

                $output = $tempSur;
            }
        }
        return $output;
    }

    public function _surveyFeedbacks($surveyId, $pageNo)
    {
        $feedbacks = Feedback::where('survey_id', $surveyId)->orderBy('id', 'desc')->get();
        return $feedbacks;
    }
}