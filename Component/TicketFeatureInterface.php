<?php

namespace Hackzilla\TicketMessage\Component;

interface TicketFeatureInterface
{
    /**
     * Check if feature exists and enabled.
     *
     * @param string $feature
     *
     * @return bool|null
     */
    public function hasFeature($feature);


    /**
     * enable feature.
     *
     * @param string $feature
     *
     * @return $this
     */
    public function setFeature($feature);

    /**
     * disable feature.
     *
     * @param string $feature
     *
     * @return $this
     */
    public function unsetFeature($feature);
}
