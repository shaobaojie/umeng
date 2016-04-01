<?php namespace xieyi64\UmengLaravel;

use Illuminate\Support\ServiceProvider;
use xieyi64\UmengLaravel\Android\AndroidPusher;
use xieyi64\UmengLaravel\IOS\IOSPusher;

class UmengLaravelServiceProvider extends ServiceProvider
{


    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
//        var_dump(__DIR__.'/config.php', config_path('umeng-laravel.php'));die;
        $this->publishes([
            __DIR__.'/config.php' => config_path('umeng-laravel.php'),
        ],'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('umeng.ios', function ($app) {
            return new IOSPusher($app['config']['umeng-laravel.ios_appKey'], $app['config']['umeng-laravel.ios_app_master_secret']);
        });
        $this->app->bind('umeng.android', function ($app) {
            return new AndroidPusher($app['config']['umeng-laravel.android_appKey'], $app['config']['umeng-laravel.android_app_master_secret']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('umeng.ios','umeng.android');
    }

}
