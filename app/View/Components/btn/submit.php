<?php

namespace App\View\Components\btn;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class submit extends Component
{
    public $fontwasomeicon;
    public $text;
    /**
     * Create a new component instance.
     */
    public function __construct($icon, $text)
    {
        $this->fontwasomeicon = $icon;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.btn.submit');
    }
}
