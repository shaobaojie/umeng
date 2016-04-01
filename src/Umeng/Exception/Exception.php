<?php
/**
 * Created by PhpStorm.
 * User: xutao
 * Date: 15/6/17
 * Time: 下午1:57
 */

namespace Umeng\Exception;


class Exception extends \Exception
{
    /** 友盟错误码
     * @var int
     */
    protected $error_code = 0;

    public function __construct($message = '', $http_code=200, $error_code = 0)
    {
        parent::__construct($message, $http_code);
        $this->error_code = $error_code;
    }

    public function getUmengCode()
    {
        return $this->error_code;
    }
}