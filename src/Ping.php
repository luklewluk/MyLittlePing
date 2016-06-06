<?php

namespace luklew;

use luklew\Connection\ConnectionFactory;

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

        return $connection->ping($host);
    }
}
