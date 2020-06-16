<?php

/**
 * 创建sockets服务端,利用thrift实现客户端
 * @Author: yuanxr
 * @Date:   2020-06-16 09:42:52
 * @Last Modified by:   yuanxr
 * @Last Modified time: 2020-06-16 11:22:20
 */


class SocketServer
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
		socket_bind($this->socket, $this->host,$this->port);
		
	}

	public function listen()
	{
		socket_listen($this->socket);
		$this->todo();

	}

	public function todo()
	{
		echo "连接中....\n";
		while (true) {
			$connect = socket_accept($this->socket);
			if($connect === false) echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($this->socket)) . "\n";
			
			$buf = socket_read($connect,2048);
			echo "$buf\n";
			$msg = "你好：".$buf;
			socket_write($connect,$msg,strlen($msg));
		}
	}

	public function close()
	{
		socket_close($this->socket);
	}
}
$conf = ['host'=>'127.0.0.1','port'=>9876];
$server = new SocketServer($conf);
$server->listen();