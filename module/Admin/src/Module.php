<?php
namespace Admin;

use Zend\Authentication\AuthenticationService;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\Session\SessionManager;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mail\Transport\Sendmail;

class Module
{

    const VERSION = '1.0 Dev';

    private $auth;

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\EmpleoTable::class => function ($container) {
                    $tableGateway = $container->get(Model\EmpleoTableGateway::class);
                    return new Model\EmpleoTable($tableGateway);
                },
                Model\EmpleoTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Empleo());
                    return new TableGateway('empleo', $dbAdapter, null, $resultSetPrototype);
                },
                Model\UsuarioTable::class => function ($container) {
                    $tableGateway = $container->get(Model\UsuarioTableGateway::class);
                    return new Model\UsuarioTable($tableGateway);
                },
                Model\UsuarioTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Usuario());
                    return new TableGateway('vw_usuario', $dbAdapter, null, $resultSetPrototype);
                },
                
                Model\InteraccionTable::class => function ($container) {
                    $tableGateway = $container->get(Model\InteraccionTableGateway::class);
                    return new Model\InteraccionTable($tableGateway);
                },
                Model\InteraccionTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    return new TableGateway('interaccion', $dbAdapter, null);
                },
                
                Model\UbicacionTable::class => function ($container) {
                    $tableGateway = $container->get(Model\UbicacionTableGateway::class);
                    return new Model\UbicacionTable($tableGateway);
                },
                Model\UbicacionTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entity\Ubicacion());
                    return new TableGateway('ubicacion', $dbAdapter, null, $resultSetPrototype);
                },
                
                Factory\MailFactory::class => function ($container) {
                    $config = $container->get('config');
                    $transport = new Sendmail();
                    if (isset($config['mail']['transport']['options'])) {
                        // $transport->setOptions(new SmtpOptions($config['mail']['transport']['options']));
                    } else {
                        throw new RuntimeException(sprintf('Could not find row with identifier %d', $codEmpleo));
                    }
                    return $transport;
                }
            ]
        ];
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => [
                View\Helper\UsuarioHelper::class => function ($container) {
                    $usuarioHelper = new View\Helper\UsuarioHelper($container);
                    return $usuarioHelper;
                }
            ],
            'aliases' => [
                'usuario_helper' =>  View\Helper\UsuarioHelper::class                
            ]
        );
    }

    public function onBootstrap(MvcEvent $mvcEvent)
    {
        // $this->bootstrapSession($mvcEvent);
        $this->auth = $mvcEvent->getApplication()
            ->getServiceManager()
            ->get(AuthenticationService::class);
        
        if ($this->auth->hasIdentity()) {
            $mvcEvent->getViewModel()->setVariable('authIdentity', $this->auth->getIdentity());
        } else {}
    }

    private function bootstrapSession($e)
    {
        $session = $e->getApplication()
            ->getServiceManager()
            ->get(SessionManager::class);
        
        $session->start();
        
        $container = new Container('session', $session);
        
        if (isset($container->init)) {
            return;
        }
        
        $request = $e->getRequest();
        $session->regenerateId(true);
        $container->init = 1;
        
        $container->remoteAddr = $request->getServer()->get('REMOTE_ADDR');
        $container->httpUserAgent = $request->getServer()->get('HTTP_USER_AGENT');
        
        $config = $e->getApplication()
            ->getServiceManager()
            ->get('config');
        
        if (! isset($config['session'])) {
            return;
        }
        if (! isset($config['session_validators'])) {
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
            $chain->attach('session.validate', [
                $validator,
                'isValid'
            ]);
        }
    }
}
