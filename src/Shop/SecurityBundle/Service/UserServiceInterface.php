<?php
namespace Shop\SecurityBundle\Service;

use Shop\SecurityBundle\Entity\User;

interface UserServiceInterface
{
    /**
     * Return password hash
     * @param string $pass
     * @param User $user, default = null
     * @return mixed
     */
    public function hashPassword($pass, User $user = null);

    /**
     * Create user by name and raw pass
     * @param string $name
     * @param string $rawPassword
     * @return User|null
     */
    public function createUser($name, $rawPassword);

    /**
     * Remove user by userId
     * @param int $id
     * @return void
     */
    public function deleteById($id);

    /**
     * Remove passed user
     * @param User $user
     * @return $this
     */
    public function remove(User $user);

    /**
     * Save passed user
     * @param User $user
     * @return $this
     */
    public function save(User $user);

    /**
     * Finds users by a set of criteria.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return User[]
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
}
