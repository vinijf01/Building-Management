<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cards extends Component
{
    public $title;
    public $description;
    public $price;
    public $imageUrl;
    public $buttonText;
    public $buttonUrl;

    public function __construct($title, $description, $price, $imageUrl, $buttonText = 'See Details', $buttonUrl = '#')
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->buttonText = $buttonText;   // default: See Details
        $this->buttonUrl = $buttonUrl;     // default: #
    }

    public function render(): View|Closure|string
    {
        return view('components.cards');
    }
}
