<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 16/4/7
 * Time: 19:29
 */
namespace Umeng\IOS;

class IOSListcast extends IOSNotification
{
    function __construct()
    {
        parent::__construct();
        $this->data["type"] = "listcast";
        $this->data["device_tokens"] = null;
    }

}