<?php
namespace Shop\CommonBundle\Controller;

use Symfony\Component\Form\FormFactory;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use \Symfony\Bundle\FrameworkBundle\Routing\Router;

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
     * @var Router
     */
    protected $router;

    /**
     * @var FormFactory
     */
    protected $formFactory;

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
     * @param FormFactory $ff
     */
    public function setFormFactory(FormFactory $ff)
    {
        $this->formFactory = $ff;
    }

    /**
     * @param Router $router
     */
    public function setRouter(Router $router)
    {
        $this->router = $router;
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

    /**
     * Creates and returns a Form instance from the type of the form.
     *
     * @param string|FormTypeInterface $type The built type of the form
     * @param mixed $data The initial data for the form
     * @param array $options Options for the form
     *
     * @return Form
     */
    function createForm($type, $data = null, array $options = [])
    {
        return $this->createFormBuilder($type, $data, $options)->getForm();
    }

    /**
     * Returns a form builder.
     *
     * @param string|FormTypeInterface $type The type of the form
     * @param mixed $data The initial data
     * @param array $options The options
     *
     * @return FormBuilderInterface The form builder
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException if any given option is not applicable to the given type
     */
    function createFormBuilder($type = 'form', $data = null, array $options = [])
    {
        return $this->formFactory->createBuilder($type, $data, $options);
    }

    /**
     * Generates a URL from the given parameters.
     *
     * @param string $route The name of the route
     * @param mixed $parameters An array of parameters
     * @param bool|string $referenceType The type of reference (one of the constants in UrlGeneratorInterface)
     *
     * @return string The generated URL
     *
     * @see UrlGeneratorInterface
     */
    public function generateUrl($route, $parameters = [], $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->router->generate($route, $parameters, $referenceType);
    }

    /**
     * @param $text
     * @throws Exception
     */
    protected function createNotFoundException($text)
    {
        throw new Exception($text);
    }

    /**
     * @param $url
     */
    protected function redirect($url)
    {
        header(sprintf('Location: %s', $url));
        die;
    }

}
