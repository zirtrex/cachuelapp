<?php
namespace Users;

use Admin\Model\UsuarioTable;
use Zend\Db\Adapter\AdapterInterface;
use Admin\Factory\MailFactory;

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
                }
            ]
        ];
    }
}
















