<?php

namespace App\Console\Commands;

use App\Mail\CustomerCreated;
use App\Services\RabbitmqService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitmqConsumeCommand extends Command
{
    protected $signature = 'rabbitmq:consume';

    protected $description = 'Получение сообщений из очереди';

    public function __construct(
        private readonly RabbitmqService $rabbitmqService
    )
    {
        parent::__construct();
    }

    public function handle()
    {
        $callback = function (AMQPMessage $msg) {
            $data = json_decode($msg->getBody(), true);
            Mail::to($data['email'])->send(new CustomerCreated($data));
        };

        $this->rabbitmqService->consume('users', $callback);
    }
}
