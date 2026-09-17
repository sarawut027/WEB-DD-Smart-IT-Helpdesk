<?php
namespace App\Core;

class EventDispatcher
{
    private array $listeners = [];

    public function listen(string $eventName, callable $handler): void
    {
        $this->listeners[$eventName][] = $handler;
    }

    public function dispatch(string $eventName, array $payload = []): void
    {
        if (isset($this->listeners[$eventName])) {
            foreach ($this->listeners[$eventName] as $handler) {
                call_user_func($handler, $payload);
            }
        }
    }
}