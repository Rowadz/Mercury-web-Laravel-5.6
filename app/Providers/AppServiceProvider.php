<?php

namespace Mercury\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Mercury\Wish;
use Mercury\Follower;

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
        Blade::component('user.components.helperComponents.vuePosts', 'vuePosts');
        Blade::component('layouts.navBar', 'navBar');

        // social components
        Blade::component('user.components.socialComponents.followers', 'followers');
        Blade::component('user.components.socialComponents.followRequests', 'followRequests');


        // register a callback function when the navBarWelcome renderd so
        // you don't need to keep getting the the default information each time
        // you return a view !.
        View::composer('layouts.navBar', function($view){
            $view->with(
                [
                    "wishes" => Wish::getWishes(),
    		        "allFollowers" => Follower::allFollowers(),
                    "allFollowedByTheUser" => Follower::allFollowedByTheUser(),
                    "followRequestsCount" => Follower::followRequestsCount()
                ]
            );
        });

        // View::share('defaultData',[
        //     "wishes" => Wish::getWishes(),
    	// 	"allFollowers" => Follower::allFollowers(),
    	// 	"allFollowedByTheUser" => Follower::allFollowedByTheUser()
        // ]);
        
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
