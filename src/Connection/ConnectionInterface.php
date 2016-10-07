<?php

namespace luklew\MyLittlePing\Connection;

/**
 * Interface for connection methods
 *
 * @package luklew\MyLittlePing
 * @author  Lukasz Lewandowski <luklewluk@gmail.com>
 */
interface ConnectionInterface
{
    /**
     * Ping a server
     *
     * @param string $host Host address or domain
     *
     * @return void
     */
    public function ping($host);

    /**
     * Get error message
     *
     * @return string Error message
     */
    public function getErrorMessage();

    /**
     * Get latency
     *
     * @return int Latency in milliseconds
     */
    public function getLatency();
}
