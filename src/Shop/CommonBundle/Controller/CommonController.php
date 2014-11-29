<?php

namespace Shop\CommonBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class CommonController
{
    protected $tplLoader = NULL;

    public function __construct()
    {
        $this->setLoader();
    }

    protected function setLoader()
    {
        $this->tplLoader = new \Twig_Loader_Filesystem(array(
                '../src/Shop/WebSiteBundle/Resources/views',
                '../src/Shop/CommonBundle/Resources',
                '../src/Shop'
            )
        );

        list($currentBundleName) = explode('Controller', get_called_class());
        $currentBundleName = str_replace('\\', '/', $currentBundleName);
        $currentBundleViewsPath = '../src/' . $currentBundleName . 'Resources/views';

        $this->tplLoader->addPath($currentBundleViewsPath);
    }


    public function render($view, $parameters = array())
    {
        $twig = new \Twig_Environment($this->tplLoader);

        return new Response($twig->render($view, $parameters));
    }
}
