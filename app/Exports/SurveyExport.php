<?php

namespace App\Exports;

use App\models\Survey;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Http\Traits\ReportTrait;

class SurveyExport implements WithMultipleSheets
{
	use Exportable;
	protected $survey;
	protected $questionResponse;

    public function __construct($survey, $questionResponse)
    {
        $this->survey  = $survey;
        $this->questionResponse  = $questionResponse;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        foreach($this->questionResponse as $response){
            $sheets[] = new SurveyQuestionSheet($response);
        }

        return $sheets;
    }
}
