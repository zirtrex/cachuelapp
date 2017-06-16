<?php

namespace Application;

use Zend\Authentication\AuthenticationService;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\Session\SessionManager;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;

class Module
{
    const VERSION = '1.1 Dev';
    
    private $auth;

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $this->bootstrapSession($mvcEvent);
        $this->auth = $mvcEvent->getApplication()->getServiceManager()->get(AuthenticationService::class);
        // store user and role in global viewmodel
        if ($this->auth->hasIdentity()) {
            // for e.g. store your auth identity into ViewModel
            $mvcEvent->getViewModel()->setVariable('authIdentity', $this->auth->getIdentity());
            // extend functionality with acl to checkPermission if user has rights to the given route
            // ...
        } else {
            // redirect if auth fails for example back to /login
            // ..
        }
    }
    
    private function bootstrapSession($e)
    {
        /** @var SessionManager $session */
        $session = $e->getApplication()->getServiceManager()->get(SessionManager::class);
        $session->start();
        $container = new Container('your_session_name', $session);
        if (isset($container->init)) {
            return;
        }
        /** @var Request $request */
        $request = $e->getRequest();
        $session->regenerateId(true);
        $container->init = 1;
        $container->remoteAddr = $request->getServer()->get('REMOTE_ADDR');
        $container->httpUserAgent = $request->getServer()->get('HTTP_USER_AGENT');
        $config = $e->getApplication()->getServiceManager()->get('config');
        if (!isset($config['session'])) {
            return;
        }
        if (!isset($config['session_validators'])) {
            return;
        }
        $chain = $session->getValidatorChain();
        foreach ($config['session_validators'] as $validator) {
            switch ($validator) {
                case HttpUserAgent::class:
                    $validator = new $validator($container->httpUserAgent);
                    break;
                case RemoteAddr::class:
                    $validator = new $validator($container->remoteAddr);
                    break;
                default:
                    $validator = new $validator();
            }
            $chain->attach('session.validate', [$validator, 'isValid']);
        }
    }
}
