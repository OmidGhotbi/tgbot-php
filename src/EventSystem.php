<?php

namespace Pathetic\TgBot;

use Closure;
use Pathetic\TgBot\Types\Message;

class EventSystem
{
    /**
     * Array of event arrays.
     * 
     * @var array
     */
    protected $events;
    
    /**
     * @param \Closure|null $check
     * @param \Closure      $event
     * 
     * @return \Pathetic\TgBot\EventSystem
     */
    public function add($check, Closure $event)
    {
        $this->events[] = ['check' => $check, 'action' => $event];
        
        return $this;
    }
    
    /**
     * @param \Pathetic\TgBot\Types\Message $message
     */
    public function handle(Message $message)
    {
        foreach ($this->events as $event) {
            if (null === $event['check'] || is_callable($event['check']) && $event['check']($message)) {
                if (false === $event['action']($message)) {
                    break;
                }
            }
        }
    }
}
