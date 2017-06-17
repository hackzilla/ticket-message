<?php

namespace Hackzilla\TicketMessage\Tests\Extension;

use Hackzilla\TicketMessage\Component\TicketFeatureInterface;
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
    public function testConstruct($features)
    {
        $obj = new TicketFeatures($features);

        $this->assertInstanceOf(TicketFeatureInterface::class, $obj);

        foreach ($features as $feature) {
            $this->assertTrue($obj->hasFeature($feature));
        }

        $this->assertNull($obj->hasFeature('NOT_VALID_FEATURE'));
    }

    public function constructProvider()
    {
        return [
            [ [] ],
            [ ['A', 'B', 'C'] ],
        ];
    }
}
