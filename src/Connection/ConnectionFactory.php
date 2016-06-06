<?php

namespace luklew\MyLittlePing\Connection;

use luklew\MyLittlePing\Config;

class ConnectionFactory
{
    /**
     * @param Config $config
     *
     * @return ConnectionInterface
     */
    public function create($config)
    {
        $className = $config->getDefaultConnection();
        return new $className($config);
    }
}
