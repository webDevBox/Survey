<?php

use Camroncade\Timezone\Facades\Timezone;
use Illuminate\Support\Facades\Storage;
use App\models\Company;

function responseCount($totalResponse){
	switch (true) {
		case ($totalResponse >= 1000 && $totalResponse < 1000000):
			$output = number_format($totalResponse / 1000, 1).'K';
			break;
		case ($totalResponse >= 1000000):
			$output = number_format($totalResponse / 1000000, 1).'M';
			break;
		default:
			$output = $totalResponse;
			break;
	}

	return $output;
}

function isValid($obj)
{
	if (isset($obj) && !empty($obj) && !is_null($obj) && $obj != '') {
		if (count($obj) > 0) {
			return true;
		}
	}
	return false;
}

function dateFormat($date)
{
   $date = date_create($date);
   return date_format($date,"d/m/Y h:i A");
}

function dateRange($request)
{
	$output = array();
	$output['from'] = '2017-01-01';
	if (!is_null($request->from)) {
	    $output['from'] = date_format(date_create($request->from),"Y-m-d");
	}
	$output['to'] = date_format(date_create($request->to),"Y-m-d");
	
	return $output;
}

function makeResponseNumber($number)
{
	return str_pad($number,7,"0", STR_PAD_LEFT );
}

function parse_by_format($date, $format='d/m/Y h:i A')
{
	$date = date_create($date);
	return date_format($date,$format);
}

function selectedOptions($options, $feedbackDetails)
{
	$output = array();
	foreach ($options as $key => $option) {
		$temp = array();
		$temp['id']          = $option->id;
		$temp['label']       = $option->label;
		$temp['value']       = $option->value;
		$temp['colour']      = $option->colour;
		$temp['selected']    = false;
		$output[$option->id] = $temp;
	}

	foreach ($feedbackDetails as $key => $fbDetail) {
		if (array_key_exists($fbDetail->question_option_id, $output)) {
			$output[$fbDetail->question_option_id]['selected'] = true;
		}
	}

	return $output;
}

function removeImage($previousImg){
	if (!stripos($previousImg, 'background.png')) {
        if(Storage::exists($previousImg)){
            Storage::delete($previousImg);
        }
    }
}

function getCompany()
{
	return Company::findOrFail(session('companyIdM'));
}

function getCompanyId()
{
	return session('companyIdM');
}

function saveCompanyIdIntoSession($companyId)
{
	\Session::put('companyIdM',$companyId);
    \Session::save();
}