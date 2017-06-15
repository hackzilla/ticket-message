<?php

namespace Hackzilla\TicketMessage\Model;

interface UserInterface extends \Symfony\Component\Security\Core\User\UserInterface
{
    public function getId();

    public function getUsername();

    public function getEmail();
}
