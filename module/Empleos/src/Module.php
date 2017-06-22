<?php
namespace Empleos;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Admin\Model\EmpleoTable;
use Admin\Model\UsuarioTable;
use Admin\Model\InteraccionTable;

class Module implements ConfigProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }    

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\IndexController::class => function ($container) {
                    return new Controller\IndexController(
                        $container->get(EmpleoTable::class),
                        $container->get(UsuarioTable::class),
                        $container->get(InteraccionTable::class)
                    );
                }
            ]
        ];
    }
}
