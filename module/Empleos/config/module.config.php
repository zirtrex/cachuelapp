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
                    'route'    => '/empleos[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'listar-empleos',
                    ],
                ],
            ],
            'trabajadores' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/trabajadores[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'listar-trabajadores',
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
