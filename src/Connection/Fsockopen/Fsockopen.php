<?php

namespace luklew\MyLittlePing\Connection\Fsockopen;

use luklew\MyLittlePing\Connection\AbstractConnection;

/**
 * Fsockopen implementation of connection
 *
 * Basic support of this method added as an example.
 * It's not recommended way to get the actual latency.
 *
 * @package luklew\MyLittlePing
 * @author  Lukasz Lewandowski <luklewluk@gmail.com>
 */
class Fsockopen extends AbstractConnection
{
    /**
     * {@inheritdoc}
     *
     * @param string $host Host address or domain
     *
     * @return void
     */
    public function ping($host)
    {
        $this->startTimer();
        $fp = @fsockopen($host, $this->config->getPort(), $errNo, $errStr, 5);

        if ($fp === false) {
            $this->latency = false;
            $this->errorMessage = [
                'errNo'  => $errNo,
                'errStr' => $errStr,
            ];
        } else {
            $this->latency = $this->stopTimer();
        }
    }
}
