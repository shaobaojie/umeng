# UMeng PHP SDK For Laravel 5.2

整合修改官方的示例，融合到Laravel 5中。

1.composer 安装

    composer require umeng/umeng @dev

2.在app.php 中添加ServiceProvider、Facades

    'Umeng\UMengLaravelServiceProvider',
aliases:

    'Android'           => 'Umeng\Facades\Android',
    'IOS'               => 'Umeng\Facades\IOS',

3.配置文件

    php artisan  vendor:publish  umeng/umeng
 
 修改配置文件 config/Services/umeng.php 填上你自己的Key Secret
 
4.示例

    $apns = [
        'alert' => ['title'=>'biaoti','body'=>'fujingdexuanjianghu'], 
        'badge' => 1, 
        'sound' => 'bingbong.aiff'
        ];
    return IOS::customizedcast('S100000567',$apns);
    
    $body = [
        'ticker'=>'收到请告诉我',
        'title'=>'通知标题',
        'text'=>'通知文字描述',
        'after_open'=>'go_app'
        ];
    return Android::customizedcast('S100000597', $body);
 
 
