<?php
namespace Shop\CommonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Shop\SecurityBundle\Entity\User;
use Shop\SecurityBundle\Service\UserServiceInterface;
use Shop\SecurityBundle\Entity\Role;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FixtureLoader implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        /**
         * @var UserServiceInterface
         */
        $userService =  $this->container->get('shop.security.user_service');

        // создание пользователя
        $adminRole = new Role();
        $adminRole->setName('ROLE_ADMIN');
        $manager->persist($adminRole);
        $userRole = new Role();
        $userRole->setName('ROLE_USER');
        $manager->persist($userRole);
        $user = $userService->createUser('admin', 'admin');
        $user->getUserRoles()->add($userRole);
        $user->getUserRoles()->add($adminRole);
        $manager->persist($user);

        $userRole = new Role();
        $userRole->setName('ROLE_USER');
        $manager->persist($userRole);
        $user = $userService->createUser('user', 'user');
        $user->getUserRoles()->add($userRole);
        $manager->persist($user);
        $manager->flush();
    }
}
