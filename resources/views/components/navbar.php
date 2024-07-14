<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Review;
use Illuminate\View\Component;
use Illuminate\View\View;
 
class Alert extends Component
{
    /**
     * Create the component instance.
     */
 
    /**
     * Get the view / contents that represent the component.
     */
    public $categories;

    public function __construct($categories)
    {
        $this->categories = $categories;
    }
     public function render(): View
    {
        return view('components.navbar');
    }
}