<?php

namespace luklew\MyLittlePing\Socket;

use luklew\MyLittlePing\Config;
use luklew\MyLittlePing\Connection\ConnectionInterface;

class Socket implements ConnectionInterface
{
    /**
     * @var Packet
     */
    protected $packet;

    /**
     * @var Config
     */
    protected $config;

    protected $resource;

    protected $errorMessage;
    protected $latency;

    public function __construct(Config $config, Packet $packet = null)
    {
        $this->config = $config;
        $this->packet = $packet === null ? new Packet() : $packet;
        $this->packet->setPayload($config->getPayload());
    }

    public function ping($host)
    {
        $package = $this->packet->generateChecksum()->getPacketString();

        try {
            if (@$socket = socket_create(AF_INET, SOCK_RAW, 1)) {
                socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array(
                    'sec' => 10,
                    'usec' => 0,
                ));
                // Prevent errors from being printed when host is unreachable.
                @socket_connect($socket, $host, null);
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

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getLatency()
    {
        return $this->latency;
    }
}
