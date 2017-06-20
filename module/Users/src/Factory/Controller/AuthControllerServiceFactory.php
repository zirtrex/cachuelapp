<?php

namespace Users\Factory\Controller;
 
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Authentication\AuthenticationService;
use Users\Controller\AuthController;
use Interop\Container\ContainerInterface;

 
class AuthControllerServiceFactory implements FactoryInterface  
{
    
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authService = $container->get(AuthenticationService::class);
        $controller = new AuthController($authService);
         
        return $controller;
    }
}
