<?php

namespace luklew\MyLittlePing;

use luklew\MyLittlePing\Connection\ConnectionInterface;

/**
 * Options for ping
 *
 * @package luklew\MyLittlePing
 */
class Config
{
    /**
     * Port used to ping
     *
     * @var int
     */
    protected $port = 80;

    /**
     * Data "attached" to ping packet
     *
     * @var string
     */
    protected $payload = 'a';

    /**
     * All connections as class names and instances
     *
     * @var string[]
     */
    protected $connections;

    /**
     * Add a new connection method
     *
     * @param string|ConnectionInterface $connection Connection class instance or string
     */
    public function addConnection($connection)
    {
        $this->connections[] = $connection;
    }

    /**
     * Gets first connection from the list
     *
     * @return string|ConnectionInterface Connection type
     */
    public function getDefaultConnection()
    {
        return $this->connections[0];
    }

    /**
     * Get payload
     *
     * @return string Payload
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Set payload
     *
     * @param string $payload Payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Get all connections
     *
     * @return string|ConnectionInterface[] Connections list
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * Set list of connections
     *
     * @param string||ConnectionInterface[] $connections Connections list
     */
    public function setConnections($connections)
    {
        $this->connections = $connections;
    }
}
