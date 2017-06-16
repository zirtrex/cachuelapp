<?php

namespace Empleos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\EmpleoTable;
use Application\Model\UsuarioTable;

class IndexController extends AbstractActionController
{
    private $empleoTable;
    private $usuarioTable;
    
    // Add this constructor:
    public function __construct(EmpleoTable $empleoTable, UsuarioTable $usuarioTable)
    {
        $this->empleoTable = $empleoTable;
        $this->usuarioTable = $usuarioTable;
    }
    
    public function listarEmpleosAction()
    {
        return new ViewModel([
            'empleos' => $this->empleoTable->obtenerTodo(),
        ]);
    }
    
    public function listarTrabajadoresAction()
    {
        return new ViewModel([
            'trabajadores' => $this->usuarioTable->obtenerTodo(),
        ]);
    }

}
