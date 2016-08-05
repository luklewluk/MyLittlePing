<?php

namespace luklew\MyLittlePing\Connection\Socket;

use luklew\Connection\AbstractConnection;
use luklew\MyLittlePing\Config;

/**
 * Socket implementation of connection
 *
 * @package luklew\MyLittlePing\Connection\Socket
 */
class Socket extends AbstractConnection
{
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
        // TODO: IF added temporary due to issue that disallows generate checksum twice
        if ($this->package === null) {
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
                    'sec' => 10,
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
