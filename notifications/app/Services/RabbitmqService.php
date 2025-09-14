<?php

namespace App\Services;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitmqService
{
    private string $host;
    private string $port;
    private string $user;
    private string $password;

    private ?AMQPStreamConnection $connection = null;
    private ?AMQPChannel $channel = null;

    private string $queueName;
    private string $routingKey;
    private string $exchangeName = 'laravel';

    public function __construct()
    {
        $this->host = config('rabbitmq.host');
        $this->port = config('rabbitmq.port');
        $this->user = config('rabbitmq.user');
        $this->password = config('rabbitmq.password');

        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password);

        $this->channel = $this->connection->channel();
        $this->channel->basic_qos(0, 1, false);
        $this->channel->exchange_declare($this->exchangeName, 'direct', false, true, false);
    }

    public function setQueue(string $queue, string $routingKey): static
    {
        $this->queueName = $queue;
        $this->routingKey = $routingKey;

        $this->channel->queue_declare($queue, false, true, false, false);
        $this->channel->queue_bind($queue, $this->exchangeName, $routingKey);

        return $this;
    }

    public function publish(string $message): void
    {
        if (empty($this->queueName || $this->routingKey)) {
            throw new \Exception('Сначала создайте очередь через метод setQueue');
        }

        $message = new AMQPMessage($message);

        $this->channel->basic_publish($message, $this->exchangeName, $this->routingKey);

        $this->channel->close();
        $this->connection->close();
    }

    public function consume(string $queue, callable $callback): void
    {
        $this->channel->basic_consume($queue, '', false, true, false, false, $callback);

        while ($this->channel->is_open()) {
            $this->channel->wait();
        }
    }
}
