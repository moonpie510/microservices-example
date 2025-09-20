<?php

namespace App\Console\Commands;

use App\Services\RabbitmqService;
use Illuminate\Console\Command;

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

    public function handle(): void
    {
        $this->info('Получение сообщений из очереди ...');
        $this->info('Для остановки нажмите Ctrl+C');

        $this->rabbitmqService->consumeNotificationsQueue();
    }
}
