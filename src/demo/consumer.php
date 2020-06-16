<?php
require(__DIR__ . '/../../vendor/autoload.php');

//这是服务器地址监听的端口，可以配置多个，每个配置启动一个进程处理消息
$config = [
    [
        'host'=>'121.199.30.160',
        'port'=>'50047'
    ]
];
$client = new \RocketMqClient\RocketMqConsumerClient($config);

try {
    $res = $client->sendMsg('public','TagA','this is test msg');
    //简单的测试是否连通
    var_dump($res);
    echo PHP_EOL;
}  catch (\Exception $e) {
    print_r($e);
}