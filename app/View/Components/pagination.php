<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Pagination extends Component
{
    public $model;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($paginatedObj)
    {
        $this->model = json_decode($paginatedObj, true);
      //  dd($this->pagination_model);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.pagination');
    }
}
