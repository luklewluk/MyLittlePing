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
     */
    public function ping($host)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorMessage()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getLatency()
    {
        return rand(5, 55);
    }
}
