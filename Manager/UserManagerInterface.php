<?php

namespace Hackzilla\TicketMessage\Manager;

use Hackzilla\TicketMessage\Model\TicketInterface;
use Hackzilla\TicketMessage\Model\UserInterface;

interface UserManagerInterface
{
    /**
     * @param string $username
     *
     * @return UserInterface|null
     */
    public function getUser($username);

    /**
     * @return int|UserInterface
     */
    public function getCurrentUser();

    /**
     * @param UserInterface $user
     *
     * @return bool
     */
    public function hasRole(UserInterface $user);

    /**
     * @param UserInterface|string $user
     * @param TicketInterface      $ticket
     */
    public function hasPermission($user, TicketInterface $ticket);
}
