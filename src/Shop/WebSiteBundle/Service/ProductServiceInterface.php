<?php
namespace Shop\WebSiteBundle\Service\ProductService;

use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Entity\ProductRepository;

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

}
