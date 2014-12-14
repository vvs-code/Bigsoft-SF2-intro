<?php
namespace Shop\CommonBundle\Entity;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CommonRepositoryInterface
{
    /**
     * Flush Entity Manager
     * @return mixed
     */
    public function flush();
}
