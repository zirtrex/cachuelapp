<?php
namespace Users;

use Zend\Db\Adapter\AdapterInterface;
use Admin\Factory\MailFactory;
use Admin\Model\UsuarioTable;
use Admin\Model\EmpleoTable;
use Admin\Model\InteraccionTable;
use Admin\Model\UbicacionTable;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\RegistroController::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\RegistroController(
                        $container->get(UsuarioTable::class),
                        $dbAdapter,
                        $container->get(MailFactory::class)
                    );
                },
                Controller\PerfilController::class => function ($container) {
                    return new Controller\PerfilController(
                        $container,
                        $container->get(EmpleoTable::class),
                        $container->get(UsuarioTable::class),
                        $container->get(InteraccionTable::class),
                        $container->get(UbicacionTable::class)
                    );
                }
            ]
        ];
    }
}
















