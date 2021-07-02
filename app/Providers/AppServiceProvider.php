<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()  {
        //check that app is local
        if (!$this->app->isLocal()) {
            //else register your services you require for production
            $this->app['request']->server->set('HTTPS', true);
        }

        $this->app->bind(
            'App\SeriesISaw\Repositories\Contracts\SeriesRepositoryInterface',
            'App\SeriesISaw\Repositories\SeriesRepository'
        );

        $this->app->bind(
            'App\SeriesISaw\Services\Contracts\SeriesServiceInterface',
            'App\SeriesISaw\Services\SeriesService'
        );

        $this->app->bind(
            'App\SeriesISaw\Repositories\Contracts\PlatformRepositoryInterface',
            'App\SeriesISaw\Repositories\PlatformRepository'
        );

        $this->app->bind(
            'App\SeriesISaw\Services\Contracts\PlatformServiceInterface',
            'App\SeriesISaw\Services\PlatformService'
        );

        $this->app->bind(
            'App\SeriesISaw\Repositories\Contracts\UserRepositoryInterface',
            'App\SeriesISaw\Repositories\UserRepository'
        );

        $this->app->bind(
            'App\SeriesISaw\Services\Contracts\UserServiceInterface',
            'App\SeriesISaw\Services\UserService'
        );

        $this->app->bind(
            'App\SeriesISaw\Repositories\Contracts\SeriesHistoryRepositoryInterface',
            'App\SeriesISaw\Repositories\SeriesHistoryRepository'
        );

        $this->app->bind(
            'App\SeriesISaw\Services\Contracts\SeriesHistoryServiceInterface',
            'App\SeriesISaw\Services\SeriesHistoryService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()  {
    }
}
