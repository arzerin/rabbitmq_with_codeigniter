<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use App\Libraries\RabbitMQ;

class RabbitConsumer extends BaseCommand
{
    protected $group       = 'RabbitMQ';
    protected $name        = 'rabbit:consume';
    protected $description = 'Consume RabbitMQ messages';

    public function run(array $params)
    {
        $rabbit = new RabbitMQ();

        $callback = function ($msg) {
            echo "Received: " . $msg->body . PHP_EOL;

            $data = json_decode($msg->body, true);

            $orderId = $data['order_id'] ?? null;
            $customerName = $data['customer_name'] ?? null;

            echo "Order ID: {$orderId}" . PHP_EOL;
            echo "Customer Name: {$customerName}" . PHP_EOL;
            $msg->ack();
        };
        

        $rabbit->consume('test_queue', $callback);
    }
}
