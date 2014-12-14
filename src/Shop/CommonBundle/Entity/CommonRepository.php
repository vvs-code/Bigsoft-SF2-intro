<?php
namespace Shop\CommonBundle\Entity;

use Doctrine\ORM\EntityRepository;

abstract class CommonRepository  extends EntityRepository implements CommonRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }
} 
