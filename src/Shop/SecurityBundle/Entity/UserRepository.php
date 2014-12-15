<?php
namespace Shop\SecurityBundle\Entity;

use Shop\CommonBundle\Entity\CommonRepository;

class UserRepository extends CommonRepository
{
    /**
     * @inheritDoc
     */
    public function remove(User $user)
    {
        $em = $this->getEntityManager();
        $em->remove($user);
        return $this;
    }

    /**
     * Save user
     * @param User $user
     * @return UserRepository
     */
    public function save(User $user)
    {
        $em = $this->getEntityManager();
        $em->persist($user);
        return $this;
    }
}
