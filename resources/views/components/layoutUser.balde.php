<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LayoutUser extends Component
{
    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('layouts.user');
    }
}
