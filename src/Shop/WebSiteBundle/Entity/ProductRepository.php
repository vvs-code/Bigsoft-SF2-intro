<?php
namespace Shop\WebSiteBundle\Entity;

use Shop\CommonBundle\Entity\CommonRepository;

class ProductRepository extends CommonRepository
{
    /**
     * Remove user
     * @param Product $product
     * @return ProductRepository
     */
    public function remove(Product $product)
    {
        $em = $this->getEntityManager();
        $em->remove($product);
        return $this;
    }

    /**
     * Save user
     * @param Product $product
     * @return ProductRepository
     */
    public function save(Product $product)
    {
        $em = $this->getEntityManager();
        $em->persist($product);
        return $this;
    }
}
