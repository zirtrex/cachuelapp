<?php

namespace Empleos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\EmpleoTable;
use Admin\Model\UsuarioTable;
use Admin\Entity\Empleo;

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
            'messages' => $this->flashmessenger()->getMessages(),
            'errorMessages' => $this->flashmessenger()->getErrorMessages()
        ]);
    }
    
    public function listarTrabajadoresAction()
    {
        return new ViewModel([
            'trabajadores' => $this->usuarioTable->obtenerTodo(),
        ]);
    }
    
    public function crearEmpleoAction()
    {
        if ($this->identity()) {
            
            $form = new \Empleos\Form\EmpleoForm();           
    
            $request = $this->getRequest();
    
            if ($request->isPost()) {
                
                $form->setInputFilter(new \Empleos\Form\Filter\EmpleoFilter());
                $form->setData($request->getPost());
    
                if ($form->isValid()) {//\Zend\Debug\Debug::dump($formData);
                    
                    $empleo = new Empleo();

                    $empleo->exchangeArray($form->getData());
                    
                    $codEmpleo = $this->empleoTable->guardarEmpleo($empleo);
                    
                    $this->flashmessenger()->addMessage("Empleo N°" . $codEmpleo . ", agregado correctamente.");
                    
                    return $this->redirect()->toRoute('empleos', array('controller' => 'index', 'action' => 'listar-empleos'));
    
                } else {
                    // throw new \Exception("Datos no validados correctamente.");
                }
            }
    
            return new ViewModel([
                'form' => $form,
                'messages' => $this->flashmessenger()->getMessages(),
                'errorMessages' => $this->flashmessenger()->getErrorMessages()
            ]);
        } else {
            return $this->redirect()->toRoute('home');
        }
    }

}
