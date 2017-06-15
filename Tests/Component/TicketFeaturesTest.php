<?php

namespace Hackzilla\TicketMessage\Tests\Extension;

use Hackzilla\TicketMessage\Component\TicketFeatures;
use Hackzilla\TicketMessage\Entity\TicketMessage;
use Hackzilla\TicketMessage\Entity\TicketMessageWithAttachment;

class TicketFeaturesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider constructProvider
     *
     * @param array  $features
     * @param string $class
     */
    public function testConstruct($features, $class)
    {
        $obj = new TicketFeatures($features, $class);

        $this->assertInstanceOf(TicketFeatures::class, $obj);
    }

    public function constructProvider()
    {
        return [
            [[], '\stdClass'],
        ];
    }

    /**
     * @dataProvider featureAttachmentProvider
     *
     * @param array     $features
     * @param string    $class
     * @param bool|null $compare
     */
    public function testFeatureAttachment($features, $class, $compare)
    {
        $obj = new TicketFeatures($features, $class);

        $this->assertInstanceOf(TicketFeatures::class, $obj);
        $this->assertEquals($obj->hasFeature('attachment'), $compare);
    }

    public function featureAttachmentProvider()
    {
        return [
            [[], TicketMessage::class, null],
            [['attachment' => true], TicketMessage::class, false],
            [['attachment' => true], TicketMessageWithAttachment::class, true],
        ];
    }
}
