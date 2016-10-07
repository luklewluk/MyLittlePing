<?php

namespace luklew\MyLittlePing\Connection\Socket;

use luklew\MyLittlePing\Connection\AbstractConnection;
use luklew\MyLittlePing\Config;

/**
 * Socket implementation of connection
 *
 * @package luklew\MyLittlePing\Connection\Socket
 * @author  Lukasz Lewandowski <luklewluk@gmail.com>
 */
class Socket extends AbstractConnection
{
    /**
     * Connection timeout in seconds
     */
    const TIMEOUT = 5;

    /**
     * Data packet
     *
     * @var Packet
     */
    protected $packet;

    /**
     * Package string
     *
     * @var string
     */
    protected $package;

    /**
     * Constructor
     *
     * @param Config      $config Configuration
     * @param Packet|null $packet Data packet
     */
    public function __construct(Config $config, Packet $packet = null)
    {
        parent::__construct($config);

        $this->packet = $packet === null ? new Packet() : $packet;
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
        if ($this->packet->getPayload() !== $this->config->getPayload()) {
            $this->package = $this->packet
                ->setPayload($this->config->getPayload())
                ->generateChecksum()
                ->getPacketString()
            ;
        }

        // TODO: Move the logic into separated methods
        try {
            if (@$socket = socket_create(AF_INET, SOCK_RAW, 1)) {
                socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array(
                    'sec' => self::TIMEOUT,
                    'usec' => 0,
                ));
                @socket_connect($socket, $host, $this->config->getPort());
                $this->startTimer();
                @socket_send($socket, $this->package, strlen($this->package), 0);
                if (socket_read($socket, 255) !== false) {
                    $latency = $this->stopTimer();
                } else {
                    $latency = false;
                }
            } else {
                throw new \Exception('Unable to open socket');
            }
            socket_close($socket);

            $this->latency = $latency;
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
    }
}
