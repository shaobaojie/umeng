<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 15/6/24
 * Time: 14:24
 */

namespace Umeng\Android;


use Umeng\Pusher;

class AndroidPusher extends Pusher
{
    /**unicast
     * @param string $device_tokens ','
     * @param array $body 友盟的body格式数组
     * @param array $extra
     * @return int|mixed
     * @throws Exception
     */
    public function unicast($device_tokens = '', $body = [], $extra = [])
    {
        $unicast = new AndroidUnicast();
        $unicast->setAppMasterSecret($this->app_master_secret);
        $unicast->setPredefinedKeyValue("appkey", $this->app_key);
        $unicast->setPredefinedKeyValue("timestamp", strval(time()));
        // Set your device tokens here
        $unicast->setPredefinedKeyValue("device_tokens", $device_tokens);
        foreach ($body as $key => $val) {
            $unicast->setPredefinedKeyValue($key, $val);
        }
        // Set 'production_mode' to 'false' if it's a test device.
        // For how to register a test device, please see the developer doc.
        $unicast->setPredefinedKeyValue("production_mode", $this->production);
        // Set extra fields
        foreach ($extra as $key => $val) {
            $unicast->setExtraField($key, $val);
        }

        return $unicast->send();
    }

    /**
     * 列播
     * @param string $device_tokens
     * @param array $body
     * @param array $extra
     * @return mixed
     * @throws \Umeng\Exception\UmengException
     */
    public function listcast($device_tokens = '', $body = [], $extra = [])
    {
        $listcast = new AndroidListcast();
        $listcast->setAppMasterSecret($this->app_master_secret);
        $listcast->setPredefinedKeyValue("appkey", $this->app_key);
        $listcast->setPredefinedKeyValue("timestamp", strval(time()));
        // Set your device tokens here
        $listcast->setPredefinedKeyValue("device_tokens", $device_tokens);
        foreach ($body as $key => $val) {
            $listcast->setPredefinedKeyValue($key, $val);
        }
        // Set 'production_mode' to 'false' if it's a test device.
        // For how to register a test device, please see the developer doc.
        $listcast->setPredefinedKeyValue("production_mode", $this->production);
        // Set extra fields
        foreach ($extra as $key => $val) {
            $listcast->setExtraField($key, $val);
        }

        return $listcast->send();
    }

    /**
     * 广播
     * @param array $body
     * @param array $extra
     * @return int
     * @throws \Umeng\Android\Exception
     */
    public function broadcast($body = [], $extra = [])
    {
        $brocast = new AndroidBroadcast();
        $brocast->setAppMasterSecret($this->app_master_secret);
        $brocast->setPredefinedKeyValue("appkey", $this->app_key);
        $brocast->setPredefinedKeyValue("timestamp", strval(time()));

        foreach ($body as $key => $val) {
            $brocast->setPredefinedKeyValue($key, $val);
        }
        // Set 'production_mode' to 'false' if it's a test device.
        // For how to register a test device, please see the developer doc.
        $brocast->setPredefinedKeyValue("production_mode", $this->production);
        // [optional]Set extra fields
        // Set extra fields
        foreach ($extra as $key => $val) {
            $brocast->setExtraField($key, $val);
        }

        return $brocast->send();
    }

    /** customizedcast
     * @param string $alias
     * @param array $body
     * @param array $extra
     * @return int|mixed
     * @throws Exception
     */
    public function customizedcast($alias = '', $body = [], $extra = [])
    {
        $customizedcast = new AndroidCustomizedcast();
        $customizedcast->setAppMasterSecret($this->app_master_secret);
        $customizedcast->setPredefinedKeyValue("appkey", $this->app_key);
        $customizedcast->setPredefinedKeyValue("timestamp", strval(time()));
        // Set your alias here, and use comma to split them if there are multiple alias.
        // And if you have many alias, you can also upload a file containing these alias, then
        // use file_id to send customized notification.
        $customizedcast->setPredefinedKeyValue("alias", $alias);
        // Set your alias_type here
        $customizedcast->setPredefinedKeyValue("alias_type", $this->android_alias_type);
        foreach ($body as $key => $val) {
            $customizedcast->setPredefinedKeyValue($key, $val);
        }
        foreach ($extra as $key => $val) {
            $customizedcast->setExtraField($key, $val);
        }
        $customizedcast->setPredefinedKeyValue("production_mode", $this->production);

        return $customizedcast->send();
    }

    public function sendStatus($taskID)
    {
        $sendStatus = new AndroidSendStatus();
        $sendStatus->setAppMasterSecret($this->app_master_secret);
        $sendStatus->setPredefinedKeyValue("appkey", $this->app_key);
        $sendStatus->setPredefinedKeyValue("timestamp", strval(time()));
        $sendStatus->setPredefinedKeyValue("task_id", $taskID);
        return $sendStatus->sendResponse();
    }

}