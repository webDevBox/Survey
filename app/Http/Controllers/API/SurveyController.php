<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Device;
use App\Http\Traits\ReportTrait;
use Validator;
use Config;

class SurveyController extends Controller
{
    use ReportTrait;
    
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
        $device = auth()->user();
        $device = Device::with('company', 'location')->whereHas('company')->whereHas('location')->whereId($device->id)->first();       
        $data = $this->_latestSurveyByDevice($device);
        return response()->json([
            'status'  => $this->responseConstants['STATUS_SUCCESS'],
            'message' => "Latest Survey With Questions",
            'response_code' => $this->responseConstants['RESPONSE_CODE_SUCCESS'],
            'data'          => $data,
        ]);
    }
}
