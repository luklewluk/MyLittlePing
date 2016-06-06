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

$config = new Config();

$connections = [
    Socket::class,
    NullConnection::class,
];

$config->setConnections($connections);

$ping = new Ping($config);
echo $ping->send('allegro.pl') . PHP_EOL;
