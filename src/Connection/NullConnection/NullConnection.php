<?php

namespace luklew\MyLittlePing\Connection\NullConnection;

use luklew\MyLittlePing\Connection\ConnectionInterface;

class NullConnection implements ConnectionInterface
{
    public function ping($host)
    {
        //
    }

    public function getErrorMessage()
    {
        // TODO: Implement getErrorMessage() method.
    }

    public function getLatency()
    {
        return rand(5, 55);
    }
}
