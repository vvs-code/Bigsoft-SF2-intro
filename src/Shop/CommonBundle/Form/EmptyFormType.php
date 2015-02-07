<?php
namespace Shop\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmptyFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction($options['action']);

        $builder->add('submit', 'submit', ['label' => $options['buttonName']]);

        foreach($options['hidden'] as $key => $value) {
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

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults([
            'buttonName' => 'Submit',
            'action' => '',
            'hidden' => []
        ]);
    }
}
