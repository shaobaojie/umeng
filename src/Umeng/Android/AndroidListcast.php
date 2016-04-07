<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 16/4/7
 * Time: 19:25
 */
namespace Umeng\Android;

class AndroidListcast extends AndroidNotification {
    function  __construct() {
        parent::__construct();
        $this->data["type"] = "listcast";
        $this->data["device_tokens"] = NULL;
    }
}