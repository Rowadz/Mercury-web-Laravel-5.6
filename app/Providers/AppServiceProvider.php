<?php

namespace Mercury\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // for the models error ?
        Schema::defaultStringLength(191);
        // Aliasing Components

        // home component
        Blade::component('user.components.homeComponents.offersCards', 'offersCards');
        Blade::component('user.components.homeComponents.feedList', 'feedList');
        
        // post components
        Blade::component('user.components.showPostComponents.post', 'post');
        Blade::component('user.components.showPostComponents.comments', 'comments');
        Blade::component('user.components.showPostComponents.options', 'options');
        
        // profile components
        Blade::component('user.components.profileComponents.generalInfo', 'generalInfo');
        Blade::component('user.components.profileComponents.recentPosts', 'recentPosts');
        Blade::component('user.components.profileComponents.achivements', 'achivements');
        
        // helper components
        // this component is used in the home.blade, the visitor page & profile page
        Blade::component('user.components.helperComponents.displayPosts', 'displayPosts');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
