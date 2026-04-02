<?php

namespace App\Controllers;

use App\Libraries\RabbitMQ;

class Home extends BaseController
{
    public function index(): string
    {
        return view('landing page');

    }
    public function rabbit_send()
    {
        $data = [
            'order_id' => 12345,
            'customer_name' => 'Zerin Arif'
        ];
    
        
        //$rabbit = new RabbitMQ();
        $rabbit = new \App\Libraries\RabbitMQ();
       // $rabbit->publish('test_queue', 'Hello from CodeIgniter 4!');
        $rabbit->publish('test_queue', json_encode($data));
        $rabbit->close();

        return "Message Sent!";
    }
}
