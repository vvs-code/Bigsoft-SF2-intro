<?php
namespace Shop\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Shop\AdminBundle\Form\ProductType;
use Shop\CommonBundle\Controller\CommonController;
use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Service\ProductService;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

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
    protected $productService;

    /**
     * Creates a new Product entity.
     *
     * @Route("/", name="admin_product_create")
     * @Method("POST")
     * @Template("AdminBundle:Product:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = $this->productService->createProduct();
        $form = $this->createProductForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->productService->save($entity);
            return $this->redirect($this->generateUrl('admin_product_show', ['id' => $entity->getId()]));
        }
        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Product $entity
     * @return mixed
     */
    public function createProductForm(Product $entity)
    {
        $entityId = $entity->getId();

        if ($entityId) {
            $submitLabel = "Update";
            $submitAction = $this->generateUrl('admin_product_update', ['id' => $entity->getId()]);
        } else {
            $submitLabel = "Create";
            $submitAction = $this->generateUrl('admin_product_create');
        }

        $form = $this->createFormBuilder(new ProductType(), $entity, [
            'action' => $submitAction,
            'method' => 'POST'
        ])->addEventListener(FormEvents::SUBMIT, function ($event) {
            $this->onFormSubmit($event);
        }, 900)
            ->getForm()
            ->add('submit', 'submit', ['label' => $submitLabel]);
        return $form;
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
        $dirName = sprintf('images/', time());
        $fileName = sprintf('%d_%s', time(), $file->getClientOriginalName());
        //$file->move($dirName, $fileName);
        copy($file->getPathname(), $dirName . $fileName);
        //unlink($file->getPathname());
        return $dirName . $fileName;
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
        $entity = $this->productService->createProduct();
        $form = $this->createProductForm($entity);
        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
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
        return ['entity' => $entity];
    }

    /**
     * @param $id
     * @return Product|null
     * @throws \Symfony\Component\Security\Acl\Exception\Exception
     * @throws void
     */
    protected function getProductById($id)
    {
        $entity = $this->productService->findById($id);
        if (!$entity) {
            $this->createNotFoundException(sprintf('Unable to find Product entity #%s', $id));
        }
        return $entity;
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
        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        ];
    }

    /**
     * Edits an existing Product entity.
     *
     * @Route("/{id}", name="admin_product_update", requirements={
     *     "id": "\d+"
     * })
     * @Method("POST")
     * @Template("AdminBundle:Product:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->getProductById($id);
        $editForm = $this->createProductForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $this->productService->save($entity);
        }
        return [
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        ];
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
        $entity = $this->getProductById($id);
        if ($entity) {
            $this->productService->remove($entity);
        }
        return $this->redirect($this->generateUrl('main_page'));
    }

    /**
     * @param ProductService $productService
     */
    public function setProductService(ProductService $productService)
    {
        $this->productService = $productService;
    }
}
