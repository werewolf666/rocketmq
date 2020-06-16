<?php
<<<<<<< HEAD:src/demo/client.php

/**
 * 
 * @Author: yuanxr
 * @Date:   2020-06-16 09:42:52
 * @Last Modified by:   yuanxr
 * @Last Modified time: 2020-06-16 11:23:03
 */


class SocketClient
{
	public $host;
	public $port;
	public $socket;
	public $server;
	
	function __construct($conf)
	{
		error_reporting(E_ALL);
		$this->host = $conf['host'];
		$this->port = $conf['port'];
		$this->create();
	}

	public function create()
	{
		$this->socket = socket_create(AF_INET,SOCK_STREAM ,SOL_TCP );
		if (!$this->socket) {
			echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
		}
		
		
	}

	public function connect()
	{
		if(socket_connect($this->socket, $this->host,$this->port) === false){
			echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
		}else{
			echo "OK .\n";
		}
		$this->todo();

	}

	public function todo()
	{
		$in = "HEAD / HTTP/1.1\r\n";
		$in .= "host:www.example.com\r\n";
		$in .= "Connection: Close\r\n\r\n";
		// $in = "hello world";
		$out = "";
		$msg = $in;
		echo "$msg\n";
		socket_write($this->socket,$msg,strlen($msg));
		echo "接收消息:\n";
		$out = socket_read($this->socket,2048);
		echo $out;
	}

	public function close()
	{
		socket_close($this->socket);
	}
}
$conf = ['host'=>'127.0.0.1','port'=>9876];
$server = new SocketClient($conf);
$server->connect();
=======
require(__DIR__ . '/../../vendor/autoload.php');

//这是服务器地址监听的端口，可以配置多个，每个配置启动一个进程处理消息
$config = [
    [
        'host'=>'121.199.30.160',
        'port'=>'50047'
    ]
];
$client = new \RocketMqClient\RocketMqClient($config);

try {
    $res = $client->sendMsg('public','TagA','this is test msg');
    //简单的测试是否连通
    var_dump($res);
    echo PHP_EOL;
}  catch (\Exception $e) {
    print_r($e);
}
>>>>>>> d196bcca9acf2dc4cbb1e1a9f1cbdbf17d77510d:src/demo/producer.php
