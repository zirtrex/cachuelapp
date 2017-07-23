<?php

namespace Admin\View\Helper;


use Zend\View\Helper\AbstractHelper;
use Admin\Model\UsuarioTable;

class UsuarioHelper extends AbstractHelper
{
	protected $container;
	protected $codUsuario;
	protected $rol;
	
	public function __construct($container)
	{
		if (!$this->container)
		{
			$this->container = $container;
		}
		return $this->container;
	}
	
	public function __invoke($codUsuario, $rol)
	{		
		
		$this->codUsuario = $codUsuario;
		$this->rol = $rol;
		
		return $this->getDatosUsuario();
	}
	
	private function getDatosUsuario()
	{
        $usuarioTable = $this->container->get(UsuarioTable::class);
        
        return $datos = $usuarioTable->obtenerUsuario($this->codUsuario);
		
	}
}
