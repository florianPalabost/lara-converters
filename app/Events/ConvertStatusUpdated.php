<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConvertStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected string $message;

    /**
     * Create a new event instance.
     */
    public function __construct(array $payload)
    {
        $this->message = $payload['message'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('convert-status-updated'),
        ];
    }
}
