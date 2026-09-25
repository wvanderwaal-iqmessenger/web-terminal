<?php

declare(strict_types=1);

namespace MWGuerra\WebTerminal\Events;

use Illuminate\Foundation\Events\Dispatchable;
use MWGuerra\WebTerminal\Enums\ConnectionType;

/**
 * Event dispatched right before a command is executed.
 *
 * Listeners run synchronously before the command starts, so they can capture
 * state the command is about to change. Paired with CommandExecutedEvent,
 * which is dispatched once the same command has finished.
 */
class CommandStartingEvent
{
    use Dispatchable;

    /**
     * Create a new event instance.
     *
     * @param  array<string, mixed>  $metadata
     */
    public function __construct(
        public readonly string $command,
        public readonly ConnectionType $connectionType,
        public readonly ?string $userId = null,
        public readonly ?string $sessionId = null,
        public readonly ?string $ipAddress = null,
        public readonly array $metadata = [],
    ) {}
}
