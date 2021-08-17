<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use JWTFactory;
use JWTAuth;
use App\models\Device;
use Illuminate\Support\Facades\Auth;
use Config;
use Str;
use Hash;
use App\Mail\ForgetPassword;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class AuthController extends Controller
{
    private $responseConstants;

    public function __construct()
    {
        $this->middleware('auth:api',  ['except' => ['login']]);
        $this->responseConstants = Config::get('constants.RESPONSE_CONSTANTS');
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'pin' => 'required|numeric',
        ]);

        $message = $validator->errors()->first();

        if ($validator->fails()) {
            return response()->json([
                'status'        => $this->responseConstants['STATUS_ERROR'],
                'message'       => $message,
                'response_code' => $this->responseConstants['INVALID_PARAMETERS_CODE'],
            ]);
        }

        $device = Device::with('location', 'location.company', 'location.company.setting')->wherePin($request->pin)->first();
        if ($device) {
            try {
                if (! $token = JWTAuth::fromUser($device)) {
                    return response()->json([
                        'status'  => $this->responseConstants['STATUS_ERROR'],
                        'message' => $this->responseConstants['ERROR_INVALID_CREDENTIALS'],
                        'response_code' => 401,
                    ]);
                }
            } catch (JWTException $e) {
                return response()->json([
                    'status'  => $this->responseConstants['STATUS_ERROR'],
                    'message' => 'could_not_create_token',
                    'response_code' => 500,
                ]);
            }

            return response()->json([
                'status'        => $this->responseConstants['STATUS_SUCCESS'],
                'message'       => $this->responseConstants['MSG_LOGGED_IN'],
                'response_code' => $this->responseConstants['RESPONSE_CODE_SUCCESS'],
                'token'         => $token,
                'data'          => $device,
            ]);
        }

        return response()->json([
            'status'  => $this->responseConstants['STATUS_ERROR'],
            'message' => $this->responseConstants['ERROR_INVALID_CREDENTIALS'],
            'response_code' => 401,
        ]);
    }

    public function extractData($deviceObj)
    {
        $temp = array();
        $temp['id']   = $deviceObj->id;
        $temp['device_name'] = $deviceObj->name;
        $temp['pin']  = $deviceObj->pin;
        $temp['location_id'] = $deviceObj->location_id;
        $temp['company_id']  = $deviceObj->company_id;

        $location = $deviceObj->location;
        $tempLocation = array();
        $tempLocation['id']   = $location->id;
        $tempLocation['location_name'] = $location->name;
        $tempLocation['description']   = $location->Description;
        $tempLocation['company_id']    = $location->company_id;
        $tempLocation['status']        = $location->status;

        $company = $deviceObj->location->company;
        $tempCompany = array();
        $tempCompany['id']            = $company->id;
        $tempCompany['company_name']  = $company->name;
        $tempCompany['email'] = $company->email;
        $tempCompany['contact_person_name']  = $company->contact_person_name;
        $tempCompany['contact_person_phone'] = $company->contact_person_phone;
        $tempCompany['logo'] = asset('storage/app/'.$company->logo);
        $tempCompany['plan'] = $company->plan;
        $tempCompany['email_verified_at'] = $company->email_verified_at;
        $tempCompany['status'] = $company->active();

        $setting = $deviceObj->location->company->setting;
        $tempSetting = array();
        if (!is_null($setting)) {
            $tempSetting['id'] = $setting->id;
            $tempSetting['company_id'] = $setting->company_id;
            $tempSetting['bg_color']   = $setting->bg_color;
            $tempSetting['bg_image']   = asset('storage/app/'.$setting->bg_image);
            $tempSetting['btn_submit_color'] = $setting->btn_submit_color;
            $tempSetting['btn_cancel_color'] = $setting->btn_cancel_color;
        }        

        $temp['location'] = $tempLocation;
        $temp['location']['company'] = $tempCompany;
        $temp['location']['company']['setting'] = $tempSetting;
        return $temp;
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status'        => $this->responseConstants['STATUS_SUCCESS'],
            'message'       => $this->responseConstants['MSG_LOGGED_OUT'],
            'response_code' => $this->responseConstants['RESPONSE_CODE_SUCCESS'],
        ]);
    }
}
