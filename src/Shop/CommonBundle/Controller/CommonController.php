<?php
namespace Shop\CommonBundle\Controller;

use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CommonController
 * @package Shop\CommonBundle\Controller
 */
class CommonController
{
    /**
     * @var  EngineInterface Should contain templating-engine instance
     */
    protected $templating;

    /**
     * Set templating engine
     * @param TwigEngine $templating
     * @return CommonController this
     */
    public function setTemplating(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * Render view and return Response
     * @param string $view view name to render
     * @param array $parameters parametrs passed to view
     * @return Response
     */
    public function render($view, $parameters = [])
    {
        return new Response($this->templating->render($view, $parameters));
    }

}
