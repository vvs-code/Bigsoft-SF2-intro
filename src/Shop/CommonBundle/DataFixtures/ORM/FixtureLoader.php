<?php

namespace Shop\CommonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Shop\CommonBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class FixtureLoader implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $salt = 'SOME_FIXTURE_SALT';

        // создание пользователя
        $user = new User('admin', $encoder->encodePassword('admin', $salt), $salt);
        $manager->persist($user);
        $user = new User('root', $encoder->encodePassword('root', $salt), $salt);
        $manager->persist($user);
        $manager->flush();
    }
}
