<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 15/6/23
 * Time: 09:21
 */

namespace Umeng\Facades;

use Illuminate\Support\Facades\Facade;

class Android extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'umeng.android';
    }
}