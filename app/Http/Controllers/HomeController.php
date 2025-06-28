<?php

namespace App\Http\Controllers;

use App\Models\Ad;

class HomeController extends Controller
{
    public function __invoke()
    {
        $ad_home_top = Ad::where('position', Ad::HOME_TOP)
            ->where('status', Ad::STATUS_ACTIVE)
            ->latest()
            ->first();

        $ad_home_middle = Ad::where('position', Ad::HOME_MIDDLE)
            ->where('status', Ad::STATUS_ACTIVE)
            ->latest()
            ->first();

        return view('website.pages.home', get_defined_vars());
    }
}
