<?php
namespace Shop\WebSiteBundle\Service;

use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Entity\ProductRepository;

class ProductService implements ProductServiceInterface
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritDoc
     */
    public function createProduct(array $properties)
    {
        $product = new Product();
        foreach ($properties as $name => $val) {
            $setterName = 'set' . ucfirst($name);
            if (method_exists($product, $setterName)) {
                $product->$setterName($val);
            }
        }
        return $product;
    }

    /**
     * @inheritDoc
     */
    public function remove(Product $product)
    {
        $this->productRepository->remove($product)->flush();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function save(Product $product)
    {
        $this->productRepository->save($product)->flush();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPageItems($pageNum = 1, $count = 10)
    {
        return $this->findBy([], null, $count, $pageNum * $count);
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria = [], array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->productRepository->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritDoc
     */
    public function getPagination($page = 1, $limit = 10, array $options =[])
    {
        return $this->productRepository->getPagination($page, $limit, $options);
    }
}
