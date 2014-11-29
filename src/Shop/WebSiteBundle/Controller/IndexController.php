<?php

namespace Shop\WebSiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends \Shop\CommonBundle\Controller\CommonController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('Index/index.html.twig');
    }
}
