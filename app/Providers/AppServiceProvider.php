<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Validator;
use Event;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!in_array(env('APP_ENV'), ['local','development'])) {
            $this->app['request']->server->set('HTTPS', true);
        }

        if (env('APP_ENV') == 'local') {
            Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
                // filter oauth ones
                if (!str_contains($query->sql, 'oauth')) {

                    Log::debug($query->sql . ' - ' . serialize($query->bindings));
                }
            });
        }

        Paginator::useBootstrap();
        Validator::extendImplicit('alpha_dash_space', function ($attr, $value) {
            return preg_match('/^[A-Za-z0-9_\s\-]+$/', $value);
        }, 'The :attr may only contain letters, numbers, dashes, space and underscores.');
        Validator::replacer('alpha_dash_space', function ($message, $attribute) {
            return str_replace(':attr', str_replace('_', ' ', ucwords($attribute)), $message);
        });
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
        view()->composer('*', function ($view) {

        });
    }
}
