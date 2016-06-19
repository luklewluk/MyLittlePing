<?php

namespace luklew\MyLittlePing\Connection;

/**
 * Interface for connection methods
 *
 * @package luklew\MyLittlePing\Connection
 */
interface ConnectionInterface
{
    /**
     * Get error message
     *
     * @return string Error message
     */
    public function getErrorMessage();

    /**
     * Ping a server
     *
     * @param string $host Host address or domain
     *
     * @return void
     */
    public function ping($host);

    /**
     * Get latency
     *
     * @return int Latency in milliseconds
     */
    public function getLatency();
}
