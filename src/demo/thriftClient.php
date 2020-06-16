<?php

/**
 * @Author: yuanxr
 * @Date:   2020-06-16 11:24:09
 * @Last Modified by:   yuanxr
 * @Last Modified time: 2020-06-16 16:10:17
 */
require __DIR__ . '/../../vendor/autoload.php';

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TSocket;

class ThriftClient
{
    private $socket                = null;
    private $transport             = null;
    private $protocol              = null;
    private $client                = null;
    private $host                  = null;
    private $port                  = null;
    private $rocketMq_client_hosts = [];

    public function __construct($conf)
    {
        # code...
        $this->host = $conf['host'];
        $this->port = $conf['port'];
        $this->connect();
    }

    /**
     * 建立连接
     */
    private function connect()
    {
        $this->socket    = new TSocket($this->host, $this->port);
        $this->transport = new TBufferedTransport($this->socket, 1024, 1024); //传输层协议
        $this->protocol  = new TBinaryProtocol($this->transport); //数据层协议
        $this->open();
        // $this->client    = new RocketMqProducerClient( $this->protocol );
    }

    public function open()
    {
    	$this->socket->open();
    }

    public function getClient()
    {
        print_r($this->socket);
    }

    public function write()
    {
    	$buf = "我是客户端1：";
    	$this->socket->wirte($buf);
    }

}

$conf          = ['host' => '127.0.0.1', 'port' => 9876];
$thrift_client = new ThriftClient($conf);
$thrift_client->write();
