<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Modules\Main\Models\Notification;

use Auth;

class ComposerViewProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        View::composer('*', function($view) {
            if(!empty(Auth::user())) {
                $Notification = new Notification();
                $NotificationList = $Notification::where('user_id', Auth::user()->id)->where('seen', 0)->get();
                $view->with('notifications', $NotificationList);
            }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
