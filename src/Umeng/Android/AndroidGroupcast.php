<?php
namespace Umeng\Android;

class AndroidGroupcast extends AndroidNotification
{
    function __construct()
    {
        parent::__construct();
        $this->data["type"] = "groupcast";
        $this->data["filter"] = null;
    }
}