<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Overall extends Component
{
    public $overallReports;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($overallReports)
    {
        $this->overallReports = json_decode($overallReports, true);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.overall');
    }
}
