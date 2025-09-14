<?php

use Illuminate\Support\Facades\Route;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

Route::get('/', function () {
//    $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
//    $channel = $connection->channel();
//
//    $channel->queue_declare('hello', false, false, false, false);
//
//    $msg = new AMQPMessage('Hello World!');
//    $channel->basic_publish($msg, '', 'hello');
//
//    $channel->close();
//    $connection->close();

    $service = new \App\Services\RabbitmqService();
//    $service->setQueue('hello888', 'darova')->publish('new massage');

//    $callback = function (AMQPMessage $msg) {
//        dd($msg->getBody());
//    };
//
//    $service->consume('hello888', $callback);
});
