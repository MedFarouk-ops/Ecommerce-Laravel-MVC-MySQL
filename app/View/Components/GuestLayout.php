<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
   public function render(): View
    {
        $websiteInfo = \App\Models\WebsiteInfo::first();

        return view('layouts.guest', [
            'websiteInfo' => $websiteInfo,
        ]);
    }
}
