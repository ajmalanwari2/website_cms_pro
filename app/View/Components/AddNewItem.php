<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AddNewItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $permission;
    public $label;
    public $class;
    public $path;
    public $modal;
    public $newPageRoute;
    public function __construct($permission, $label, $class, $path = null, $modal = null, $newPageRoute = null)
    {
        $this->permission = $permission;
        $this->label = $label;
        $this->class = $class;
        $this->path = $path;
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
        return view('components.add-new-item');
    }
}
