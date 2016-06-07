<?php

namespace luklew\MyLittlePing;

use luklew\MyLittlePing\Connection\ConnectionFactory;
use luklew\MyLittlePing\Connection\ConnectionInterface;

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

    /**
     * @var ConnectionInterface
     */
    protected $connection;

    public function __construct($config = null)
    {
        $this->connectionFactory = new ConnectionFactory();
        $this->config = $config === null ? new Config() : $config;
    }
    
    public function createConnection($connectionType)
    {
        $this->connection = $this->connectionFactory->createOfType($connectionType, $this->config);
    }

    public function send($host)
    {
        if ($this->connectionFactory === null) {
            $this->createDefaultConnection();
        }
            
        $latency = $this->connection->ping($host);
        if ($this->connection->getErrorMessage() === null) {
            return $latency;
        }

        // TODO: Add logger
        return false;
    }

    /**
     * @return void
     */
    protected function createDefaultConnection()
    {
        $this->connection = $this->connectionFactory->create($this->config);
    }
}
