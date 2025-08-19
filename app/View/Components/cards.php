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
    public $bedrooms;
    public $price;
    public $imageUrl;
    public $buttonText;

    public function __construct($title, $description, $bedrooms, $price, $imageUrl, $buttonText = 'Book Now')
    {
        $this->title = $title;
        $this->description = $description;
        $this->bedrooms = $bedrooms;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->buttonText = $buttonText;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards');
    }
}
