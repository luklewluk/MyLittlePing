<?php

use luklew\MyLittlePing\Config;
use luklew\MyLittlePing\Connection\NullConnection\NullConnection;
use luklew\MyLittlePing\Ping;
use luklew\MyLittlePing\Socket\Socket;

require_once 'src/Config.php';
require_once 'src/Ping.php';
require_once 'src/Connection/ConnectionFactory.php';
require_once 'src/Connection/ConnectionInterface.php';
require_once 'src/Connection/NullConnection/NullConnection.php';
require_once 'src/Connection/Socket/Socket.php';
require_once 'src/Connection/Socket/Packet.php';

// New config instance
$config = new Config();

// Add connection types (also your own implementation)
$config->addConnection(Socket::class);
$config->addConnection(NullConnection::class);

// Or using array way
$connections = [
    Socket::class,
    NullConnection::class,
];
$config->setConnections($connections);

// New application instance
$ping = new Ping($config);

// Ping
echo $ping->send('google.com') . PHP_EOL;
