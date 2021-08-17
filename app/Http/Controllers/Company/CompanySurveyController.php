<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\models\TemplateOption;
use App\models\Survey;
use App\models\Template;
use App\models\TemplateCategory;
use App\models\CompanySetting;
use App\models\Question;
use App\models\QuestionOption;
use App\models\DeviceSurvey;
use App\models\Device;
use Camroncade\Timezone\Facades\Timezone;
use Validator;
use Auth;
use Hash;

class CompanySurveyController extends Controller
{
    public function companyId()
    {
      return  getCompanyId();
    }

    public function index()
    {
        // $companySetting = CompanySetting::where('company_id' ,$this->companyId())->first();  
        // $timezone = "America/Mexico_City";
        // $format = "Y-m-d H:i:s";
        //  $timezoneMessage =  Timezone::convertFromUTC($timestamp, $timezone, $format);
        // dd($timezoneMessage);
        $surveys = Survey::where('company_id',$this->companyId())->orderBy('id', 'DESC')->with('questions','questions.options','devices','devices.location')->paginate(10);
        foreach($surveys as $survey)
        {   
            if($survey->devices->isEmpty())
            {
                $survey['isDeployed'] = "NO";
            }
            else
            {
                $survey['isDeployed'] = "YES";
            }
        } 
        return view('company.survey.index', ['surveys' => $surveys]);
    }

    public function add()
    {
        $templates = TemplateCategory::whereHas('template')->get();
        $devices = Device::with('location')->where('company_id',$this->companyId())->orderBy('id', 'DESC')->get();    
        return view('company.survey.addsurvey', ['templates' => $templates, 'devices' => $devices]);
    }

    public function store(Request $request)
    {
        $company_id = $this->companyId();
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z 0-9]+$/u',
            'language' => 'required' 
        ]);

        $errors = $validator->errors()->first();
        if ($validator->fails()) {
            return response()->json([
                'errors'       => $errors,
            ]);
        }

         if($request->survey_id!=null)
         {
        //Get if Survey already exists
         $count = Survey::where('name',$request->name)->where('company_id',$company_id)->first();
                    
         if($count!=null && ($count->id!=$request->survey_id))
         {
             $errors = "Survey Name Should be Unique";
                 return response()->json([
                     'errors'       => $errors,
                 ]);
         }

            $survey = Survey::find($request->survey_id);
            $surveyData = [
                'name' => $request->name,
                'language' => $request->language,
                'company_id' => $company_id
            ];
            $survey->update($surveyData);
            $result =  $survey;
         }
         else
         {

         //Get if Survey already exists
         $count = Survey::where('name',$request->name)->where('company_id',$company_id)->count();
                        
         if($count>0)
         {
             $errors = "Survey Name Should be Unique";
                 return response()->json([
                     'errors'       => $errors,
                 ]);
         }
                $data = [

                    'name' => $request->name,
                    'language' => $request->language,
                    'company_id' => $company_id
                ];          
                    $result = Survey::create($data);
         }
            return response()->json(['success'=>'Form is successfully submitted!','result'=>$result]);
        }

        public function edit($id)
        {     
            $survey = Survey::find($id);
            return view('company.survey.edit', ['survey' => $survey]);
        }

    public function update(Request $request)
    {
        $company = $this->companyId();
        $this->validate($request, [
            'name' => 'required|unique:surveys,name,'.$request->id.' NULL,id,company_id,'.$company,
        ]);

        $survey = Survey::find($request->id);

        $surveyData = [
            'name' => $request->name,
        ];
        $survey->update($surveyData);

        switch($request->submitButton) 
        {
            case 'submitSurvey':  
                Session::put('success', 'Survey Updated Successfully');
                return redirect('company/survey/list');                       
                break;

            case 'editQuestions': 
                return redirect()->route('getAllQuestions', $request->id); 
                break;              
            }
            die('....');
            Session::put('success', 'Survey Updated Successfully');
            return redirect('company/survey/list');
    }


    public function storequestion_with_options(Request $request)
    {
        $result = json_decode($request->input('formData'), true);
         if($result[0]['value']==null)
         {                                 
            $errors = "question Field is required";
                return response()->json([
                    'errors'       => $errors,
                ]);
            
         }

          //Get if Survey already exists
          $count = Question::where('question',$result[0]['value'])->where('survey_id',(int)$result[1]['value'])->count();
                    
          if($count>0)
          {
              $errors = "Question Should be Unique";
                  return response()->json([
                      'errors'   => $errors,
                  ]);
          }

        $data=[
            'question'=>$result[0]['value'],       
            'survey_id' => (int)$result[1]['value'],
            'type' => $result[2]['value']
        ];
        $mydata = Question::create($data);
        $mydata->save();
    
        for($i = 1; $i< count($result);$i++)
        {
           if($result[$i]['name']=='label')
           {
            $template_option = explode("_", $result[$i+1]['value']);
            $count = count($template_option);
            $option_id =   $template_option[0];
            if($count==2)
            {
                $colour =   $template_option[1];
            }
            else
            {
                $colour = "#000000"; 
            }
               $value = TemplateOption::find($option_id);
            $optionData=[
                'question_id' =>$mydata->id,
                'label'=>$result[$i]['value'],                
                'value' => $value->name,  
                'colour' => $colour
            ];
            $saveOPtionData = QuestionOption::create($optionData);
            $saveOPtionData->save();
           }                
        }
            return response()->json(['success'=>'Form is successfully submitted!','result'=>$result]);
    }

    public function getCategoriesWithTemplates()
    {
        $templates = TemplateCategory::with('template')->get();
    }

    public function getTemplateOptions(Request $request)
    {     
        $template = Template::with('template_category')->where('id',$request->id)->first();  
        $templateOptions = TemplateOption::where('template_id',$request->id)->get();
        return response()->json(['templateOptions' => $templateOptions,'selection_type'=>$template->template_category->selection_type]);
    }

    public function DeploySurveyOnDevice(Request $request)
    {       
      $result = json_decode($request->input('formData'), true);
      $lastEntry  =  last($result);
      $survey_id = $lastEntry['value'];
  
      for($i = 0; $i< count($result);$i++)
      {
        if($result[$i]['name']=='device_id' && $result[$i+1]['name']=='isActivesurvey')
        {
           
             $surveysByDevice = DeviceSurvey::where('device_id',$result[$i]['value'])->where('isDeployed',1)->get();
             for ($j=0; $j < sizeof($surveysByDevice); $j++) {             
                $surveysByDeviceData = [
                    'isDeployed' =>0,
                ];          
                $surveysByDevice[$j]->update($surveysByDeviceData);
            }

            $deviceSurveyData=[
                'survey_id' =>$survey_id,
                'device_id' =>  $result[$i]['value'],
                'isDeployed' => 1
            ];
            $deviceSurvey = DeviceSurvey::create($deviceSurveyData);
        }                
      }

      return response()->json(['success'=>'Form is successfully submitted!',"result"=>$survey_id]);
          
    }   
        
    public function remove($id)
    {
      $survey = Survey::findOrFail($id);
      $survey->delete();
      return redirect('company/survey/list')->with('success', 'Survey Removed Successfully');      
    }

    public function activeInactive(Request $request, $id)
    {
      $survey = Survey::find($id);
      $survey->status = !$survey->status;
      $survey->save();
      return response()->json(['status' => true]);
    }
  }
