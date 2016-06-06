<?php

use luklew\Ping;

require_once 'src/Config.php';
require_once 'src/Ping.php';
require_once 'src/Connection/ConnectionFactory.php';
require_once 'src/Connection/ConnectionInterface.php';
require_once 'src/Connection/NullConnection/NullConnection.php';

$ping = new Ping();
echo $ping->send('1');
