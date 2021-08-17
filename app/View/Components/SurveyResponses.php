<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SurveyResponses extends Component
{
    public $responses;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($responses)
    {
        $this->responses = json_decode($responses);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.survey-responses');
    }
}
