<?php
/**
 * Created by PhpStorm.
 * User: xutao
 * Date: 15/6/16
 * Time: 上午9:37
 */
namespace xieyi64\UmengLaravel;

use Illuminate\Support\Facades\Config;

class Pusher
{

    protected $app_key = null;

    protected $app_master_secret = null;

    protected $timestamp = null;

    protected $validation_token = null;

    protected $ios_alias_type = null;

    protected $android_alias_type = null;

    public $production =true;

    public function __construct($key, $secret)
    {
        $this->app_key = $key;
        $this->app_master_secret = $secret;
        $this->timestamp = strval(time());
        $this->ios_alias_type = Config::get('umeng-laravel.ios_alias_type');
        $this->android_alias_type = Config::get('umeng-laravel.android_alias_type');
        $this->production = Config::get('umeng-laravel.production');

        dd(Config::get('umeng-laravel.ios_alias_type'));

    }
}