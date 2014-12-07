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
     * @Route("/login", name="shop_login")
     */
    public function loginAction()
    {
        return $this->render('ShopSecurityBundle:Default:login.html.twig');
    }

    /**
     * @Route("/login_check", name="shop_login_check")
     */
    public function loginCheckAction()
    {
        return $this->render('ShopSecurityBundle:Default:login.html.twig');
    }

    /**
     * @Route("/logout", name="shop_logout")
     */
    public function logoutAction()
    {
        return $this->render('ShopSecurityBundle:Default:login.html.twig');
    }
}
