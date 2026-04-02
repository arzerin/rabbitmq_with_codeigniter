<?php

namespace App\Libraries;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQ
{
    protected $connection;
    protected $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            'localhost', // host
            5672,        // port
            'guest',     // username
            'guest'      // password
        );

        $this->channel = $this->connection->channel();
    }

    public function publish($queue, $message)
    {
        $this->channel->queue_declare($queue, false, true, false, false);

        $msg = new AMQPMessage(
            $message,
            ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]
        );

        $this->channel->basic_publish($msg, '', $queue);
    }

    public function consume($queue, $callback)
    {
        $this->channel->queue_declare($queue, false, true, false, false);

        $this->channel->basic_consume($queue, '', false, true, false, false, $callback);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
