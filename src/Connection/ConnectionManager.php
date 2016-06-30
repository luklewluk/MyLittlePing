<?php

namespace luklew\MyLittlePing\Connection;

use luklew\MyLittlePing\Connection\Socket\Socket;

/**
 * Manage connections
 *
 * @package luklew\MyLittlePing\Connection
 */
class ConnectionManager
{
    /**
     * All connections as class names or instances.
     * By default all library connections.
     *
     * @var string[]
     */
    protected $connections = [
        Socket::class,
    ];

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
     * Get following connection type from the array
     * by moving pointer to the next position
     *
     * @return string|ConnectionInterface|false Connection type
     */
    public function getNextConnection()
    {
        return next($this->connections);
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
