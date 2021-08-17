<?php

namespace App\Http\Traits;
use App\models\Survey;
use App\models\Company;
use App\models\Question;
use App\models\Feedback;
use Illuminate\Support\Facades\Auth;

trait ExportSurveyReportTrait 
{
	public function _surveyDetailsQuestionBasedExport($surveyObj, $questions, $deviceId=null , $lastMonthFirstDate, $lastMonthLastDate)
	{
        $query = $surveyObj->feedback();
        if (!is_null($deviceId)) {
            $query = $query->deviceRelated($deviceId);
        }
        $feedbackIds = $query->pluck('id');

	    $output = array();
	    foreach ($questions as $key => $question) {
	       $questionOptionsArr = $question->options;
	       $qfbDetail          = $surveyObj->questionFeedbackDetail($question->id, $feedbackIds, $lastMonthFirstDate, $lastMonthLastDate);
	       $optionsArr         = $this->questionBasedbreakdownExport($questionOptionsArr, $qfbDetail);

	       $temp = array();
	       $temp['survey']           = $surveyObj;
	       $temp['overallResponses'] = responseCount($surveyObj->feedback->count());
	       $temp['question']         = $question;
	       $temp['questionOptions']  = $questionOptionsArr;
	       $temp['breakdown']        = $optionsArr;
	       $temp['pieChartData']     = $this->pieChartDataExport($optionsArr);

	       $output[$question['question']] = $temp;
	    }
	    return $output;
	}

    public function breakdownExport($feedbackDetails)
    {
    	$output = array();
    	if (isValid($feedbackDetails)) {
    		foreach ($feedbackDetails as $key => $feedbackDetail) {
    			$option = $feedbackDetail->questionOptions;
    			$temp = array();
    			if (array_key_exists($option->id, $output)) {
					$temp['label'] = $option->label;
					$temp['value'] = $option->value;
                    $temp['color'] = $option->colour;
					$temp['totalResponse'] = $output[$option->id]['totalResponse'] + 1;
    			}else{
    				$temp['label'] = $option->label;
					$temp['value'] = $option->value;
                    $temp['color'] = $option->colour;
					$temp['totalResponse'] = 1;
    			}

    			$output[$option->id] = $temp;
    		}
    	}
    	return $output;
    }

    public function questionBasedbreakdownExport($questionOptions, $feedbackDetailsDateVice)
    {
        $tempOutput = array();
        $output = array();
        if (isValid($questionOptions)) {
            foreach ($questionOptions as $key => $option) {
                $temp = array();
                $temp['label'] = $option->label;
                $temp['value'] = $option->value;
                $temp['color'] = $option->colour;
                $temp['totalResponse']     = 0;
                $tempOutput[$option->id]   = $temp;
            }

            foreach ($feedbackDetailsDateVice as $date => $fbDetails) {
            	$tmpOutputCpy = $tempOutput;
                foreach ($fbDetails as $key => $fbDetail) {
                    if (array_key_exists($fbDetail->question_option_id, $tmpOutputCpy)) {
                        $tmpOutputCpy[$fbDetail->question_option_id]['totalResponse'] += 1;
                    }else{
                    	unset($tmpOutputCpy[$fbDetail->question_option_id]);
                    }
                }
                $output[$date] = $tmpOutputCpy;
            }
        }
        return $output;
    }

    public function pieChartDataExport($optionsArrDateVice)
    {
    	$output = array();
    	foreach ($optionsArrDateVice as $date => $optionsArr) {
    		foreach ($optionsArr as $key => $option) {
    			$temp = array();
	    		$temp['option']        = $option['value'];
	            $temp['color']         = $option['color'];
	    		$temp['totalResponse'] = $option['totalResponse'];

	    		$output[] = $temp;
    		}
    	}
    	return $output;
    }
}