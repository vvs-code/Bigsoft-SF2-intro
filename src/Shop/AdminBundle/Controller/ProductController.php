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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ProductController
 * @package Shop\AdminBundle\Controller
 * @Route("/product", service="shop.admin.product_controller")
 */
class ProductController extends CommonController
{
    const MESSAGE_PRODUCT_NOT_FOUND = 'Unable to find Product entity #%s';

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
            return $this->redirect('main_page');
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
            return $this->redirect('main_page');
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
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        if($this->validateEmptyPost($request)){
            $entity = $this->getProductById($id);
            $this->productService->remove($entity);
            return $this->redirect('main_page');
        }

        // On error - do not redirect user on other page
        return $this->redirect($request->headers->get('referrer'));
    }

    /**
     * @param $id
     * @return Product
     * @throws NotFoundHttpException
     */
    protected function getProductById($id)
    {
        $entity = $this->productService->findById($id);
        if (!($entity instanceof Product)) {
            $this->createNotFoundException(sprintf(self::MESSAGE_PRODUCT_NOT_FOUND, $id));
        }
        return $entity;
    }

    /**
     * @param ProductService $productService
     */
    public function setProductService(ProductService $productService)
    {
        $this->productService = $productService;
    }
}
