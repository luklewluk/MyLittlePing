<?php

namespace luklew\MyLittlePing\Connection\NullConnection;

use luklew\MyLittlePing\Connection\ConnectionInterface;

/**
 * Null Connection class used to test the library
 * without making an actual connection
 *
 * @package luklew\MyLittlePing\Connection\NullConnection
 */
class NullConnection implements ConnectionInterface
{

    /**
     * {@inheritdoc}
     * 
     * @param string $host Destination host
     * 
     * @return void
     */
    public function ping($host)
    {
    }

    /**
     * {@inheritdoc}
     * 
     * @return void
     */
    public function getErrorMessage()
    {
    }

    /**
     * {@inheritdoc}
     * 
     * @return int
     */
    public function getLatency()
    {
        return rand(5, 55);
    }
}
