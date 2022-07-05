<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    /**
     * Handle the Course "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */


    public function created(Category $category){

      Cache::forget('categories');
      Cache::forget('main-categories');
    }
    public function updated(Category $category)
    {
        Cache::forget('categories');
        Cache::forget('main-categories');
    }

    /**
     * Handle the Course "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        Cache::forget('categories');
        Cache::forget('main-categories');
    }
}
