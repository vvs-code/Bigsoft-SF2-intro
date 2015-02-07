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
     * @param FormFactory $ff
     */
    public function setFormFactory(FormFactory $ff)
    {
        $this->formFactory = $ff;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions() {
        return array(
            'empty_post_form' => new \Twig_Function_Method($this, 'getEmptyPostForm')
        );
    }

    /**
     * @return string
     */
    public function getEmptyPostForm(array $options = []) {
        return $this->formFactory
            ->createBuilder(new EmptyFormType, $options)
            ->getForm()
            ->createView();
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'common_extension';
    }
}
