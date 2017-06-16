<?php
namespace Users;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            
            'ingresar' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/ingresar[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action' => 'index'
                    ],
                ],
            ],
            
            'salir' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/salir[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action' => 'salir'
                    ],
                ],
            ],
            
            'perfil' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/perfil[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action' => 'index'
                    ],
                ],
            ],
            
            'reestablecer-clave' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/reestablecer-clave[/:action][/rol/:rol][/token/:token]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'rol' => '[a-zA-Z]*',
                        'token' => '[a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => 'Users\Controller\ReestablecerClave',
                        'action' => 'index'
                    ],
                ],
            ],
        ],
        
    ],
    
    'service_manager' => [
        'factories' => [
             Storage\AuthStorage::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
             \Zend\Authentication\AuthenticationService::class => Factory\Storage\AuthenticationServiceFactory::class
        ],
    ],
    
    'controllers' => [
        'factories' => [
            Controller\AuthController::class => Factory\Controller\AuthControllerServiceFactory::class,
        ],
        
        /*'invokables' => [
            'Users\Controller\Perfil' => 'Users\Controller\PerfilController',
            'Users\Controller\ReestablecerClave' => 'Users\Controller\ReestablecerClaveController',
            'Users\Controller\ConfirmarCambiarPassword' => 'Users\Controller\ConfirmarCambiarPasswordController',
            'Users\Controller\Pdf' => 'Users\Controller\PdfController'
        ],*/
    ],
    
    'view_manager' => [
        'template_path_stack' => [
            'users' => __DIR__ . '/../view'
        ],
    ],
];