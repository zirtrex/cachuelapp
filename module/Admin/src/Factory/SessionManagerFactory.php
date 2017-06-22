<?php
namespace Admin\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\Session\SessionManager;

class SessionManagerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        
        if (! isset($config['session_config']))
        {
            $sessionManager = new SessionManager();
            Container::setDefaultManager($sessionManager);
            return $sessionManager;
        }
        // create session config if exists in global configuration
        $sessionConfig = null;
        
        if (isset($config['session_config']))
        {
            $sessionConfig = new SessionConfig();
            $sessionConfig->setOptions($config['session_config']);
        }
        // create session storage if exists in global configuration
        $sessionStorage = null;
        
        if (isset($config['session_storage']))
        {
            $class = $config['session_storage']['type'];
            $sessionStorage = new $class('hpv');
        }
        
        // optional get a save handler and store it into SessionManager (currently null)
        $sessionManager = new SessionManager($sessionConfig, $sessionStorage, null);
        Container::setDefaultManager($sessionManager);
        return $sessionManager;
    }
}