<?php

namespace luklew\MyLittlePing\Connection;

use luklew\MyLittlePing\Config;

/**
 * Abstract Connection Class
 *
 * @package luklew\MyLittlePing
 * @author  Lukasz Lewandowski <luklewluk@gmail.com>
 */
abstract class AbstractConnection implements ConnectionInterface
{
    /**
     * Configuration
     *
     * @var Config
     */
    protected $config;

    /**
     * Error message
     *
     * @var string
     */
    protected $errorMessage;

    /**
     * Latency in milliseconds
     *
     * @var int
     */
    protected $latency;

    /**
     * Start timestamp
     *
     * @var int
     */
    protected $timer;

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
     * Get error message
     *
     * @return string Error message
     */
    public function getErrorMessage()
    {
        $this->errorMessage;
    }

    /**
     * Get latency
     *
     * @return int Latency in milliseconds
     */
    public function getLatency()
    {
        return $this->latency;
    }

    /**
     * Save current timestamp
     *
     * @return void
     */
    protected function startTimer()
    {
        $this->timer = microtime(true);
    }

    /**
     * Calculate passed time and clear timer
     *
     * @return float Time difference in ms
     */
    protected function stopTimer()
    {
        $latency = microtime(true) - $this->timer;
        $this->timer = null;

        return round($latency * 1000);
    }
}
