<?php

namespace Hackzilla\TicketMessage\Component;

use Hackzilla\TicketMessage\Model\TicketFeature\MessageAttachmentInterface;

class TicketFeatures
{
    const TICKET_ATTACHMENT = 'attachment';

    const FEATURES = [
        self::TICKET_ATTACHMENT => 'TICKET_ATTACHMENT',
    ];

    private $features;

    /**
     * @param array  $features
     * @param string $messageClass TicketMessage class
     */
    public function __construct(array $features, $messageClass)
    {
        if (!empty($features[self::TICKET_ATTACHMENT]) && !is_a($messageClass, MessageAttachmentInterface::class, true)
        ) {
            $features[self::TICKET_ATTACHMENT] = false;
        }

        $this->features = $features;
    }

    /**
     * Check if feature exists or whether enabled.
     *
     * @param $feature
     *
     * @return bool|null
     */
    public function hasFeature($feature)
    {
        if (!isset($this->features[$feature])) {
            return null;
        }

        return $this->features[$feature];
    }
}
