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
     * Create a new instance of default
     * connection set in config
     *
     * @param Config $config Configuration
     *
     * @return ConnectionInterface
     */
    public static function create($config)
    {
        $className = $config->getDefaultConnection();
        
        return new $className($config);
    }

    /**
     * Create a new instance using class name or instance
     *
     * @param string|ConnectionInterface $type      Connection
     * @param Config                     $config    Configuration
     * 
     * @return ConnectionInterface
     */
    public static function createOfType($type, $config)
    {
        return new $type($config);
    }
}
