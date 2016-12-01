<?php
namespace FLOT\UserBundle\Handler;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
class CustomLogoutHandler implements LogoutSuccessHandlerInterface
{
    private $router, $session;
    public function __construct(Router $router, Session $session)
    {
        $this->router = $router;
        $this->session = $session;
    }
    public function onLogoutSuccess(Request $request)
    {
        $parameter = $this->session->get('logout_url');
        $uri = $this->router->generate('fos_user_security_login');
        return new RedirectResponse($uri);
    }
}