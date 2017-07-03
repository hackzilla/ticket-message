<?php

namespace Hackzilla\TicketMessage\Manager;

use Pagerfanta\Pagerfanta;

interface StorageManagerInterface
{
    public function persist($entity);

    public function remove($entity);

    public function flush();


    public function getTicketById($ticketId);

    public function getMessageById($ticketMessageId);

    /**
     * Finds tickets by a set of criteria.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return TicketInterface[]
     */
    public function findTicketsBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param int   $ticketStatus
     * @param int   $ticketPriority
     * @param array $orderBy field as the key and direction as the value
     *
     * @return Pagerfanta
     */
    public function getTicketList($ticketStatus, $ticketPriority = null, array $orderBy = null);

    /**
     * @param int $days
     *
     * @return TicketInterface[]
     */
    public function getResolvedTicketOlderThan($days);

    /**
     * List of fields for which the ticket list can be ordered by
     *
     * @return string[]
     */
    public function getSortableFields();
}
