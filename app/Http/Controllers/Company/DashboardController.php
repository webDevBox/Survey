<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\User;
use App\models\Category;
use App\models\Song;
use App\models\Admin;
use App\models\Tag;
use App\models\VideoTag;
use Hash;
use Auth;
use App\Http\Traits\ReportTrait;

class DashboardController extends Controller
{
	use ReportTrait;

    public function index(Request $request)
    {
    	$companyId  = session('companyIdM');
    	$dates      = dateRange($request);
	
    	$response = $this->_overallReport($companyId, $dates['from'], $dates['to']);
        return view('company.dashboard.dashboard', ['overallReports' => $response]);
    }
}
