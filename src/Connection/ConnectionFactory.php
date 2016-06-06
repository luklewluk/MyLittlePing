<?php

namespace luklew\Connection;

use luklew\Config;
use luklew\Connection\NullConnection\NullConnection;

class ConnectionFactory
{
    public function create($config, $mode = NullConnection::class)
    {
        return new $mode($config);
    }

    public function createNullConnection($config = null)
    {
        return $config === null ? new NullConnection(new Config()) : new NullConnection();
    }
}
