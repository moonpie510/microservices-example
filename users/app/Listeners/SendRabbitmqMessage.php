<?php

namespace App\Listeners;

use App\Events\CustomerCreated;
use App\Services\RabbitmqService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRabbitmqMessage
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly RabbitmqService $rabbitmqService,
    )
    {}

    /**
     * Handle the event.
     */
    public function handle(CustomerCreated $event): void
    {
        $this->rabbitmqService->setQueue('users', 'user-created')->publish($event->customerData->toJson());
    }
}
