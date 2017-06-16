<?php
namespace Application\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\Session\SessionManager;

class SessionManagerFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param ContainerInterface $container            
     * @param string $requestedName            
     * @param null|array $options            
     *
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *         creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        
        if (! isset($config['session_config'])) {
            $sessionManager = new SessionManager();
            Container::setDefaultManager($sessionManager);
            return $sessionManager;
        }
        // create session config if exists in global configuration
        $sessionConfig = null;
        if (isset($config['session_config'])) {
            $sessionConfig = new SessionConfig();
            $sessionConfig->setOptions($config['session_config']);
        }
        // create session storage if exists in global configuration
        $sessionStorage = null;
        if (isset($config['session_storage'])) {
            $class = $config['session_storage']['type'];
            $sessionStorage = new $class('hpv');
        }
        
        // optional get a save handler and store it into SessionManager (currently null)
        $sessionManager = new SessionManager($sessionConfig, $sessionStorage, null);
        Container::setDefaultManager($sessionManager);
        return $sessionManager;
    }
}