<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardHeaderTitle extends Component
{
    public $pageTitle;
    public $totalCount;

    public function __construct($pageTitle, $totalCount = null)
    {
        $this->pageTitle = $pageTitle;
        $this->totalCount = $totalCount;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-header-title');
    }
}
