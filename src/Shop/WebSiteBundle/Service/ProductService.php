<?php
namespace Shop\WebSiteBundle\Service;

use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Entity\ProductRepository;
use Knp\Component\Pager\Paginator;

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
    public function createProduct(array $properties = [])
    {
        /**
         * @var Product
         */
        $product = new Product();

        if (!empty($properties)) {
            /**
             * @var \ReflectionClass
             */
            $reflection = new \ReflectionClass($product);
            foreach ($properties as $name => $val) {
                $setterName = 'set' . $name;
                if ($reflection->hasMethod($setterName)) {
                    $product->$setterName($val);
                }
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
     * @param $id
     * @return mixed
     */
    public function findById($id){
        $arr = $this->findBy(['id' => $id]);
        return array_shift($arr);
    }

    /**
     * @inheritDoc
     */
    public function getPagination(Paginator $paginator, $page = 1, $limit = 10, array $options = [])
    {
        return $this->productRepository->getPagination($paginator, $page, $limit, $options);
    }
}
