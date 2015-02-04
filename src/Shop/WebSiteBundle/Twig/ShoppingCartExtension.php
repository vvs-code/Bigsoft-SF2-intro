<?php
namespace Shop\WebSiteBundle\Twig;

class ShoppingCartExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions() {
        return array(
            'shopping_cart_amount' => new \Twig_Function_Method($this, 'shoppingCartAmount'),
            'shopping_cart_sum' => new \Twig_Function_Method($this, 'shoppingCartSum')
        );
    }

    /**
     * @return int
     */
    public function shoppingCartAmount() {
        return 123;
    }

    /**
     * @return int
     */
    public function shoppingCartSum() {
        return 900232;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'shopping_cart';
    }
}
