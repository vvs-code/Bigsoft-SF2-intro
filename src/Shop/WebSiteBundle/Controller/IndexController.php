<?php

namespace Shop\WebSiteBundle\Controller;

use Shop\CommonBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends Controller\AbstractController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('WebSiteBundle:Index:index.html.twig');
    }
}
