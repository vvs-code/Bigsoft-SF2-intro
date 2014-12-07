<?php

namespace Shop\SecurityBundle\Controller;

use Shop\CommonBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route(service="shop.security.default_controller")
 */
class DefaultController extends Controller\CommonController
{
    /**
     * @Route("/security")
     */
    public function indexAction()
    {
        return $this->render('ShopSecurityBundle:Default:index.html.twig');
    }

    /**
     * @Route("/login")
     */
    public function loginAction()
    {
        return $this->render('ShopSecurityBundle:Default:login.html.twig');
    }
}
