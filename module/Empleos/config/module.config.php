<?php
namespace Empleos;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;


return [
    'router' => [
        'routes' => [
            'empleos' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/empleos[/:action][/:codEmpleo][/page/:page][/orderby/:orderby][/:order]',
                    'constraints' => [
                        'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'codEmpleo' => '[0-9]+',
                        'page'      => '[0-9]+',
                        'orderby'   => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order'     => 'ASC|DESC'
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'trabajadores' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/trabajadores[/:action][/:id][/page/:page][/orderby/:orderby][/:order]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                        'page'    => '[0-9]+',
                        'orderby' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC'
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    
    'controllers' => [
        'factories' => [
            //Controller\IndexController::class => InvokableFactory::class,
        ],
    ],  
    
    'view_manager' => [
        'template_path_stack' => [
            'empleos' => __DIR__ . '/../view',
        ],
    ],
];
