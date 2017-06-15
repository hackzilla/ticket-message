<?php

namespace Hackzilla\TicketMessage\Manager;

use Hackzilla\TicketMessage\Model\TicketInterface;
use Hackzilla\TicketMessage\Model\UserInterface;

interface UserManagerInterface
{
    /**
     * @return int|UserInterface
     */
    public function getCurrentUser();

    /**
     * @param int $userId
     *
     * @return UserInterface|null
     */
    public function getUserById($userId);

    /**
     * @param UserInterface $user
     * @param string        $role
     *
     * @return bool
     */
    public function hasRole(UserInterface $user, $role);

    /**
     * @param \Hackzilla\TicketMessage\Model\UserInterface|string $user
     * @param TicketInterface                                     $ticket
     */
    public function hasPermission($user, TicketInterface $ticket);
}
