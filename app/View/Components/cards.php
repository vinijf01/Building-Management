<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cards extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $description;
    public $price;
    public $imageUrl;
    public $buttonText;
     public $buttonUrl;

    public function __construct($title, $description,  $price, $imageUrl, $buttonText = 'Book Now', $buttonUrl)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->buttonText = $buttonText;
        $this->buttonUrl = $buttonUrl;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards');
    }
}
