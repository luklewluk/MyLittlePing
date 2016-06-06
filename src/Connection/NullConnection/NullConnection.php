<?php

namespace luklew\MyLittlePing\Connection\NullConnection;

use luklew\MyLittlePing\Connection\ConnectionInterface;

class NullConnection implements ConnectionInterface
{
    public function ping($host)
    {
        return rand(5, 55);
    }

    public function getErrorMessage()
    {
        // TODO: Implement getErrorMessage() method.
    }
}
