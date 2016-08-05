<?php

use luklew\MyLittlePing\Config;
use luklew\MyLittlePing\Connection\NullConnection\NullConnection;
use luklew\MyLittlePing\Connection\Socket\Socket;
use luklew\MyLittlePing\Ping;

require_once 'src/Config.php';
require_once 'src/Ping.php';
require_once 'src/Connection/ConnectionFactory.php';
require_once 'src/Connection/ConnectionInterface.php';
require_once 'src/Connection/NullConnection/NullConnection.php';
require_once 'src/Connection/Socket/Socket.php';
require_once 'src/Connection/Socket/Packet.php';

// Basic usage
$ping = Ping::createWithConnection(Socket::class);
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
