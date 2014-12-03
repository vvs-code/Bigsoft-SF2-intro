<?php

namespace Shop\CommonBundle\Controller;

use Symfony\Bundle\TwigBundle\TwigEngine;


/**
 * Class CommonController
 * @package Shop\CommonBundle\Controller
 */
class CommonController
{
    /**
     * @var TwigEngine Should contain templating-engine instance
     */
    protected $templating;

    /**
     * Set templating engine
     * @param TwigEngine $templating
     * @return CommonController this
     */
    public function setTemplating(TwigEngine $templating)
    {
        $this->templating = $templating;
        return $this;
    }

    /**
     * Render view and return Response
     * @param string $view view name to render
     * @param array $parameters parametrs passed to view
     * @return Response
     */
    public function render($view, $parameters = [])
    {
        return $this->templating->renderResponse($view, $parameters);
    }
}
