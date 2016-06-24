<?php

namespace luklew\MyLittlePing;

use luklew\MyLittlePing\Connection\ConnectionManager;
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
     * Connection Manager
     *
     * @var ConnectionManager
     */
    protected $connectionManager;

    /**
     * Connection method used to ping host
     *
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * Constructor
     *
     * @param Config|null            $config            Configuration
     * @param ConnectionManager|null $connectionManager Connection Manager
     */
    public function __construct(
        Config $config = null,
        ConnectionManager $connectionManager = null
    ) {
        $this->config = $config !== null ? $config : new Config();
        $this->connectionManager = $connectionManager !== null ? $connectionManager : new ConnectionManager();
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
            $this->connection = $this->createDefaultConnection();
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
     * Call the connection factory to create a connection instance
     *
     * @param string $connectionType Connection class name
     *
     * @return ConnectionInterface
     */
    public function createConnection($connectionType)
    {
        return $this->connection = ConnectionFactory::create($connectionType, $this->config);
    }

    /**
     * Create instance of default connection
     *
     * @return ConnectionInterface
     */
    protected function createDefaultConnection()
    {
        $connectionType = $this->connectionManager->getDefaultConnection();

        return $this->createConnection($connectionType);
    }
}
