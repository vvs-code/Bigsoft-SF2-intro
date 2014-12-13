<?php
namespace Shop\SecurityBundle\Service;

use Doctrine\ORM\EntityRepository;
use Shop\CommonBundle\Entity\User;
use Shop\CommonBundle\Entity\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class UserService implements UserServiceInterface
{
    const SALT = 'SOME_SALT';
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRep)
    {
        $this->userRepository = $userRep;
    }


    /**
     * Return password hash
     * @param $pass
     * @return mixed
     */
    public function hashPassword($pass)
    {
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        return $encoder->encodePassword($pass, static::SALT);
    }

    /**
     * Create user by name and raw pass
     * @param $name
     * @param $rawPassword
     * @return User|null
     */
    public function createUser($name, $rawPassword)
    {
        $hash = $this->hashPassword($rawPassword);
        return new User($name, $rawPassword);
    }
}
