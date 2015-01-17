<?php
namespace Shop\CommonBundle\Controller;

use Symfony\Component\Form\FormFactory;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormBuilderInterface;

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

    public function setFormFactory(FormFactory $ff){
        $this->formFactory = $ff;
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
     * @param string|FormTypeInterface $type    The built type of the form
     * @param mixed                    $data    The initial data for the form
     * @param array                    $options Options for the form
     *
     * @return Form
     */
    function createForm($type, $data = null, array $options = array())
    {
        return $this->createFormBuilder($type, $data, $options)->getForm();
    }

    /**
     * Returns a form builder.
     *
     * @param string|FormTypeInterface $type    The type of the form
     * @param mixed                    $data    The initial data
     * @param array                    $options The options
     *
     * @return FormBuilderInterface The form builder
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException if any given option is not applicable to the given type
     */
    function createFormBuilder($type, $data = null, array $options = array())
    {
        return $this->formFactory->createBuilder($type, $data, $options);
    }

}
