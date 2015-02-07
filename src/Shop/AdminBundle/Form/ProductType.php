<?php
namespace Shop\AdminBundle\Form;

use Shop\WebSiteBundle\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $product = $builder->getData();
        $productId = $product->getId();
        $submitLabel = $productId ? 'Update': 'Create';

        $builder
            ->add('title')
            ->add('description')
            ->add('file', 'file', [
                'required' => false,
                'attr' => ['accept' => "image/*"]
            ])
            ->add('image', 'hidden')->add('price', 'number')
            ->add('submit', 'submit', ['label' => $submitLabel])
            ->addEventListener(FormEvents::SUBMIT, function ($event) {
                $this->onFormSubmit($event);
            }, 900);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => 'Shop\WebSiteBundle\Entity\Product']);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'shop_websitebundle_product';
    }

    /**
     * @param $event
     */
    protected function onFormSubmit(FormEvent  $event)
    {
        /**
         * @var Product
         */
        $product = $event->getData();

        /**
         * @var UploadedFile
         */
        $file = $product->getFile();
        if ($file instanceof UploadedFile) {
            $product->setImage($this->moveUploadedFile($file));
        }
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    protected function moveUploadedFile(UploadedFile $file)
    {
        $dirName = 'images/';
        $fileName = sprintf('%d_%s', time(), $file->getClientOriginalName());
        if(copy($file->getPathname(), $dirName . $fileName)){
            return $dirName . $fileName;
        } else {
            return null;
        }
    }
}
