<?php

namespace Users;

//use Zend\ModuleManager\Feature\FormElementProviderInterface;


class Module /*implements FormElementProviderInterface*/
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
	
	/*public function getAutoloaderConfig()
	{
		return array(
				'Zend\Loader\StandardAutoloader' => array(
						'namespaces' => array(
								__NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
						),
				),
		);
	}
	
	public function getFormElementConfig()
	{
		return array(
				'factories' => array(
						'PersonaFieldset' => function($sm){
							$fieldset = new \Admin\Form\Fieldset\PersonaFieldset($sm->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
							return $fieldset;
						}
				)
		);
	}	*/
	
}
















