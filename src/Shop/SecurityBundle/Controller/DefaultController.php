<?php

namespace Shop\SecurityBundle\Controller;

use Shop\CommonBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * @Route(service="shop.security.default_controller")
 */
class DefaultController extends Controller\CommonController
{
    /**
     * @Route("/security")
     */
    public function indexAction()
    {
        return $this->render('ShopSecurityBundle:Default:index.html.twig');
    }

    /**
     * @Route("/login", name="shop_login")
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // получить ошибки логина, если таковые имеются
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('ShopSecurityBundle:Default:login.html.twig', array(
            // имя, введённое пользователем в последний раз
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
}
