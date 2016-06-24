<?php

namespace luklew\MyLittlePing\Connection;

use luklew\MyLittlePing\Config;

/**
 * Factory for connections
 *
 * @package luklew\MyLittlePing\Connection
 */
class ConnectionFactory
{
    /**
     * Create a new instance using class name or instance
     *
     * @param string|ConnectionInterface $type      Connection
     * @param Config                     $config    Configuration
     * 
     * @return ConnectionInterface
     */
    public static function create($type, $config)
    {
        return new $type($config);
    }
}
