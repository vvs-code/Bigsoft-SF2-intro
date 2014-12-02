<?php

namespace Shop\CommonBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\TwigBundle\TwigEngine;

class CommonController
{
    protected $templating;

    public function setTemplating(TwigEngine $templating){
        $this->templating = $templating;
    }

    public function render($view, $parameters = array())
    {
        return new Response($this->templating->render($view, $parameters));
    }
}
