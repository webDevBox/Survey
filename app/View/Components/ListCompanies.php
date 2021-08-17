<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListCompanies extends Component
{
    public $companies;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($companies)
    {
        $this->companies = json_decode($companies);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.list-companies');
    }
}
