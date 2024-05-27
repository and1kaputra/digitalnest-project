<?php

namespace App\View\Components;

use App\Models\Review;
use Illuminate\View\Component;
use Illuminate\View\View;
 
class Alert extends Component
{
    /**
     * Create the component instance.
     */
    public function __construct(
        public $review,
    ) {}
 
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.testimonials');
    }
}