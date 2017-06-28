<?php

namespace Hackzilla\TicketMessage\Manager;

/**
 * Interface TranslateManagerInterface
 *
 * @package Hackzilla\TicketMessage\Manager
 */
interface TranslateManagerInterface
{
    /**
     * @param $string
     *
     * @return string
     */
    public function translate($string);
}
