<?php

namespace luklew\MyLittlePing\Socket;

use luklew\MyLittlePing\Config;
use luklew\MyLittlePing\Connection\ConnectionInterface;

/**
 * Socket implementation of connection
 *
 * @package luklew\MyLittlePing\Socket
 */
class Socket implements ConnectionInterface
{
    /**
     * Data packet
     *
     * @var Packet
     */
    protected $packet;

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
     * Constructor
     *
     * @param Config        $config Configuration
     * @param Packet|null   $packet Data packet
     */
    public function __construct(Config $config, Packet $packet = null)
    {
        $this->config = $config;
        $this->packet = $packet === null ? new Packet() : $packet;
        $this->packet->setPayload($config->getPayload());
    }

    /**
     * {@inheritdoc}
     *
     * @param string $host Destination host
     *
     * @return void
     */
    public function ping($host)
    {
        // TODO: Move the logic into separated methods

        $package = $this->packet->generateChecksum()->getPacketString();

        try {
            if (@$socket = socket_create(AF_INET, SOCK_RAW, 1)) {
                socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array(
                    'sec' => 10,
                    'usec' => 0,
                ));
                // Prevent errors from being printed when host is unreachable.
                @socket_connect($socket, $host, $this->config->getPort());
                $start = microtime(true);
                // Send the package.
                @socket_send($socket, $package, strlen($package), 0);
                if (socket_read($socket, 255) !== false) {
                    $latency = microtime(true) - $start;
                    $latency = round($latency * 1000);
                } else {
                    $latency = false;
                }
            } else {
                throw new \Exception('Unable to open socket');
            }
            // Close the socket.
            socket_close($socket);

            $this->latency = $latency;

        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
    }

    /**
     * {@inheritdoc}
     * 
     * @return string Error message
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * {@inheritdoc}
     * 
     * @return int Latency in milliseconds
     */
    public function getLatency()
    {
        return $this->latency;
    }
}
