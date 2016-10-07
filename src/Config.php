<?php

namespace luklew\MyLittlePing;

/**
 * Options for ping
 *
 * @package luklew\MyLittlePing
 * @author  Lukasz Lewandowski <luklewluk@gmail.com>
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
     * Get connection port
     *
     * @return int Connection port
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set connection port
     *
     * @param int $port Connection port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }
}
