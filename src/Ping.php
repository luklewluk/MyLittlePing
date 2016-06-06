<?php

namespace luklew\MyLittlePing;

use luklew\MyLittlePing\Connection\ConnectionFactory;

class Ping
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var ConnectionFactory
     */
    protected $connectionFactory;

    public function __construct($config = null)
    {
        $this->connectionFactory = new ConnectionFactory();
        $this->config = $config === null ? new Config() : $config;
    }

    public function send($host)
    {
        $connection = $this->connectionFactory->create($this->config);

        $latency = $connection->ping($host);
        if ($connection->getErrorMessage() === null) {
            return $latency;
        }

        // TODO: Add logger
        return false;
    }
}
