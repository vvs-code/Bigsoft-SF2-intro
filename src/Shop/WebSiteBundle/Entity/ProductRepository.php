<?php
namespace Shop\WebSiteBundle\Entity;

use Shop\CommonBundle\Entity\CommonRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\Paginator;

class ProductRepository extends CommonRepository
{
    /**
     * @var Paginator KnpPaginator
     */
    protected $paginator;

    /**
     * @param Paginator $paginator
     */
    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Return paganation for passed params
     * @return PaginationInterface
     */
    public function getPagination($page = 1, $limit = 10, array $options = [])
    {
        $query = $this->getEntityManager()->createQuery("SELECT p FROM WebSiteBundle:Product p");
        return $this->paginator->paginate($query, $page, $limit, $options);
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
