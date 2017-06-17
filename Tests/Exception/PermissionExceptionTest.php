<?php

namespace Hackzilla\TicketMessage\Tests\Exception;

use Hackzilla\TicketMessage\Exception\PermissionException;

class PermissionExceptionTest extends \PHPUnit\Framework\TestCase
{
    private $object;

    public function setUp()
    {
        $this->object = new PermissionException();
    }

    public function tearDown()
    {
        unset($this->object);
    }

    public function testObjectCreated()
    {
        $this->assertInstanceOf(PermissionException::class, $this->object);
        $this->assertInstanceOf(\Exception::class, $this->object);
    }
}
