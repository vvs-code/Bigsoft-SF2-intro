<?php
namespace Shop\SecurityBundle\Entity;

use Shop\CommonBundle\Entity\CommonRepositoryInterface;

interface UserRepositoryInterface extends CommonRepositoryInterface
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
