<?php
namespace Shop\SecurityBundle\Service;

use Shop\CommonBundle\Entity\User;
use Shop\CommonBundle\Entity\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRep)
    {
        $this->userRepository = $userRep;
    }

    /**
     * @inheritDoc
     */
    public function hashPassword($pass)
    {
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        return $encoder->encodePassword($pass, User::SALT);
    }

    /**
     * @inheritDoc
     */
    public function createUser($name, $rawPassword)
    {
        $hash = $this->hashPassword($rawPassword);
        $user = new User();
        $user->setPassword($hash)
            ->setUsername($name);
        return $user;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('No guest found for id '.$id);
        }

        return $this->remove($user);
    }

    /**
     * @inheritDoc
     */
    public function remove(User $user)
    {
        return $this->userRepository->remove($user);
    }

    /**
     * @inheritDoc
     */
    public function save(User $user)
    {
        return $this->userRepository->save($user);
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->userRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
}
