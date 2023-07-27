<?php
// chat_server.php

// Enable PHP WebSocket server
require 'vendor/autoload.php';
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class Chat implements MessageComponentInterface {
    private $clients;
    private $chatHistory;

    public function __construct() {
        $this->clients = new \SplObjectStorage();
        $this->chatHistory = array();
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        // Send chat history to the newly connected client
        foreach ($this->chatHistory as $message) {
            $conn->send($message);
        }
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $this->chatHistory[] = $msg;
        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    9000
);
$server->run();
