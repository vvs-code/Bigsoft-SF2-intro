<?php

namespace Shop\CommonBundle\Entity;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UserRepositoryInterface extends ObjectRepository, Selectable
{
    /**
     * Remove passed user
     * @param User $user
     * @return mixed
     */
    public function remove(User $user);

    /**
     * Save user
     * @param User $user
     * @return mixed
     */
    public function save(User $user);
}
