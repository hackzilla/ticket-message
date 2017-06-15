<?php

namespace Hackzilla\TicketMessage\Tests\Entity;

use Hackzilla\TicketMessage\Entity\Ticket;
use Hackzilla\TicketMessage\Model\TicketMessageInterface;

class TicketTest extends \PHPUnit_Framework_TestCase
{
    private $object;

    public function setUp()
    {
        $this->object = new Ticket();
    }

    public function tearDown()
    {
        unset($this->object);
    }

    public function testObjectCreated()
    {
        $this->assertInstanceOf(Ticket::class, $this->object);
    }

    public function testStatus()
    {
        $this->object->setStatus(TicketMessageInterface::STATUS_INVALID);
        $this->assertSame(TicketMessageInterface::STATUS_INVALID, $this->object->getStatus());
    }
}
