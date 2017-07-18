<?php
namespace Empleos;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Admin\Model\EmpleoTable;
use Admin\Model\UsuarioTable;
use Admin\Model\InteraccionTable;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Admin\Model\UbicacionTable;

class Module implements ConfigProviderInterface/*, FormElementProviderInterface */
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
    
    /*public function getFormElementConfig()
    {
        return array(
            'factories' => array(
                 Empleos\Form\Fieldset\UbicacionFieldset::class => function($container){
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $fieldset = new \Empleos\Form\Fieldset\UbicacionFieldset($dbAdapter);
                    return $fieldset;
                }
            )
        );
    }*/
}
