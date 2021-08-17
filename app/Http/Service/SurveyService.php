<?php

namespace App\Http\Service;

use App\models\Device;


 class SurveyService 
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function GetSurvey($deviceId)
    {
        return  Device::with('latestSurvey', 'latestSurvey.questions', 'latestSurvey.questions.options', 'latestSurvey.questions.options')->whereId($deviceId)->first();        
    //  return  Device::with('survey', 'survey.questions', 'survey.questions.options', 'survey.questions.options')->whereId($deviceId)->first();        
    }
}
