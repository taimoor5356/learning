<?php

use App\Models\Setting;

if (!function_exists('systemSettings')) {
    function systemSettings()
    {
        $setting = Setting::find(1);
        return $setting;
        
    }
}