<?php

namespace App\Http\Controllers\Company;
use App\models\Company;
use App\models\CompanySetting;
use App\models\Device;
use App\models\Feedback;
use App\models\Location;
use App\models\FeedbackDetail;
use App\models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Service\SurveyService;
use Validator;
use Auth;

class FeedbackController extends Controller
{
    public function index($deviceId)
    {
        $surveyService = new SurveyService();
        $deviceSurveys = $surveyService->GetSurvey($deviceId);
        if($deviceSurveys)
        {
             $device = Device::where('id', $deviceId)->first();
             $locationName = Location::where('id', $device->location_id)->pluck('name');
             if($device)
             {
               $companySetting = CompanySetting::where('company_id' ,$device->company_id)->with("company")->first();  
               return view('company.feedback.index', ['companySetting' => $companySetting, 'deviceSurveys' => $deviceSurveys,'locationName'=>$locationName[0]]);        
             }
          
        }
    }

    //Create feedback for single and emoji type
    public function create_feedBack(Request $request)
    {
          $feedbackId;
          $result = $request->input('data');
          $locationId = $result['location_id'];
          $device_id = $result['device_id'];
          $survey_id = $result['survey_id'];
          $question_id = $result['question_id'];
          $option_id = $result['option_id'];
         
         if($result['feedback_id']==null)
         {
            $feedbackId = Feedback::create([
                'device_id' => $result['device_id'],
                'survey_id' => $result['survey_id']
            ])->id;
         }
         else
         {
             $feedbackId = $result['feedback_id'];
         }

          $feedback_detail = FeedbackDetail::create([
                'feedback_id'        => $feedbackId,
                'question_id'        => $result['question_id'],
                'question_option_id' => $result['option_id']
            ]);

        return response()->json(['success'=>'Form is successfully submitted!',"feedback_detail"=>$feedback_detail]);
      
    }

    //Create Feedback for multiple type
    public function create_multiple_feedback(Request $request)
    {
          $feedbackId;
          $result = $request->input('data');
          $locationId = $result['location_id'];
          $device_id = $result['device_id'];
          $survey_id = $result['survey_id'];
          $question_id = $result['question_id'];
          $createdFeedback =null;
          $removedFeedback =null;

          //Create Feedback
         if($result['feedback_id']==null && (isset($result['createFeedback']) || isset($result['removeFeedback']) ))
          {
            $feedbackId = Feedback::create([
                'device_id' => $result['device_id'],
                'survey_id' => $result['survey_id']
            ])->id;
           }
         else
          {
             $feedbackId = $result['feedback_id'];
          }
          
          //Create new Feedback Detail
         if(isset($result['createFeedback']))
          {
                for($i = 0; $i< count($result['createFeedback']);$i++)
                 {
                    $feedback_detail = FeedbackDetail::create([
                        'feedback_id'        => $feedbackId,
                        'question_id'        => $result['question_id'],
                        'question_option_id' => $result['createFeedback'][$i]
                    ]);
                    $createdFeedback[$i]= $feedback_detail;
                 }            
           }

           //Removed Feedback Detail
         if(isset($result['removeFeedback']))
          {
                for($i = 0; $i< count($result['removeFeedback']);$i++)
                 {
                    $feedbackDetail = FeedbackDetail::find($result['removeFeedback'][$i]);
                    $removedFeedback[$i]= $feedbackDetail;
                    $feedbackDetail->delete();
                 }            
          }
            $feedback = [
                'createdFeedback' => $createdFeedback,
                'removedFeedback' => $removedFeedback,
            ];

        return response()->json(['success'=>'Form is successfully submitted!',"feedback"=>$feedback]);
    }

    //Update Feedback for Single and emoji type
    public function update_feedBack(Request $request)
    {
          $result = $request->input('data');
          $option_id = $result['option_id'];
          $feedBack_detail_id = $result['feedback_detail_id'];     
          $feedbackDetail = FeedbackDetail::find($feedBack_detail_id);
          $feedback_detail_data = [
                'question_option_id' => $result['option_id']
            ];
           $feedbackDetail->update($feedback_detail_data); 
           return response()->json(['success'=>'Form is successfully submitted!',"feedback_detail"=>$feedbackDetail]);   
    }

    //Create customer
    public function create_customer(Request $request)
    {
         $result = $request->input('formData');   
         $customer;
         $feedbackId =$result['feedback_id'];

          if($result['customer_id']==null)
          {
             if($result['feedback_id']==null)
             {
              $feedbackId = Feedback::create([
                'device_id' => $result['device_id'],
                'survey_id' => $result['survey_id']
            ])->id;
             }
            

              //Create customer if one of these info is given
              if($result['name'] !=null || $result['phone'] !=null || $result['email'] !=null )
              {
                $customer = Customer::create([
                    'name'  =>  $result['name'],      
                    'phone' => $result['phone'],
                    'email'=> $result['email'],
                    'feedback_id' => $feedbackId,
                 ])->first();
              }
              else
              {
                return response()->json(['success'=>'Form is successfully submitted!',"customer"=>false]);      
              }        
            }
          else
          {
            if($result['name'] !=null || $result['phone'] !=null || $result['email'] !=null )
            {
                $customerDetail = Customer::find($result['customer_id']);
                $customer_data = [
                    'name'  =>  $result['name'],      
                    'phone' => $result['phone'],
                    'email'=> $result['email'],
                    'feedback_id' => $feedbackId,
                 ];   
              $customer =  $customerDetail->update($customer_data);
              return response()->json(['success'=>'Form is successfully submitted!',"customer"=>$customer]);         
            }
            else
            {
                return response()->json(['success'=>'Form is successfully submitted!',"customer"=>false]);      
            }        
          }
        return response()->json(['success'=>'Form is successfully submitted!',"customer"=>$customer]);      
    }
}
