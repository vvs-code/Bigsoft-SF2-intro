<?php
namespace Shop\WebSiteBundle\Service;

use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Entity\ProductRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface ProductServiceInterface
{
    /**
     * Create product
     * @param array $properties
     * @return Product
     */
    public function createProduct(array $properties);

    /**
     * Remove product
     * @param Product $product
     * @return ProductServiceInterface
     */
    public function remove(Product $product);

    /**
     * Save product
     * @param Product $product
     * @return ProductServiceInterface
     */
    public function save(Product $product);

    /**
     * Finds products by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return Product[]
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * Return product for page
     * @param int $pageNum
     * @param int $count
     * @return Product[]
     */
    public function getPageItems($pageNum = 1, $count = 10);

    /**
     * @param int $page
     * @param int $limit
     * @param array $options
     * @return PaginationInterface
     */
    public function getPagination($page = 1, $limit = 10, array $options = []);
}
