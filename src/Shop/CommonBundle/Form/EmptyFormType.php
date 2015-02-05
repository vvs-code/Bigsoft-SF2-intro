<?php
namespace Shop\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EmptyFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $settings = $builder->getData();
        $btnName = isset($settings['buttonName'])? $settings['buttonName']: 'Submit';
        $action = isset($settings['action'])? $settings['action']: '';
        $hiddenFields = (isset($settings['hidden']) && is_array($settings['hidden']))? $settings['hidden']: [];

        if(!empty($action)){
            $builder->setAction($action);
        }

        $builder->add('submit', 'submit', ['label' => $btnName]);

        foreach($hiddenFields as $key => $value) {
            $builder->add($key, 'hidden', [
                'attr' => ['value' => $value]
            ]);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'shop_websitebundle_product';
    }
}
