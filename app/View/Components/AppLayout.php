<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $notifications = [];
        if (Auth::user()) {
            $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->limit(5)->get();
        }
        return view('layouts.app', ['notifications' => $notifications]);
    }
}
