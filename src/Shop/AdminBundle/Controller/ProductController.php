<?php

namespace Shop\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Shop\AdminBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Shop\CommonBundle\Controller\CommonController;
use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Service\ProductService;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ProductController
 * @package Shop\AdminBundle\Controller
 * @Route("/product", service="shop.admin.product_controller")
 *
 */
class ProductController extends CommonController
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * Creates a new Product entity.
     *
     * @Route("/", name="admin_product_create")
     * @Method("POST")
     * @Template("AdminBundle:Product:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Product();
        $form = $this->createProductForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->productService->save($entity);

            return $this->redirect($this->generateUrl('admin_product_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Product entity.
     *
     * @Route("/new", name="admin_product_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Product();
        $form = $this->createProductForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Product entity.
     *
     * @Route("/{id}", name="admin_product_show", requirements={
     *     "id": "\d+"
     * })
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->getProductById($id);

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     * @Route("/{id}/edit", name="admin_product_edit", requirements={
     *     "id": "\d+"
     * })
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $entity = $this->getProductById($id);

        $editForm = $this->createProductForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     * Edits an existing Product entity.
     *
     * @Route("/{id}", name="admin_product_update", requirements={
     *     "id": "\d+"
     * })
     * @Method("PUT")
     * @Template("AdminBundle:Product:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->getProductById($id);

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createProductForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            return $this->redirect($this->generateUrl('admin_product_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Product entity.
     *
     * @Route("/{id}", name="admin_product_delete", requirements={
     *     "id": "\d+"
     * })
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity = $this->getProductById($id);

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_product'));
    }

    /**
     * Creates a form to delete a Product entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_product_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

    /**
     * @param ProductService $productService
     */
    public function setProductService(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function createProductForm(Product $entity)
    {
        $entityId = $entity->getId();

        if ($entityId) {
            $submitLabel = "Update";
            $submitMethod = "PUT";
            $submitAction = $this->generateUrl('admin_product_update', array('id' => $entity->getId()));
        } else {
            $submitLabel = "Create";
            $submitMethod = "POST";
            $submitAction = $this->generateUrl('admin_product_create');
        }

        $form = $this->createFormBuilder(new ProductType(), $entity, array(
            'action' => $submitAction,
            'method' => $submitMethod
        ))
            ->addEventListener(FormEvents::SUBMIT, function($event) {
                $this->onFormSubmit($event);
            }, 900)
            ->getForm()
            ->add('submit', 'submit', array('label' => $submitLabel));

        return $form;
    }

    protected function onFormSubmit($event)
    {
        /**
         * @var Product
         */
        $product = $event->getData();
        $form = $event->getForm();

        /**
         * @var UploadedFile
         */
        $file = $product->getFile();
        if($file instanceof UploadedFile) {
            $dirName = sprintf('images/', time());
            $fileName = sprintf('%d_%s', time(), $file->getFilename());
            $file->move('$fileName', $fileName);
            $product->setImage($dirName.$fileName);
        }

        var_dump($product);
        //var_dump($event);
    }

    /**
     * @param $id
     * @return Product|null
     * @throws \Symfony\Component\Security\Acl\Exception\Exception
     * @throws void
     */
    protected function getProductById($id) {
        $entity = $this->productService->findById($id);

        if (!$entity) {
            throw $this->createNotFoundException(sprintf('Unable to find Product entity #%s', $id));
        }

        return $entity;
    }
}
