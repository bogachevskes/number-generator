<?php

namespace app\components;

use app\Event;

class EventDispatcher
{
    private array $eventObservers = [];
    
    public function attach(Event $event, ObserverInterface $observer): void
    {
        $this->eventObservers[$event->value] = $observer;
    }

    public function detach(Event $event): void
    {
        if (isset($this->eventObservers[$event->value]) === false) {
            return;
        }
        
        unset($this->eventObservers[$event->value]);
    }

    public function trigger(Event $event, Message $message): void
    {
        if (isset($this->eventObservers[$event->value]) === false) {
            return;
        }

        $this->eventObservers[$event->value]->observe($message);
    }
}