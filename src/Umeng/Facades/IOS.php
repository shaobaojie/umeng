<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 15/6/16
 * Time: 下午6:02
 */

namespace Umeng\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacades;

class IOS extends LaravelFacades
{
    protected static function getFacadeAccessor()
    {
        return 'umeng.ios';
    }

}
