<?php

namespace Hackzilla\TicketMessage\Model;

interface UserInterface
{
    public function getId();

    public function getUsername();

    public function getEmail();
}
