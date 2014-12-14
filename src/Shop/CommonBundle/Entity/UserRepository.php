<?php
namespace Shop\CommonBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @inheritDoc
     */
    public function remove(User $user){
        $em = $this->getEntityManager();
        $em->remove($user);
        $em->flush();
    }

    /**
     * Save user
     * @param User $user
     * @return mixed
     */
    public function save(User $user)
    {
        $em = $this->getEntityManager();
        $em->persist($user);
        return $em->flush();
    }
}
