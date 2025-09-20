<?php

namespace App\Enums;

enum EventType: string
{
    case CustomerCreated = 'customer.created';

    public function getQueues(): array
    {
        return match ($this) {
            self::CustomerCreated => [RabbitQueue::Notifications],
        };
    }
}
