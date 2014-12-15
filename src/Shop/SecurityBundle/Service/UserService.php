<?php
namespace Shop\SecurityBundle\Service;

use Shop\SecurityBundle\Entity\User;
use Shop\SecurityBundle\Entity\UserRepository;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var EncoderFactoryInterface
     */
    private $encodingFactory;

    /**
     * @param UserRepository $userRep
     * @param EncoderFactoryInterface $encoderFactory
     */
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
        if (is_null($user)) {
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
        $user = new User();
        $hash = $this->hashPassword($rawPassword, $user);
        $user->setPassword($hash)
            ->setUsername($name);
        return $user;
    }

    /**
     * @inheritDoc
     */
    public function removeById($id)
    {
        $user = $this->userRepository->find($id);

        if (!($user instanceof User)) {
            throw new \Exception('No guest found for id ' . $id);
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
