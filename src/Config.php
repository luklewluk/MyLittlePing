<?php

namespace luklew\MyLittlePing;

class Config
{
    protected $port = 80;

    protected $payload = 'ping';

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
