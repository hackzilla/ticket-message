<?php

namespace Hackzilla\TicketMessage\Entity;

use Hackzilla\TicketMessage\Entity\Traits\TicketTrait;
use Hackzilla\TicketMessage\Model\TicketInterface;

/**
 * Ticket.
 */
class Ticket implements TicketInterface
{
    use TicketTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
