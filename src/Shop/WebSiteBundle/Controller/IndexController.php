<?php
namespace Shop\WebSiteBundle\Controller;

use Shop\CommonBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Service\ProductService;


/**
 * @Route(service="shop.website.index_controller")
 */
class IndexController extends Controller\CommonController
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @Route("/", name="main_page")
     */
    public function indexAction()
    {
        $items = $this->productService->getPageItems(1, 3);

        return $this->render('WebSiteBundle:Index:index.html.twig', ['items' => $items]);
    }

    /**
     * @Route("/cart", name="cart_page")
     */
    public function cartAction()
    {
        return $this->render('WebSiteBundle:Index:cart.html.twig');
    }

    public function setProductService(ProductService $productService){
        $this->productService = $productService;
    }

}
