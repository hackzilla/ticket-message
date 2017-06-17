<?php

namespace Hackzilla\TicketMessage\Tests\Entity;

use Hackzilla\TicketMessage\Entity\TicketWithAttachment;

class TicketWithAttachmentTest extends \PHPUnit\Framework\TestCase
{
    private $object;

    public function setUp()
    {
        $this->object = new TicketWithAttachment();
    }

    public function tearDown()
    {
        unset($this->object);
    }

    public function testObjectCreated()
    {
        $this->assertInstanceOf(TicketWithAttachment::class, $this->object);
    }
}
