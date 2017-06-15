<?php

namespace Hackzilla\TicketMessage\Tests\Entity;

use Hackzilla\TicketMessage\Entity\TicketMessage;

class TicketMessageTest extends \PHPUnit_Framework_TestCase
{
    private $object;

    public function setUp()
    {
        $this->object = new TicketMessage();
    }

    public function tearDown()
    {
        unset($this->object);
    }

    public function testObjectCreated()
    {
        $this->assertInstanceOf(TicketMessage::class, $this->object);
    }
}
