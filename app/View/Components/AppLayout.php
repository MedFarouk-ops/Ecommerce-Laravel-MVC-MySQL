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
        $websiteInfo = \App\Models\WebsiteInfo::first();

        return view('layouts.app', [
            'websiteInfo' => $websiteInfo,
        ]);
    }

}
