<?php

namespace luklew\MyLittlePing\Connection\Socket;

/**
 * Class of ICMP packet
 *
 * @package luklew\MyLittlePing\Connection\Socket
 */
class Packet
{
    /**
     * Type of ICMP message
     * Length: 8 bits
     */
    const PACKET_TYPE = "\x08";

    /**
     * Code
     * Length: 8 bits
     */
    const PACKET_CODE = "\x00";

    /**
     * Part of header data
     * Length: 16 bits
     */
    const PACKET_IDENTIFIER = "\x00\x00";

    /**
     * Part of header data
     * Length: 16 bits
     */
    const PACKET_SEQUENCE = "\x00\x00";

    /**
     * Checksum calculated with the ICMP
     * part of packet
     * Length: 16 bits
     */
    protected $checksum = "\x00\x00";

    /**
     * Payload data sending with a ping.
     * However it cannot be empty.
     *
     * @var string
     */
    protected $payload;

    /**
     * Get all packet parts as a string
     *
     * @return string Packet
     */
    public function getPacketString()
    {
        return
            self::PACKET_TYPE .
            self::PACKET_CODE .
            $this->checksum .
            self::PACKET_IDENTIFIER .
            self::PACKET_SEQUENCE .
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
     * @param string $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }
}
