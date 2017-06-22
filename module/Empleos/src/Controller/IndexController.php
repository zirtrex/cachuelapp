<?php

namespace Empleos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\EmpleoTable;
use Admin\Model\UsuarioTable;
use Admin\Entity\Empleo;
use Admin\Model\InteraccionTable;

class IndexController extends AbstractActionController
{
    private $empleoTable;
    private $usuarioTable;
    private $interaccionTable;
    
    // Add this constructor:
    public function __construct(EmpleoTable $empleoTable, UsuarioTable $usuarioTable, InteraccionTable $interaccionTable)
    {
        $this->empleoTable = $empleoTable;
        $this->usuarioTable = $usuarioTable;
        $this->interaccionTable = $interaccionTable;
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
    
                if ($form->isValid()) {// \Zend\Debug\Debug::dump($form->getData()); return;
                    
                    $empleo = new Empleo();

                    $empleo->exchangeArray($form->getData());
                    
                    $codEmpleo = $this->empleoTable->guardarEmpleo($empleo);
                    
                    $interaccion = array(
                        'codUsuario'    => $this->identity()['codUsuario'],
                        'codEmpleo'     => $codEmpleo,
                        'estado'        => "Publico"
                    );
                    
                    $this->interaccionTable->guardarInteracion($interaccion);
                    
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
            return $this->redirect()->toRoute('ingresar');
        }
    }

}
