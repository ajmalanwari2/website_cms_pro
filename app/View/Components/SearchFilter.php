<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchFilter extends Component
{
    public $rows;
    public $inputsPerRow;
    public $colMdClasses;
    public $inputConfig; // Configuration for input types
    public $placeholders; // Dynamic placeholders
    public $names; // Dynamic names
    public $ids; // Dynamic ids
    public $formAction; // Form action URL
    public $reportType;
    public $lang; // Optional language parameter
    public $customClass;
    public $localize;

    public function __construct($rows, $inputsPerRow, $colMdClasses, $inputConfig, $placeholders, $names, $ids, $formAction, $reportType = null, $lang = null, $customClass = null, $localize = null)
    {
        $this->rows = $rows;
        $this->inputsPerRow = $inputsPerRow;
        $this->colMdClasses = $colMdClasses; // Expecting an array
        $this->inputConfig = $inputConfig; // Expecting an array of input configurations
        $this->placeholders = $placeholders; // Expecting an array of placeholders
        $this->names = $names; // Expecting an array of placeholders
        $this->ids = $ids; // Expecting an array of placeholders
        $this->formAction = $formAction; // Form action URL
        $this->reportType = $reportType;
        $this->lang = $lang; // Optional language parameter
        $this->customClass = $customClass;
        $this->localize = $localize;
    }

    public function render()
    {
        return view('components.search-filter');
    }
}
