<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 16/4/13
 * Time: 17:43
 */

namespace Umeng\IOS;


class IOSSendStatus extends IOSNotification
{
	protected $postPath = "/api/status";

	function __construct()
	{
		parent::__construct();
	}


	function setPredefinedKeyValue($key, $value)
	{
		if (!is_string($key))
			throw new UmengException("key should be a string!");

		if (in_array($key, $this->DATA_KEYS)) {
			$this->data[$key] = $value;
		} else if (in_array($key, $this->APS_KEYS)) {
			$this->data["payload"]["aps"][$key] = $value;
		} else if (in_array($key, $this->POLICY_KEYS)) {
			$this->data["policy"][$key] = $value;
		} else if ($key == 'task_id') {
			$this->data["task_id"] = $value;
		} else {
			if ($key == "payload" || $key == "policy" || $key == "aps") {
				throw new UmengException("You don't need to set value for ${key} , just set values for the sub keys in it.");
			} else {
				throw new UmengException("Unknown key: ${key}");
			}
		}
	}

}