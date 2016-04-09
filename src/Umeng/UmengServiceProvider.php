<?php namespace Umeng;

use Illuminate\Support\ServiceProvider;
use Umeng\Android\AndroidPusher;
use Umeng\IOS\IOSPusher;

class UmengServiceProvider extends ServiceProvider
{


    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('Services/umeng.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('umeng.ios', function ($app) {
            return new IOSPusher($app['config']['Services']['umeng']['ios_appKey'], $app['config']['Services']['umeng']['ios_app_master_secret']);
        });
        $this->app->singleton('umeng.android', function ($app) {
            return new AndroidPusher($app['config']['Services']['umeng']['android_appKey'], $app['config']['Services']['umeng']['android_app_master_secret']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['umeng.ios', 'umeng.android'];
    }

}
