<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class SurveyQuestionSheet implements FromView, WithTitle
{
	protected $survey;
	protected $questionResponse;

    public function __construct($response)
    {
        $this->survey   = $response['survey'];
        $this->questionResponse = $response;
    }

    public function view(): View
    {
        return view('company.exports.survey-report', [
            'data' => [
                'survey'           => $this->survey,
                'overallResponses' => $this->questionResponse['overallResponses'],
                'question'  => $this->questionResponse['question'],
                'breakdown' => $this->questionResponse['breakdown']
            ]
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->questionResponse['question']['question'];
    }
}