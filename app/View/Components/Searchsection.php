<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Searchsection extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $placeholder;
    public $button;
    public $action;
    
    public function __construct($title = null, $placeholder = null, $button = null, $action = null)
    {
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->button = $button;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-section');
    }
}
