<?php

namespace luklew\MyLittlePing\Connection\NullConnection;

use luklew\Connection\AbstractConnection;

/**
 * Null Connection class used to test the library
 * without making an actual connection
 *
 * @package luklew\MyLittlePing\Connection\NullConnection
 */
class NullConnection extends AbstractConnection
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
        $this->latency = rand(5, 55);
    }
}
