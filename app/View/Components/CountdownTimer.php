<?php

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CountdownTimer extends Component
{
    public string $target;

    public string $timezone;

    public ?string $label;

    /**
     * Create a new component instance.
     */
    public function __construct($target, $timezone = 'UTC', $label = null)
    {
        $this->target = Carbon::parse($target, $timezone)->toIso8601String();
        $this->timezone = $timezone;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.countdown-timer');
    }
}
