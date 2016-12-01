<?php

namespace FLOT\UserBundle\Listener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Custom login listener.
 */
class LoginListener
{
    private $em, $container, $router, $dispatcher, $user;

    /**
     * @param EntityManager $em
     * @param ContainerInterface $container
     */
    public function __construct(EntityManager $em, ContainerInterface $container, Router $router,  EventDispatcherInterface $dispatcher)
    {
        $this->em = $em;
        $this->container = $container;
        $this->router = $router;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Do the magic.
     *
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {


        $user = $event->getAuthenticationToken()->getUser();
        $this->user = $user;

        if($user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_MANAGER')) {
            $this->dispatcher->addListener(KernelEvents::RESPONSE, array($this, 'redirectToAdmin'));
        }
        if($user->hasRole('ROLE_PARTNER')){
            $this->dispatcher->addListener(KernelEvents::RESPONSE, array($this, 'redirectToPartner'));
        }
        if($user->hasRole('ROLE_CUSTOMER')){
            $this->dispatcher->addListener(KernelEvents::RESPONSE, array($this, 'redirectToCustomer'));
        }
        if($user->hasRole('ROLE_VALET')){
            $this->dispatcher->addListener(KernelEvents::RESPONSE, array($this, 'redirectToValet'));
        }
        if($user->hasRole('ROLE_CLIENT')){
            $this->dispatcher->addListener(KernelEvents::RESPONSE, array($this, 'redirectToClient'));
        }
    }

    public function redirectToAdmin(FilterResponseEvent $event)
    {
        $response = new RedirectResponse($this->router->generate('admin_dashboard'));
        $event->setResponse($response);
    }

    public function redirectToPartner(FilterResponseEvent $event)
    {
        $response = new RedirectResponse($this->router->generate('partner_dashboard'));
        $event->setResponse($response);
    }

    public function redirectToReseller(FilterResponseEvent $event)
    {
        $response = new RedirectResponse($this->router->generate('reseller_dashboard'));
        $event->setResponse($response);
    }

    public function redirectToCustomer(FilterResponseEvent $event)
    {

        $response = new RedirectResponse($this->router->generate('customer_dashboard'));
        $event->setResponse($response);
    }

    public function redirectToValet(FilterResponseEvent $event)
    {

        $response = new RedirectResponse($this->router->generate('valet_dashboard'));
        $event->setResponse($response);
    }

    public function redirectToClient(FilterResponseEvent $event)
    {
        $response = new RedirectResponse($this->router->generate('courses',array('type'=>'client','id'=>$this->user->getId())));
        $event->setResponse($response);
    }
}