<?php

namespace luklew\MyLittlePing\Connection;

interface ConnectionInterface
{
    public function getErrorMessage();

    public function ping($host);
}
