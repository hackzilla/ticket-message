<?php

namespace Hackzilla\TicketMessage\Manager;

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
