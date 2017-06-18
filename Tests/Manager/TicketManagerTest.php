<?php

namespace Hackzilla\TicketMessage\Tests\User;

use Doctrine\ORM\EntityRepository;
use Hackzilla\TicketMessage\Manager\TicketManager;
use Hackzilla\TicketMessage\Model\TicketInterface;
use Hackzilla\TicketMessage\Model\TicketMessageInterface;

class TicketManagerTest extends \PHPUnit\Framework\TestCase
{
    /** @var TicketManager */
    private $manager;

    public function setUp()
    {
        $this->manager = new TicketManager(
            "\\Hackzilla\\TicketMessage\\Entity\\Ticket",
            "\\Hackzilla\\TicketMessage\\Entity\\TicketMessage"
        );
    }

    public function testCreate()
    {
        $ticket = $this->manager->createTicket();

        $this->assertInstanceOf(TicketInterface::class, $ticket);

        $messsage = $this->manager->createMessage($ticket);
        $this->assertInstanceOf(TicketMessageInterface::class, $messsage);
        $this->assertInstanceOf(TicketInterface::class, $messsage->getTicket());

        $messsage = $this->manager->createMessage();
        $this->assertInstanceOf(TicketMessageInterface::class, $messsage);
        $this->assertNull($messsage->getTicket());
    }

    public function tearDown()
    {
        unset($this->manager);
    }
}
