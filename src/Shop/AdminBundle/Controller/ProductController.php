<?php
namespace Shop\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Shop\AdminBundle\Form\ProductType;
use Shop\CommonBundle\Controller\CommonController;
use Shop\WebSiteBundle\Entity\Product;
use Shop\WebSiteBundle\Service\ProductService;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 * @package Shop\AdminBundle\Controller
 * @Route("/product", service="shop.admin.product_controller")
 */
class ProductController extends CommonController
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * Displays a form to create a new Product entity.
     *
     * @Route("/new", name="admin_product_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $entity = $this->productService->createProduct();
        $form = $this->createForm(new ProductType(), $entity);
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
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $entity = $this->getProductById($id);
        $editForm = $this->createForm(new ProductType(), $entity);
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
