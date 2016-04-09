<?php
namespace Umeng\IOS;

class IOSGroupcast extends IOSNotification
{
    function __construct()
    {
        parent::__construct();
        $this->data["type"] = "groupcast";
        $this->data["filter"] = null;
    }
}