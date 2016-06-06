<?php

namespace luklew\Connection\NullConnection;

use luklew\Connection\ConnectionInterface;

class NullConnection implements ConnectionInterface
{
    public function ping($host)
    {
        return (float)rand(5, 55);
    }
}
