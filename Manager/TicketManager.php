<?php

namespace Hackzilla\TicketMessage\Manager;

use Hackzilla\TicketMessage\Entity\TicketMessage;
use Hackzilla\TicketMessage\Model\TicketInterface;
use Hackzilla\TicketMessage\Model\TicketMessageInterface;
use Hackzilla\TicketMessage\TicketEvents;
use Pagerfanta\Pagerfanta;

class TicketManager implements TicketManagerInterface
{
    /**
     * @var StorageManagerInterface
     */
    private $storageManager;

    /**
     * @var EventManagerInterface
     */
    private $eventManager;

    /**
     * @var TranslateManagerInterface
     */
    private $translateManager;

    /**
     * @var string
     */
    private $ticketClass;

    /**
     * @var string
     */
    private $ticketMessageClass;

    /**
     * TicketManager constructor.
     *
     * @param string $ticketClass
     * @param string $ticketMessageClass
     */
    public function __construct($ticketClass, $ticketMessageClass)
    {
        $this->ticketClass = $ticketClass;
        $this->ticketMessageClass = $ticketMessageClass;
    }

    /**
     * @param StorageManagerInterface $storageManager
     *
     * @return $this
     */
    public function setStorageManager(StorageManagerInterface $storageManager)
    {
        $this->storageManager = $storageManager;

        return $this;
    }

    /**
     * @param EventManagerInterface $eventManager
     *
     * @return $this
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;

        return $this;
    }

    /**
     * @param TranslateManagerInterface $translateManager
     *
     * @return $this
     */
    public function setTranslateManager(TranslateManagerInterface $translateManager)
    {
        $this->translateManager = $translateManager;

        return $this;
    }

    /**
     * Translate string
     *
     * @param $string
     *
     * @return string
     */
    public function translate($string)
    {
        if (!$this->translateManager) {
            return $string;
        }

        return $this->translateManager->translate($string);
    }

    /**
     * Create a new instance of Ticket entity.
     *
     * @return TicketInterface
     */
    public function createTicket()
    {
        /* @var TicketInterface $ticket */
        $ticket = new $this->ticketClass();
        $ticket->setPriority(TicketMessageInterface::PRIORITY_MEDIUM);
        $ticket->setStatus(TicketMessageInterface::STATUS_OPEN);

        $this->fireEvent(TicketEvents::TICKET_CREATE);

        return $ticket;
    }

    /**
     * Create a new instance of TicketMessage Entity.
     *
     * @param TicketInterface $ticket
     *
     * @return TicketMessageInterface
     */
    public function createMessage(TicketInterface $ticket = null)
    {
        /* @var TicketMessageInterface $message */
        $message = new $this->ticketMessageClass();

        if ($ticket) {
            $message->setPriority($ticket->getPriority());
            $message->setStatus($ticket->getStatus());
            $message->setTicket($ticket);
            $this->fireEvent(TicketEvents::TICKET_CREATE);
        } else {
            $message->setStatus(TicketMessage::STATUS_OPEN);
            $this->fireEvent(TicketEvents::TICKET_UPDATE);
        }

        return $message;
    }

    /**
     * Update or Create a Ticket in the database
     * Update or Create a TicketMessage in the database.
     *
     * @param TicketInterface        $ticket
     * @param TicketMessageInterface $message
     *
     * @return TicketInterface
     */
    public function updateTicket(TicketInterface $ticket, TicketMessageInterface $message = null)
    {
        $this->storageManager('persist', $ticket);

        if (is_null($ticket->getId())) {
            $this->storageManager('persist', $ticket);
        }

        if (!\is_null($message)) {
            $message->setTicket($ticket);
            $this->storageManager('persist', $message);
        }

        $this->storageManager('flush');

        return $ticket;
    }

    /**
     * Delete a ticket from the database.
     *
     * @param TicketInterface $ticket*
     */
    public function deleteTicket(TicketInterface $ticket)
    {
        $this->fireEvent(TicketEvents::TICKET_DELETE);

        $this->storageManager('remove', $ticket);
        $this->storageManager('flush');
    }

    /**
     * Find all tickets in the database.
     *
     * @return TicketInterface[]
     */
    public function findTickets()
    {
        return $this->storageManager('findTicketsBy', []);
    }

    /**
     * Find ticket in the database.
     *
     * @param int $ticketId
     *
     * @return TicketInterface
     */
    public function getTicketById($ticketId)
    {
        return $this->storageManager('getTicketById', $ticketId);
    }

    /**
     * Find message in the database.
     *
     * @param int $ticketMessageId
     *
     * @return TicketMessageInterface
     */
    public function getMessageById($ticketMessageId)
    {
        return $this->storageManager('getMessageById', $ticketMessageId);
    }

    /**
     * Find ticket by criteria.
     *
     * @param array $criteria
     *
     * @return TicketInterface[]
     */
    public function findTicketsBy(array $criteria)
    {
        return $this->storageManager('findTicketsBy', $criteria);
    }

    /**
     * @param int $ticketStatus
     * @param int $ticketPriority
     *
     * @return Pagerfanta
     */
    public function getTicketList($ticketStatus, $ticketPriority = null)
    {
        return $this->storageManager('getTicketList', $ticketStatus, $ticketPriority);
    }

    /**
     * @param int $days
     *
     * @return TicketInterface[]
     */
    public function getResolvedTicketOlderThan($days)
    {
        return $this->storageManager('getResolvedTicketOlderThan', $days);
    }


    /**
     * Lookup status code.
     *
     * @param string $statusStr
     *
     * @return int
     */
    public function getTicketStatus($statusStr)
    {
        static $statuses = false;

        if ($statuses === false) {
            $statuses = [];

            foreach (TicketMessageInterface::STATUSES as $id => $value) {
                $statuses[$id] = $this->translate($value);
            }
        }

        return \array_search($statusStr, $statuses);
    }

    /**
     * Lookup priority code.
     *
     * @param string $priorityStr
     *
     * @return int
     */
    public function getTicketPriority($priorityStr)
    {
        static $priorities = false;

        if ($priorities === false) {
            $priorities = [];

            foreach (TicketMessageInterface::PRIORITIES as $id => $value) {
                $priorities[$id] = $this->translate($value);
            }
        }

        return \array_search($priorityStr, $priorities);
    }

    /**
     * StorageManager wrapper
     *
     * @param string $action
     * @param array  ...$params
     *
     * @return mixed
     */
    private function storageManager($action, ...$params)
    {
        if (!$this->storageManager) {
            return;
        }

        return $this->storageManager->{$action}(...$params);
    }

    /**
     * EventManager wrapper
     *
     * @param string $event
     * @param array  ...$params
     */
    private function fireEvent($event, ...$params)
    {
        if (!$this->eventManager) {
            return;
        }

        $this->eventManager->handle($event, ...$params);
    }
}
