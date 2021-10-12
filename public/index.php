<?php

require __DIR__ . '/../vendor/autoload.php';

$server = \Ratchet\Server\IoServer::factory(
    new \Ratchet\Http\HttpServer(
        new \Ratchet\WebSocket\WsServer(
            new \Andremeireles\Socket\Socket()
        )
    ),
    6060
);

$server->run();