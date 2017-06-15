<?php

namespace Hackzilla\TicketMessage\Tests\Entity;

use Hackzilla\TicketMessage\Entity\TicketMessageWithAttachment;

class TicketMessageWithAttachmentTest extends \PHPUnit_Framework_TestCase
{
    private $object;

    public function setUp()
    {
        $this->object = new TicketMessageWithAttachment();
    }

    public function tearDown()
    {
        unset($this->object);
    }

    public function testObjectCreated()
    {
        $this->assertInstanceOf(TicketMessageWithAttachment::class, $this->object);
    }
}
