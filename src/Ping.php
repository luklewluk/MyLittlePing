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
     * @param ConnectionInterface $connection Connection
     * @param Config              $config     Configuration
     */
    public function __construct(
        ConnectionInterface $connection,
        Config $config = null
    ) {
        $this->connection = $connection;
        $this->config = $config;
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
        $this->connection->ping($host);
        $latency = $this->connection->getLatency();

        if ($this->connection->getErrorMessage() === null) {
            return $latency;
        }

        return null;
    }

    /**
     * Get connection
     *
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set connection
     *
     * @param ConnectionInterface $connection Connection
     *
     * @return void
     */
    public function setConnection(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Static Ping object creator
     *
     * @param string $connectionType Connection class name
     *
     * @return Ping
     */
    public static function createWithConnection($connectionType)
    {
        $config = new Config();
        $connection = ConnectionFactory::create($connectionType, $config);

        return new static($connection, $config);
    }
}
