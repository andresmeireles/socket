<?php

declare(strict_types=1);

namespace Andremeireles\Socket;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Socket implements MessageComponentInterface
{
    private \SplObjectStorage $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);

        echo sprintf('new connection! %s', $conn->resourceId) . PHP_EOL;
    }

    function onClose(ConnectionInterface $conn)
    {
        // TODO: Implement onClose() method.
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        // TODO: Implement onError() method.
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->clients as $client) {
            if ($client->resourceId === $from->resourceId) {
                continue;
            }

            $client->send(sprintf('Client %s said %s', $client->resourceId, $msg));
        }
    }
}