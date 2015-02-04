<?php
namespace Shop\WebSiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Shop\CommonBundle\Controller;
use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Service\ShoppingCartService;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/cart", service="shop.website.shopping_cart_controller")
 */
class ShoppingCartController extends Controller\CommonController
{
    /**
     * @var ShoppingCartService
     */
    private $shoppingCartService;

    /**
     * @param ShoppingCartService $shoppingCartService
     */
    public function setShoppingCartService(ShoppingCartService $shoppingCartService) {
        $this->shoppingCartService = $shoppingCartService;
    }

    /**
     * @Route("/list", name="shopping_cart_list")
     * @Template()
     */
    public function listAction(Request $request)
    {
        return [
            'products' => $this->shoppingCartService->getCartProducts()
        ];
    }
}
