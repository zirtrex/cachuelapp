<?php

namespace Admin\View\Helper;


use Zend\View\Helper\AbstractHelper;

class ConfigHelper extends AbstractHelper
{
	protected $sm;
	
	public function __construct($sm)
	{
		if (!$this->sm)
		{
			$this->sm = $sm;
		}
		return $this->sm;
	}
	
	public function __invoke($idConfig)
	{				
		return $this->getConfig($idConfig);
	}
	
	private function getConfig($idConfig)
	{
		$configTable = $this->sm->getServiceLocator()->get('ConfigTable');
		
		return $config = $configTable->obtenerConfiguracion($idConfig);
	}
}
