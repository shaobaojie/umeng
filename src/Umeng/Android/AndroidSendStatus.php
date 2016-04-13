<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 16/4/13
 * Time: 17:43
 */

namespace Umeng\Android;


class AndroidSendStatus extends AndroidNotification
{
    protected $postPath = "/api/status";

    function __construct()
    {
        parent::__construct();
    }

    public function setPredefinedKeyValue($key, $value)
    {

        if (!is_string($key))
            throw new UmengException("key should be a string!");

        if (in_array($key, $this->DATA_KEYS)) {
            $this->data[$key] = $value;
        } else if (in_array($key, $this->PAYLOAD_KEYS)) {
            $this->data["payload"][$key] = $value;
            if ($key == "display_type" && $value == "message") {
                $this->data["payload"]["body"]["ticker"] = "";
                $this->data["payload"]["body"]["title"] = "";
                $this->data["payload"]["body"]["text"] = "";
                $this->data["payload"]["body"]["after_open"] = "";
                if (!array_key_exists("custom", $this->data["payload"]["body"])) {
                    $this->data["payload"]["body"]["custom"] = null;
                }
            }
        } else if (in_array($key, $this->BODY_KEYS)) {
            $this->data["payload"]["body"][$key] = $value;
            if ($key == "after_open" && $value == "go_custom" && !array_key_exists("custom", $this->data["payload"]["body"])) {
                $this->data["payload"]["body"]["custom"] = null;
            }
        } else if (in_array($key, $this->POLICY_KEYS)) {
            $this->data["policy"][$key] = $value;
        } else if ($key == 'task_id') {
            $this->data["task_id"] = $value;
        } else if ($key == 'msg_id') {
            $this->data["msg_id"] = $value;
        }elseif ($key == "payload" || $key == "body" || $key == "policy" || $key == "extra") {
                throw new UmengException("You don't need to set value for ${key} , just set values for the sub keys in it.");
            } else {
                throw new UmengException("Unknown key: ${key}");
            }
    }

}