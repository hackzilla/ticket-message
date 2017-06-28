<?php

namespace Hackzilla\TicketMessage\Manager;

use Hackzilla\TicketMessage\Model\Pagination;
use Hackzilla\TicketMessage\Model\TicketInterface;
use Hackzilla\TicketMessage\Model\TicketMessageInterface;
use Pagerfanta\Pagerfanta;

interface TicketManagerInterface
{
    /**
     * Create a new instance of Ticket entity.
     *
     * @return TicketInterface
     */
    public function createTicket();

    /**
     * Create a new instance of TicketMessage Entity.
     *
     * @param TicketInterface $ticket
     *
     * @return TicketMessageInterface
     */
    public function createMessage(TicketInterface $ticket = null);

    /**
     * Update or Create a Ticket in the database
     * Update or Create a TicketMessage in the database.
     *
     * @param TicketInterface        $ticket
     * @param TicketMessageInterface $message
     *
     * @return TicketInterface
     */
    public function updateTicket(TicketInterface $ticket, TicketMessageInterface $message = null);

    /**
     * Delete a ticket from the database.
     *
     * @param TicketInterface $ticket*
     */
    public function deleteTicket(TicketInterface $ticket);

    /**
     * Find ticket in the database.
     *
     * @param int $ticketId
     *
     * @return TicketInterface
     */
    public function getTicketById($ticketId);

    /**
     * Find message in the database.
     *
     * @param int $ticketMessageId
     *
     * @return TicketMessageInterface
     */
    public function getMessageById($ticketMessageId);

    /**
     * Find all tickets in the database.
     *
     * @return TicketInterface[]
     */
    public function findTickets();

    /**
     * Find ticket by criteria.
     *
     * @param array $criteria
     *
     * @return TicketInterface[]
     */
    public function findTicketsBy(array $criteria);

    /**
     * @param int $ticketStatus
     * @param int $ticketPriority
     *
     * @return Pagerfanta
     */
    public function getTicketList($ticketStatus, $ticketPriority = null);

    /**
     * @param int $days
     *
     * @return mixed
     */
    public function getResolvedTicketOlderThan($days);
    
    /**
     * Lookup status code.
     *
     * @param string $statusStr
     *
     * @return int
     */
    public function getTicketStatus($statusStr);

    /**
     * Lookup priority code.
     *
     * @param string $priorityStr
     *
     * @return int
     */
    public function getTicketPriority($priorityStr);
}
