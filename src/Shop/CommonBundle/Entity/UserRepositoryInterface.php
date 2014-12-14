<?php
namespace Shop\CommonBundle\Entity;

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
