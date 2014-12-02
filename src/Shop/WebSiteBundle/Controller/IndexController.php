<?php

namespace Shop\WebSiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route(service="shop.website.index_controller")
 */
class IndexController extends \Shop\CommonBundle\Controller\CommonController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('WebSiteBundle:Index:index.html.twig');
    }
}
