<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 15/6/24
 * Time: 14:08
 */

namespace Umeng\IOS;


use Umeng\Exception\UmengException;
use Umeng\Pusher;

class IOSPusher extends Pusher
{
    public function broadcast($aps = [], $extra = [])
    {
        $brocast = new IOSBroadcast();
        $brocast->setAppMasterSecret($this->app_master_secret);
        $brocast->setPredefinedKeyValue("appkey", $this->app_key);
        $brocast->setPredefinedKeyValue("timestamp", $this->timestamp);
        foreach ($aps as $key => $val) {
            $brocast->setPredefinedKeyValue($key, $val);
        }
        $brocast->setPredefinedKeyValue("production_mode", $this->production);
        foreach ($extra as $key => $val) {
            $brocast->setCustomizedField($key, $val);
        }
        return $brocast->send();
    }

    /**发送iOS 单播消息
     * @param string $device_tokens ","分割
     * @param array $aps ['alert'=>'','badge'=>0,'sound'=>'chime','content-available'=>'']
     * @param array $extra
     * @return int|mixed
     * @throws \Umeng\Exception\Exception
     */
    public function unicast($device_tokens = '', $aps = [], $extra = [])
    {

        $unicast = new IOSUnicast();
        $unicast->setAppMasterSecret($this->app_master_secret);
        $unicast->setPredefinedKeyValue("appkey", $this->app_key);
        $unicast->setPredefinedKeyValue("timestamp", $this->timestamp);
        $unicast->setPredefinedKeyValue("device_tokens", $device_tokens);
        foreach ($aps as $key => $val) {
            $unicast->setPredefinedKeyValue($key, $val);
        }
        // Set 'production_mode' to 'true' if your app is under production mode
        $unicast->setPredefinedKeyValue("production_mode", $this->production);
        // Set customized fields
        foreach ($extra as $key => $val) {
            $unicast->setCustomizedField($key, $val);
        }
        return $unicast->send();
    }

    /**customizes(通过开发者自有的alias进行推送)
     * @param string $alias
     * @param array $aps
     * @param array $extra
     * @param null $alias_type
     * @param bool $production
     * @return int|mixed
     */
    public function customizedcast($alias = '', $aps = [], $extra = [])
    {
        $customizedcast = new IOSCustomizedcast();
        $customizedcast->setAppMasterSecret($this->app_master_secret);
        $customizedcast->setPredefinedKeyValue("appkey", $this->app_key);
        $customizedcast->setPredefinedKeyValue("timestamp", $this->timestamp);
        // Set your alias here, and use comma to split them if there are multiple alias.
        // And if you have many alias, you can also upload a file containing these alias, then
        // use file_id to send customized notification.
        $customizedcast->setPredefinedKeyValue("alias", $alias);
        // Set your alias_type here
        $customizedcast->setPredefinedKeyValue("alias_type", $this->ios_alias_type);
        foreach ($aps as $key => $val) {
            $customizedcast->setPredefinedKeyValue($key, $val);
        }
        foreach ($extra as $key => $val) {
            $customizedcast->setCustomizedField($key, $val);
        }
        $customizedcast->setPredefinedKeyValue("production_mode", $this->production);
        return $customizedcast->send();
    }

}