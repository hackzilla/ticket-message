<?php

namespace Hackzilla\TicketMessage\Component;

class TicketFeatures implements TicketFeatureInterface
{
    const TICKET_ATTACHMENT = 'attachment';

    const FEATURES = [
        self::TICKET_ATTACHMENT => 'TICKET_ATTACHMENT',
    ];

    private $features = [];

    /**
     * @param array $features
     */
    public function __construct(array $features = [])
    {
        foreach ($features as $feature => $state) {
            $this->setFeature($feature, $state);
        }
    }

    /**
     * Check if feature exists and enabled.
     *
     * @param string $feature
     *
     * @return bool|null
     */
    public function hasFeature($feature)
    {
        $feature = strtoupper($feature);

        if (!isset($this->features[$feature])) {
            return null;
        }

        return $this->features[$feature];
    }

    /**
     * set feature state
     *
     * @param string $feature
     * @param bool   $state
     *
     * @return $this
     */
    public function setFeature($feature, $state = true)
    {
        $this->features[strtoupper($feature)] = (bool) $state;

        return $this;
    }

    /**
     * remove feature.
     *
     * @param string $feature
     *
     * @return $this
     */
    public function unsetFeature($feature)
    {
        unset($this->features[strtoupper($feature)]);

        return $this;
    }
}
