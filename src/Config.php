<?php

namespace luklew\MyLittlePing;

/**
 * Configuration class
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
     * @var string[]
     */
    protected $connections;

    public function addConnection($connection)
    {
        $this->connections[] = $connection;
    }

    public function getDefaultConnection()
    {
        return $this->connections[0];
    }

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param string $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return string[]
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * @param string[] $connections
     */
    public function setConnections($connections)
    {
        $this->connections = $connections;
    }
}
