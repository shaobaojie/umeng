<?php
namespace Umeng\Android;

class AndroidUnicast extends AndroidNotification
{
    function __construct()
    {
        parent::__construct();
        $this->data["type"] = "unicast";
        $this->data["device_tokens"] = null;
    }

}