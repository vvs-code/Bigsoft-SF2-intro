<?php
namespace Shop\WebSiteBundle\Entity;

use Shop\CommonBundle\Entity\CommonRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\Paginator;

class ProductRepository extends CommonRepository
{
    /**
     * Return paganation for passed params
     * @param Paginator $paginator
     * @param int $page
     * @param int $limit
     * @param array $options
     * @return PaginationInterface
     */
    public function getPagination(Paginator $paginator, $page = 1, $limit = 10, array $options = [])
    {
        $query = $this->getEntityManager()->createQuery("SELECT p FROM WebSiteBundle:Product p");
        return $paginator->paginate($query, $page, $limit, $options);
    }

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
