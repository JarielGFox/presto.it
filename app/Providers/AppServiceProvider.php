<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;
use Laravel\Socialite\Facades\Socialite;
//use SocialiteProviders\Google\GoogleExtendSocialite;
use App\Providers\GoogleExtendSocialite;
use Laravel\Socialite\SocialiteManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (Schema::hasTable('categories')) {
            View::share('categories', Category::all());
        }

        Paginator::useBootstrapFive();
        
/*         $this->app->singleton('Laravel\Socialite\Contracts\Factory', function ($app) {
            $httpClient = new Client(['verify' => env('CA_CERT_PATH')]);
            return new SocialiteManager($app, $httpClient);
        }); 
 */

        
    }

}
