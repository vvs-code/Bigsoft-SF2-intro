<?php
namespace Shop\SecurityBundle\Service;

use Doctrine\ORM\EntityRepository;
use Shop\CommonBundle\Entity;

class UserService
{
    private $userRepository;

    public function __construct(Entity\UserRepositoryInterface $userRep)
    {
        $this->userRepository = $userRep;
    }
}
