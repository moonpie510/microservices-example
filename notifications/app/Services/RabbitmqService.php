<?php

namespace App\Services;

use App\Enums\EventType;
use App\Enums\RabbitQueue;
use App\Mail\CustomerCreated;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitmqService
{
    private string $host;
    private string $port;
    private string $user;
    private string $password;
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;
    private string $exchangeName = 'microservices_example';

    public function __construct()
    {
        $this->host = config('rabbitmq.host');
        $this->port = config('rabbitmq.port');
        $this->user = config('rabbitmq.user');
        $this->password = config('rabbitmq.password');

        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password);

        $this->channel = $this->connection->channel();
        $this->channel->exchange_declare($this->exchangeName, 'direct', false, true, false);
    }

    public function publish(EventType $eventType, string $message): void
    {
        foreach ($eventType->getQueues() as $queue) {
            /** @var RabbitQueue $queue */
            $this->channel->queue_declare($queue->value, false, true, false, false);
            $this->channel->queue_bind($queue->value, $this->exchangeName, $eventType->value);
        }

        $message = new AMQPMessage($message);
        $this->channel->basic_publish($message, $this->exchangeName, $eventType->value);

        $this->channel->close();
        $this->connection->close();
    }

    public function consumeNotificationsQueue(): void
    {
        $callback = function (AMQPMessage $msg) {
            $data = json_decode($msg->getBody(), true);
            Mail::to($data['email'])->send(new CustomerCreated($data));
        };

        $this->channel->basic_consume(RabbitQueue::Notifications->value, '', false, true, false, false, $callback);

        while ($this->channel->is_open()) {
            $this->channel->wait();
        }
    }
}
