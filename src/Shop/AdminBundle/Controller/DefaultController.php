<?php

namespace Shop\AdminBundle\Controller;

use Shop\CommonBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route(service="shop.admin.default_controller")
 */
class DefaultController extends Controller\CommonController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }
}
