<?php

namespace Shop\WebSiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Shop\CommonBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class IndexController extends Controller\CommonController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('Index/index.html.twig');
    }
}
