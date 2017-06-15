<?php

namespace Hackzilla\TicketMessage\Manager;

interface StorageManagerInterface
{
    public function persist($entity);

    public function remove($entity);

    public function flush();



    public function getTicketById($ticketId);

    public function getMessageById($ticketMessageId);

    public function findTickets();

    public function findTicketsBy(array $criteria);

    /**
     * @param int $ticketStatus
     * @param int $ticketPriority
     *
     * @return TicketInterface[]
     */
    public function getTicketList($ticketStatus, $ticketPriority = null);

    /**
     * @param int $days
     *
     * @return TicketInterface[]
     */
    public function getResolvedTicketOlderThan($days);
}
