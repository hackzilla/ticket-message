<?php

namespace Hackzilla\TicketMessage\Entity;

use Hackzilla\TicketMessage\Entity\Traits\TicketFeature\MessageAttachmentTrait;
use Hackzilla\TicketMessage\Entity\Traits\TicketMessageTrait;
use Hackzilla\TicketMessage\Model\TicketFeature\MessageAttachmentInterface;
use Hackzilla\TicketMessage\Model\TicketMessageInterface;

/**
 * Ticket Message.
 */
class TicketMessageWithAttachment implements TicketMessageInterface, MessageAttachmentInterface
{
    use TicketMessageTrait;
    use MessageAttachmentTrait;

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
