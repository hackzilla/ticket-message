<?php

namespace Hackzilla\TicketMessage\Entity;

use Hackzilla\TicketMessage\Entity\Traits\TicketMessageTrait;
use Hackzilla\TicketMessage\Model\TicketMessageInterface;

/**
 * Ticket Message.
 */
class TicketMessage implements TicketMessageInterface
{
    use TicketMessageTrait;

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
