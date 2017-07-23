<?php

namespace Admin;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Admin\Factory\SessionManagerFactory;
use Zend\Session\SessionManager;
use Zend\Router\Http\Literal;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/[:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                ],
            ],
            
            'faq' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/preguntas-frecuentes',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'preguntas-frecuentes',
                    ],
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                ],
            ],
        ],
    ],
    
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    
    'service_manager' => [
        'factories' => [
            SessionManager::class => SessionManagerFactory::class,
        ],
    ],
    
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/login' 			  => __DIR__ . '/../view/layout/layout_login.phtml',
            'admin/index/index'       => __DIR__ . '/../view/admin/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Inicio',
                'route' => 'home',
            ),
            array(
                'label' => 'Empleos',
                'route' => 'empleos',
                'action' => 'listar-empleos',
            ),
            array(
                'label' => 'Trabajadores',
                'route' => 'trabajadores',
                'action' => 'listar-trabajadores',
            ),
            array(
                'label' => 'Preguntas Frecuentes',
                'route' => 'faq',
            )
        ),
    ),
];
