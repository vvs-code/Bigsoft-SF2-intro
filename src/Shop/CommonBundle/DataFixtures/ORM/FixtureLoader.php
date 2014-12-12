<?php

namespace Shop\CommonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Shop\CommonBundle\Entity\User;
use Shop\CommonBundle\Entity\Role;


class FixtureLoader implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        // создание пользователя
        $adminRole = new Role();
        $adminRole->setName('ROLE_ADMIN');
        $manager->persist($adminRole);
        $userRole = new Role();
        $userRole->setName('ROLE_USER');
        $manager->persist($userRole);
        $user = new User('admin', 'admin');
        $user->getUserRoles()->add($userRole);
        $user->getUserRoles()->add($adminRole);
        $manager->persist($user);

        $userRole = new Role();
        $userRole->setName('ROLE_USER');
        $manager->persist($userRole);
        $user = new User('user', 'user');
        $user->getUserRoles()->add($userRole);
        $manager->persist($user);
        $manager->flush();
    }
}
