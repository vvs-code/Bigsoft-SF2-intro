<?php
namespace Shop\CommonBundle\Entity;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\QueryBuilder;

interface CommonRepositoryInterface
{
    /**
     * Flush Entity Manager
     * @return void
     */
    public function flush();
}
