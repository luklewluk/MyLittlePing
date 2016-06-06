<?php

namespace luklew\MyLittlePing\Socket;

/**
 * Class of ICMP packet
 *
 * @package luklew\MyLittlePing
 */
class Packet
{
    /**
     * Type of ICMP message
     * Length: 8 bits
     *
     * @var string
     */
    protected $type;

    /**
     * Code
     * Length: 8 bits
     *
     * @var string
     */
    protected $code;

    /**
     * Checksum calculated with the ICMP
     * part of packet
     * Length: 16 bits
     *
     * @var string
     */
    protected $checksum;

    /**
     * Part of header data
     * Length: 16 bits
     *
     * @var string
     */
    protected $identifier;

    /**
     * Part of header data
     * Length: 16 bits
     *
     * @var string
     */
    protected $sequence;

    /**
     * Payload data sending with a ping.
     * However it cannot be empty.
     *
     * @var string
     */
    protected $payload;

    /**
     * Set Ping packet values
     */
    public function __construct()
    {
        $this->type = "\x08";
        $this->code = "\x00";
        $this->checksum = "\x00\x00";
        $this->identifier = "\x00\x00";
        $this->sequence = "\x00\x00";
        $this->payload = 'a';
    }

    /**
     * Get all packet parts as a string
     *
     * @return string
     */
    public function getPacketString()
    {
        return
            $this->type .
            $this->code .
            $this->checksum .
            $this->identifier .
            $this->sequence .
            $this->payload;
    }

    /**
     * Generate checksum for the packet
     *
     * @return Packet
     */
    public function generateChecksum()
    {
        $data = $this->getPacketString();
        if (strlen($data) % 2) {
            $data .= "\x00";
        }

        $bit = unpack('n*', $data);
        $sum = array_sum($bit);
        while ($sum >> 16) {
            $sum = ($sum >> 16) + ($sum & 0xffff);
        }

        $this->checksum = pack('n*', ~$sum);

        return $this;
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
}
