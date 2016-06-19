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
     * Settings for connection
     *
     * @var Config
     */
    protected $config;

    /**
     * Connection method used to ping host
     *
     * @var ConnectionInterface
     */
    protected $connection;


    /**
     * Constructor
     *
     * @param Config $config Configuration
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Call the connection factory to create a connection instance
     *
     * @param string $connectionType Connection class name
     *
     * @return void
     */
    public function createConnection($connectionType)
    {
        $this->connection = ConnectionFactory::createOfType($connectionType, $this->config);
    }

    /**
     * Send ping to get latency
     *
     * @param string $host Destination host
     *
     * @return int|null Ping latency
     */
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
     * Create instance of default connection
     *
     * @return void
     */
    protected function createDefaultConnection()
    {
        $this->connection = ConnectionFactory::create($this->config);
    }
}
