<?php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SiteLayout extends Component
{
    public function render(): View
    {
        return view('layouts.site'); // Aponta para o novo site.blade.php (Awwwards)
    }
}