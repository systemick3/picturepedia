<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('Abraham\TwitterOAuth\TwitterOAuth', function($app)
      {
        $consumerKey = config('twitteroauth.CONSUMER_KEY');
        $consumerSecret = config('twitteroauth.CONSUMER_SECRET');
        return new \Abraham\TwitterOAuth\TwitterOAuth($consumerKey, $consumerSecret);
      });
    }
}
