<?php
namespace Shop\CommonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Shop\SecurityBundle\Entity\User;
use Shop\SecurityBundle\Service\UserServiceInterface;
use Shop\SecurityBundle\Entity\Role;
use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Service\ProductService;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class FixtureLoader implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var Serializer
     */
    private $serializer;

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
        $this->manager = $manager;

        $encoders = ['xml' => new XmlEncoder(), 'json' => new JsonEncoder()];
        $normalizers = [new GetSetMethodNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);

        $this->loadUsers();
        $this->loadProducts();
    }

    /**
     * Load products fixtures
     */
    private function loadProducts() {
        // Load fake items from txt file
        $fileName = $this->container->getParameter('shop.common.fixtures_path').'products.json';
        $json = file_get_contents($fileName);
        $products = $this->serializer->deserialize($json, 'Shop\WebSiteBundle\Entity\Product', 'json');

        foreach($products as $product){
            $this->manager->persist($product);
        }

        $this->manager->flush();
    }

    /**
     * Load users fixtures
     */
    private function loadUsers() {
        /**
         * @var UserServiceInterface
         */
        $userService = $this->container->get('shop.security.user_service');

        // создание пользователя
        $adminRole = new Role();
        $adminRole->setName('ROLE_ADMIN');
        $this->manager->persist($adminRole);
        $userRole = new Role();
        $userRole->setName('ROLE_USER');
        $this->manager->persist($userRole);
        $user = $userService->createUser('admin', 'admin');
        $user->getUserRoles()->add($userRole);
        $user->getUserRoles()->add($adminRole);
        $this->manager->persist($user);

        $userRole = new Role();
        $userRole->setName('ROLE_USER');
        $this->manager->persist($userRole);
        $user = $userService->createUser('user', 'user');
        $user->getUserRoles()->add($userRole);
        $this->manager->persist($user);

        $this->manager->flush();
    }
}
