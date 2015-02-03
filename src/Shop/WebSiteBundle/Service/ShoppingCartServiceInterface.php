<?php
namespace Shop\WebSiteBundle\Service;

use Shop\WebSiteBundle\Entity\Product;

interface ShoppingCartServiceInterface
{
    /**
     * @param integer $id
     * @return ShoppingCartServiceInterface
     */
    public function addToCartById($id);

    /**
     * @return integer
     */
    public function getCartAmount();

    /**
     * @return integer
     */
    public function getCartSum();

    /**
     * @return ShoppingCartServiceInterface
     */
    public function clearCart();

    /**
     * @return Product[]
     */
    public function getCartProducts();
}
