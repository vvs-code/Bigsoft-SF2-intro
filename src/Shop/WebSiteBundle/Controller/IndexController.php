<?php

namespace Shop\WebSiteBundle\Controller;

use Shop\CommonBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route(service="shop.website.index_controller")
 */
class IndexController extends Controller\CommonController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('WebSiteBundle:Index:index.html.twig');
    }

    /**
     * @Route("/page/{page}", requirements={"page" = "\w+"})
     * @param $page
     */
    public function pageAction($page)
    {
        return $this->render('WebSiteBundle:Index:'.$page.'.html.twig');
    }

    /**
     * @Route("/cart")
     */
    public function cartAction()
    {
        return $this->render('WebSiteBundle:Index:cart.html.twig');
    }

}
