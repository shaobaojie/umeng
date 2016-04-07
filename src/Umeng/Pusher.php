<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 15/6/16
 * Time: 上午9:37
 */
namespace Umeng;

use Illuminate\Support\Facades\Config;

class Pusher
{

    protected $app_key = null;

    protected $app_master_secret = null;

    protected $timestamp = null;

    protected $validation_token = null;

    protected $ios_alias_type = null;

    protected $android_alias_type = null;

    public $production = true;

    public function __construct($key, $secret)
    {
        $this->app_key = $key;
        $this->app_master_secret = $secret;
        $this->timestamp = strval(time());
        $this->ios_alias_type = config('Services.umeng.ios_alias_type');
        $this->android_alias_type = config('Services.umeng.android_alias_type');
        $this->production = config('Services.umeng.production');
    }
}