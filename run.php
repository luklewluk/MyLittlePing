<?php

use luklew\MyLittlePing\Config;
use luklew\MyLittlePing\Connection\ConnectionManager;
use luklew\MyLittlePing\Connection\NullConnection\NullConnection;
use luklew\MyLittlePing\Ping;

require_once 'src/Config.php';
require_once 'src/Ping.php';
require_once 'src/Connection/ConnectionFactory.php';
require_once 'src/Connection/ConnectionInterface.php';
require_once 'src/Connection/ConnectionManager.php';
require_once 'src/Connection/NullConnection/NullConnection.php';
require_once 'src/Connection/Socket/Socket.php';
require_once 'src/Connection/Socket/Packet.php';

// Basic usage
$ping = new Ping();
echo $ping->send('google.com') . PHP_EOL;

// Set different port
$config = new Config();
$config->setPort(8080);

$ping = new Ping($config);
echo $ping->send('google.com') . PHP_EOL;

// Connection queue (use next connection if error occurred)
$connectionManager = new ConnectionManager();
$connectionManager->addConnection(NullConnection::class);

$ping = new Ping(null, $connectionManager);
echo $ping->send('google.com') . PHP_EOL;

// Use your own implementations of connection
$connectionManager = new ConnectionManager();
$connectionManager->setConnections([
    NullConnection::class,
]);

$ping = new Ping(null, $connectionManager);
echo $ping->send('google.com') . PHP_EOL;
