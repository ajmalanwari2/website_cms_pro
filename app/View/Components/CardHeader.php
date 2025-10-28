<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardHeader extends Component
{
    public $scenario;
    public $pageTitle;
    public $permission;
    public $buttonLabel;
    public $buttonClass;
    public $resourcePath;
    public $totalCount;
    public $modal;
    public $newPageRoute;

    public function __construct($scenario, $pageTitle, $permission = null, $buttonLabel = null, $buttonClass = null, $resourcePath = null, $totalCount = null, $modal = null, $newPageRoute = null)
    {
        $this->scenario = $scenario;
        $this->pageTitle = $pageTitle;
        $this->permission = $permission;
        $this->buttonLabel = $buttonLabel;
        $this->buttonClass = $buttonClass;
        $this->resourcePath = $resourcePath;
        $this->totalCount = $totalCount;
        $this->modal = $modal;
        $this->newPageRoute = $newPageRoute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-header');
    }
}
