<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Config;
use App\models\Feedback;
use App\models\FeedbackDetail;
use App\models\Customer;

class FeedbackController extends Controller
{
    private $responseConstants;

    public function __construct()
    {
        $this->responseConstants = Config::get('constants.RESPONSE_CONSTANTS');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location_id'           => 'required|numeric|exists:locations,id',
            'responses.*.survey_id' => 'required|numeric|exists:surveys,id',
            // 'responses.*.questions' => 'required|array',
            // 'responses.*.questions.*.question_id' => 'required|numeric|exists:questions,id',
            // 'responses.*.questions.options'     => 'required|array',
            // 'responses.*.questions.options.*'   => 'required|numeric|exists:question_options,id',
            'responses.*.customer'       => 'nullable|array',
            'responses.*.customer.name'  => 'nullable|string', 
            'responses.*.customer.email' => 'nullable|string', 
            'responses.*.customer.phone' => 'nullable|string', 
        ]);

        $message = $validator->errors()->first();

        if ($validator->fails()) {
            return response()->json([
                'status'        => $this->responseConstants['STATUS_ERROR'],
                'message'       => $message,
                'response_code' => $this->responseConstants['INVALID_PARAMETERS_CODE'],
            ]);
        }

        \Log::debug('Post Feedback Data '. json_encode($request->all()));

        $locationId = $request->location_id;
        $device = auth()->user();

        if (!$device->company->active()) {
            return response()->json([
                'status'        => $this->responseConstants['STATUS_ERROR'],
                'message'       => $this->responseConstants['MSG_DISABLE_COMPANY'].' You can\'t add feedback',
                'response_code' => $this->responseConstants['DISABLE_COMPANY_CODE'],
            ]);
        }

        $responsesCollection = collect($request->responses);
        $responsesCollection->map(function($response) use ($device, $locationId){
            $feedbackId = Feedback::create([
                            'device_id' => $device->id,
                            'survey_id' => $response['survey_id']
                        ])->id;
            
            $questionsCollection = collect($response['questions']);
            $questionsCollection->map(function($question) use ($feedbackId){
                $questionId = $question['question_id'];
                $optionsCollection = collect($question['options']);
                $optionsCollection->map(function($optionId) use ($feedbackId, $questionId){
                    FeedbackDetail::create([
                        'feedback_id'        => $feedbackId,
                        'question_id'        => $questionId,
                        'question_option_id' => $optionId
                    ]);
                });
            });

            $customer = $response['customer'];
            if (isValid($customer)) {
                if (isset($customer['name']) || isset($customer['email']) || isset($customer['phone']) ) {
                    Customer::create([
                        'name'        => $customer['name'],
                        'email'       => $customer['email'],
                        'phone'       => $customer['phone'],
                        'feedback_id' => $feedbackId
                    ]);
                } 
            }
        });

        return response()->json([
            'status'        => $this->responseConstants['STATUS_SUCCESS'],
            'message'       => $this->responseConstants['MSG_DATA_SAVE'],
            'response_code' => $this->responseConstants['RESPONSE_CODE_SUCCESS'],
        ]);
    }
}
