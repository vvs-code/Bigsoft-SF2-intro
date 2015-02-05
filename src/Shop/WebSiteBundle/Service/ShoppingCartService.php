<?php
namespace Shop\WebSiteBundle\Service;

use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Service\ProductService;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShoppingCartService implements ShoppingCartServiceInterface
{
    const MESSAGE_PRODUCT_NOT_FOUND = 'Unable to find Product entity #%s';
    const SESSION_CART_KEY = 'shopping_cart';

    /**
     * @var []
     */
    private $shoppingCart;

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
        $product = $this->productService->findById($id);
        if($product instanceof Product) {
            $cart = $this->getSessionCart();
            $cart[] = $id;
            $this->setSessionCart($cart);
        } else {
            throw new NotFoundHttpException(sprintf(self::MESSAGE_PRODUCT_NOT_FOUND, $id));
        }
    }

    /**
     * @return integer
     */
    public function getCartAmount()
    {
        return 'DEBUG:'.count($this->session->get($this::SESSION_CART_KEY));
    }

    /**
     * @return integer
     */
    public function getCartSum()
    {
        return 'DEBUG:1987233$';
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

    private function getSessionCart() {
        $cart = $this->session->get($this::SESSION_CART_KEY);
        if(!is_array($cart)) {
            $cart = [];
        }
        return $cart;
    }

    private function setSessionCart(array $cart) {
        $this->session->set($this::SESSION_CART_KEY, $cart);
    }
}
