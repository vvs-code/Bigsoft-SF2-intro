<?php
namespace Shop\WebSiteBundle\Twig;

use Shop\WebSiteBundle\Service\ShoppingCartService;

class ShoppingCartExtension extends \Twig_Extension
{
    /**
     * @var ShoppingCartService
     */
    private $shoppingCartService;

    /**
     * @param ShoppingCartService $shoppingCartService
     */
    public function setShoppingCartService(ShoppingCartService $shoppingCartService)
    {
        $this->shoppingCartService = $shoppingCartService;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('price', [$this, 'priceFilter']),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            'shopping_cart_amount' => new \Twig_Function_Method($this, 'shoppingCartAmount'),
            'shopping_cart_sum' => new \Twig_Function_Method($this, 'shoppingCartSum')
        ];
    }

    /**
     * @return int
     */
    public function shoppingCartAmount()
    {
        return $this->shoppingCartService->getCartAmount();
    }

    /**
     * @return int
     */
    public function shoppingCartSum()
    {
        return $this->shoppingCartService->getCartSum();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'shopping_cart';
    }
}
