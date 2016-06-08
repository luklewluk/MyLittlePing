<?php

namespace luklew\MyLittlePing;

use luklew\MyLittlePing\Connection\ConnectionFactory;
use luklew\MyLittlePing\Connection\ConnectionInterface;

/**
 * Main Ping library class
 *
 * @package luklew\MyLittlePing
 */
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
        if ($this->connection === null) {
            $this->createDefaultConnection();
        }

        $this->connection->ping($host);
        $latency = $this->connection->getLatency();

        if ($this->connection->getErrorMessage() === null) {
            return $latency;
        }

        // TODO: Add logger
        return null;
    }

    /**
     * @return void
     */
    protected function createDefaultConnection()
    {
        $this->connection = $this->connectionFactory->create($this->config);
    }
}
