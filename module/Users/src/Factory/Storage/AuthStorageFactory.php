<?php

namespace Users\Factory\Storage;
 
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Users\Storage\AuthStorage;
 

class AuthStorageFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $storage = new AuthStorage('cachuelapp');
        
        $storage->setServiceLocator($container);
        
        $storage->setDbHandler();
         
        return $storage;
    }
}









