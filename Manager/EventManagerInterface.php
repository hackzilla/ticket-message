<?php

namespace Hackzilla\TicketMessage\Manager;

use Hackzilla\TicketMessage\Model\TicketInterface;

interface EventManagerInterface
{
    /**
     * @param string $event
     * @param array  ...$params
     *
     * @return mixed
     */
    public function handle($event, ...$params);
}
