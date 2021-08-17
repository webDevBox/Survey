<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListSurvey extends Component
{
    public $responseObj;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($response)
    {
        $this->responseObj = json_decode($response);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.list-survey');
    }
}
