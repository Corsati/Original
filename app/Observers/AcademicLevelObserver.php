<?php

namespace App\Observers;

use App\Models\AcademicLevel;
use Illuminate\Support\Facades\Cache;

class AcademicLevelObserver
{
    /**
     * Handle the AcademicLevel "updated" event.
     *
     * @param  \App\Models\AcademicLevel  $level
     * @return void
     */
    public function updated(AcademicLevel $level)
    {
        Cache::forget('academics');
     }

    /**
     * Handle the AcademicLevel "deleted" event.
     *
     * @param  \App\Models\AcademicLevel  $level
     * @return void
     */
    public function deleted(AcademicLevel $level)
    {
        Cache::forget('academics');
    }
}
