<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
{
    return view('layouts.app'); // Aponta para o novo arquivo app.blade.php (Sidebar Admin)
}
}
