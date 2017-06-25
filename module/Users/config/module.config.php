<?php
namespace Users;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            
            'registro' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/registro[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        'controller' => Controller\RegistroController::class,
                        'action' => 'index'
                    ],
                ],
            ],
            
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
            
            'confirmar-correo' =>[
                'type'    => Segment::class,
                'options' => array(
                    'route'    => '/confirmar-correo[/:token]',
                    'constraints' => [
                        'token' => '[a-zA-Z0-9_-]*'
                    ],
                    'defaults' => array(
                        'controller'    => Controller\RegistroController::class,
                        'action'        => 'confirmarCorreo',
                    ),
                ),
            ],
        ],
        
    ],
    
    'service_manager' => [
        'factories' => [
             Storage\AuthStorage::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
             \Zend\Authentication\AuthenticationService::class => Factory\Storage\AuthenticationServiceFactory::class,
        ],
    ],
    
    'controllers' => [
        'factories' => [
            Controller\AuthController::class => Factory\Controller\AuthControllerServiceFactory::class,
            //Controller\RegistroController::class => InvokableFactory::class,
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