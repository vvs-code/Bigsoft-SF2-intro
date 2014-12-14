<?php
namespace Shop\SecurityBundle\Service;

use Shop\CommonBundle\Entity\User;
use Shop\CommonBundle\Entity\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserService implements UserServiceInterface
{
    private $userRepository;
    private $encodingFactory;

    public function __construct(UserRepositoryInterface $userRep, EncoderFactoryInterface $encoderFactory)
    {
        $this->userRepository = $userRep;
        $this->encodingFactory = $encoderFactory;
    }

    /**
     * @inheritDoc
     */
    public function hashPassword($pass, $user = null)
    {
        if(is_null($user)){
            $user = new User();
        }
        $encoder = $this->encodingFactory->getEncoder($user);
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
            throw new \Exception('No guest found for id '.$id);
        }

        return $this->remove($user);
    }

    /**
     * @inheritDoc
     */
    public function remove(User $user)
    {
        return $this->userRepository->remove($user)->flush();
    }

    /**
     * @inheritDoc
     */
    public function save(User $user)
    {
        return $this->userRepository->save($user)->flush();
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->userRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
}
