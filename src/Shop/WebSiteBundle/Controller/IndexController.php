<?php
namespace Shop\WebSiteBundle\Controller;

use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Shop\CommonBundle\Controller;
use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Service\ProductService;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(service="shop.website.index_controller")
 */
class IndexController extends Controller\CommonController
{
    const QUERY_PAGE_KEY = 'page';
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @var Paginator KnpPaginator
     */
    protected $paginator;

    /**
     * @Route("/", name="main_page")
     */
    public function indexAction(Request $request)
    {
        $page = $request->query->get(static::QUERY_PAGE_KEY, 1);
        $pagination = $this->productService->getPagination($this->paginator, $page);

        return $this->render('WebSiteBundle:Index:index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/cart", name="cart_page")
     */
    public function cartAction()
    {
        return $this->render('WebSiteBundle:Index:cart.html.twig');
    }

    /**
     * @param ProductService $productService
     */
    public function setProductService(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param Paginator $paginator
     */
    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

}
