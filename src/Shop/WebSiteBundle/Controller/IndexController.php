<?php

namespace Shop\WebSiteBundle\Controller;

use Shop\CommonBundle\Controller;

class IndexController extends Controller\AbstractController
{
    public function indexAction()
    {
        return $this->render('WebSiteBundle:Index:index.html.twig');
    }
}
