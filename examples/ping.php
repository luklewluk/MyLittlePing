<?php

use luklew\MyLittlePing\Config;
use luklew\MyLittlePing\Connection\Fsockopen\Fsockopen;
use luklew\MyLittlePing\Connection\NullConnection\NullConnection;
use luklew\MyLittlePing\Connection\Socket\Socket;
use luklew\MyLittlePing\Ping;

require_once '../vendor/autoload.php';

// Basic usage
$ping = Ping::createWithConnection(Fsockopen::class);
echo $ping->send('google.com') . PHP_EOL;

// Or using DI
$config = new Config();
$connection = new Socket($config);
$ping = new Ping($connection, $config);

echo $ping->send('google.com') . PHP_EOL;

// Set different port
$config->setPort(8080);
echo $ping->send('google.com') . PHP_EOL;

// Use your own implementation of connection
$ping = Ping::createWithConnection(NullConnection::class);
echo $ping->send('google.com') . PHP_EOL;
