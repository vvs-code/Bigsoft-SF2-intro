<?php
namespace Shop\SecurityBundle\Service;

use Shop\SecurityBundle\Entity\User;
use Shop\SecurityBundle\Entity\UserRepository;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserService implements UserServiceInterface
{
    private $userRepository;
    private $encodingFactory;

    public function __construct(UserRepository $userRep, EncoderFactoryInterface $encoderFactory)
    {
        $this->userRepository = $userRep;
        $this->encodingFactory = $encoderFactory;
    }

    /**
     * @inheritDoc
     */
    public function hashPassword($pass, User $user = null)
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

        if (!($user instanceof User)) {
            throw new \Exception('No guest found for id '.$id);
        }

        $this->remove($user);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function remove(User $user)
    {
        $this->userRepository->remove($user)->flush();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function save(User $user)
    {
        $this->userRepository->save($user)->flush();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->userRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
}
