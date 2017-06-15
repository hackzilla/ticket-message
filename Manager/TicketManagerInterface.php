<?php

namespace Hackzilla\TicketMessage\Manager;

use Hackzilla\TicketMessage\Model\TicketInterface;
use Hackzilla\TicketMessage\Model\TicketMessageInterface;

interface TicketManagerInterface
{
    public function createTicket();

    public function createMessage(TicketInterface $ticket = null);

    public function updateTicket(TicketInterface $ticket, TicketMessageInterface $message = null);

    public function deleteTicket(TicketInterface $ticket);

    public function getTicketById($ticketId);

    public function getMessageById($ticketMessageId);

    public function findTickets();

    public function findTicketsBy(array $criteria);

    /**
     * @param UserManagerInterface $userManager
     * @param int                  $ticketStatus
     * @param int                  $ticketPriority
     *
     * @return mixed
     */
    public function getTicketList(UserManagerInterface $userManager, $ticketStatus, $ticketPriority = null);

    /**
     * @param int $days
     *
     * @return mixed
     */
    public function getResolvedTicketOlderThan($days);
}
