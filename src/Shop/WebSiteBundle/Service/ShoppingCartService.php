<?php
namespace Shop\WebSiteBundle\Service;

use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Service\ProductService;
use Symfony\Component\HttpFoundation\Session\Session;

class ShoppingCartService implements ShoppingCartServiceInterface
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @var Session
     */
    private $session;

    public function setProductRepository(ProductService $productService) {
        $this->productService = $productService;
    }

    /**
     * @param Session $session
     */
    public function setSession(Session $session){
        $this->session = $session;
    }

    /**
     * @param integer $id
     * @return ShoppingCartServiceInterface
     */
    public function addToCartById($id)
    {
        // TODO: Implement addToCartById() method.
    }

    /**
     * @return integer
     */
    public function getCartAmount()
    {
        // TODO: Implement getCartAmount() method.
    }

    /**
     * @return integer
     */
    public function getCartSum()
    {
        // TODO: Implement getCartSum() method.
    }

    /**
     * @return ShoppingCartServiceInterface
     */
    public function clearCart()
    {
        // TODO: Implement clearCart() method.
    }

    /**
     * @return Product[]
     */
    public function getCartProducts()
    {
        // TODO: Implement getCartProducts() method.
    }
}
