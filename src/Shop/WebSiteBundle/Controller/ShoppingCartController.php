<?php
namespace Shop\WebSiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Shop\CommonBundle\Controller;
use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Service\ProductService;
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
     * @var ProductService
     */
    protected $productService;

    /**
     * @param ShoppingCartService $shoppingCartService
     */
    public function setShoppingCartService(ShoppingCartService $shoppingCartService) {
        $this->shoppingCartService = $shoppingCartService;
    }

    /**
     * @param ProductService $productService
     */
    public function setProductService(ProductService $productService)
    {
        $this->productService = $productService;
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

    /**
     * @Route("/to_cart/{id}", name="add_to_shopping_cart", requirements={
     *     "id": "\d+"
     * })
     * @Method("POST")
     */
    public function addToCartAction(Request $request, $id) {
            $this->shoppingCartService->addToCartById($id);
            $referer = $request->headers->get('referer');
            return $this->redirect($referer);

    }
}
