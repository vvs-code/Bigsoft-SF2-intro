<?php
namespace Shop\SecurityBundle\Service;

interface UserServiceInterface
{
    /**
     * Return password hash
     * @param $pass
     * @return mixed
     */
    public function hashPassword($pass);

    /**
     * Create user by name and raw pass
     * @param $name
     * @param $rawPassword
     * @return User|null
     */
    public function createUser($name, $rawPassword);
}