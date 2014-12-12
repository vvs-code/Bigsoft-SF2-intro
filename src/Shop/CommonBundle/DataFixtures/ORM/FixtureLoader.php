<?php

namespace Shop\CommonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Shop\CommonBundle\Entity\User;


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
        $user = new User('admin', 'admin');
        $manager->persist($user);
        $user = new User('root', 'root');
        $manager->persist($user);
        $manager->flush();
    }
}
