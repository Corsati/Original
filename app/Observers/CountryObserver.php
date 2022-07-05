<?php

namespace App\Observers;

 use App\Models\Country;
use Illuminate\Support\Facades\Cache;

class CountryObserver
{
    /**
     * Handle the AcademicLevel "updated" event.
     *
     * @param  \App\Models\Country  $country
     * @return void
     */
    public function updated(Country $country)
    {
        Cache::forget('countries');
    }

    /**
     * Handle the AcademicLevel "deleted" event.
     *
     * @param  \App\Models\Country  $country
     * @return void
     */
    public function deleted(Country $country)
    {
        Cache::forget('countries');
    }
}
