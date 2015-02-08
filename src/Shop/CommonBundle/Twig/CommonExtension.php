<?php
namespace Shop\CommonBundle\Twig;

use Symfony\Component\Form\FormFactory;
use Shop\CommonBundle\Form\EmptyFormType;

class CommonExtension extends \Twig_Extension
{
    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @param FormFactory $formFactory
     */
    public function setFormFactory(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            'empty_post_form' => new \Twig_Function_Method($this, 'getEmptyPostForm')
        ];
    }

    /**
     * @return string
     */
    public function getEmptyPostForm(array $options = [])
    {
        return $this->formFactory
            ->createBuilder(new EmptyFormType, null, $options)
            ->getForm()
            ->createView();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'common_extension';
    }
}
