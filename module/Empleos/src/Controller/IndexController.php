<?php

namespace Empleos\Controller;

use RuntimeException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Interop\Container\ContainerInterface;
use Empleos\Form\EmpleoForm;
use Admin\Model\EmpleoTable;
use Admin\Model\UsuarioTable;
use Admin\Model\InteraccionTable;
use Admin\Model\UbicacionTable;
use Admin\Entity\Empleo;
use Admin\Model\Miscellanea;


class IndexController extends AbstractActionController
{
    private $container;
    private $empleoTable;
    private $usuarioTable;
    private $interaccionTable;
    private $ubicacionTable;
    
    public function __construct(ContainerInterface $container, EmpleoTable $empleoTable, UsuarioTable $usuarioTable, InteraccionTable $interaccionTable, UbicacionTable $ubicacionTable)
    {
        $this->container = $container;
        $this->empleoTable = $empleoTable;
        $this->usuarioTable = $usuarioTable;
        $this->interaccionTable = $interaccionTable;
        $this->ubicacionTable = $ubicacionTable;
    }
    
    public function indexAction()
    {
        return $this->redirect()->toRoute('empleos', array('action' => 'listar-empleos'));
    }
    
    public function listarEmpleosAction()
    {
        $empleos = $this->empleoTable->obtenerTodo(true);
        
        $page = $this->params()->fromRoute('page') ? (int) $this->params()->fromRoute('page') : 1;
        
        $itemsPerPage = 6;

        $empleos->setCurrentPageNumber($page);

        $empleos->setItemCountPerPage($itemsPerPage);
        
        return new ViewModel([
            'empleos' => $empleos,
            'messages' => $this->flashmessenger()->getMessages(),
            'errorMessages' => $this->flashmessenger()->getErrorMessages()
        ]);
    }
    
    public function listarTrabajadoresAction()
    {
        $trabajadores = $this->usuarioTable->obtenerTodo(true);
        
        $page = $this->params()->fromRoute('page') ? (int) $this->params()->fromRoute('page') : 1;
        
        $itemsPerPage = 6;
        
        $trabajadores->setCurrentPageNumber($page);
        
        $trabajadores->setItemCountPerPage($itemsPerPage);
        
        return new ViewModel([
            'trabajadores' => $trabajadores,
            'messages' => $this->flashmessenger()->getMessages(),
            'errorMessages' => $this->flashmessenger()->getErrorMessages()
        ]);
    }
    
    public function crearEmpleoAction()
    {
        if ($this->identity()) {
            
            $formManager = $this->container->get('FormElementManager');            
            $form = $formManager->get(EmpleoForm::class);
    
            $request = $this->getRequest();
    
            if ($request->isPost()) {
                
                $form->setInputFilter(new \Empleos\Form\Filter\EmpleoFilter());
                $form->setData($request->getPost());
    
                if ($form->isValid()) {// \Zend\Debug\Debug::dump($form->getData()); return;
                    
                    $empleo = $form->getData();

                    $ubicacion = $empleo->Ubicacion;
                    
                    $codUbicacion =  $this->ubicacionTable->guardarUbicacion($ubicacion);
                    
                    if($codUbicacion){
                    
                        $empleo->Ubicacion->codUbicacion = $codUbicacion;
                        
                        $codEmpleo = $this->empleoTable->guardarEmpleo($empleo);
                    
                    }
                    
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
    
    public function postularEmpleoAction()
    {
    if ($this->identity()) {
            
            $codEmpleo = (int) $this->params()->fromRoute('codEmpleo', 0);
            
            $empleo = new Empleo();
            
            if (0 === $codEmpleo) {
                return $this->redirect()->toRoute('empleos', ['action' => 'listar-empleos']);
            }
            
            try {
                $data = $this->empleoTable->obtenerEmpleo($codEmpleo);
            } catch (RuntimeException $e) {
                return $this->redirect()->toRoute('empleos', ['action' => 'listar-empleos']);
            }
            $empleo->exchangeArray($data);
            // \Zend\Debug\Debug::dump($empleo); return;
            
            $interaccion = array(
                'codInteracion' => gmdate("Y-m-d H:i:s", Miscellanea::getHoraLocal(-5)),
                'codUsuario'    => $this->identity()['codUsuario'],
                'codEmpleo'     => $codEmpleo,
                'estado'        => "Postulo"
            );
            try {
                $this->interaccionTable->guardarInteracion($interaccion);
            } catch (RuntimeException $e) {
                $this->flashmessenger()->addErrorMessage("Ya ha postulado o es propietario de este empleo" . "Empleo: " . $empleo->titulo);
                return $this->redirect()->toRoute('empleos', ['action' => 'listar-empleos']);
            }            

            return new ViewModel([
                'empleo' => $empleo,
                'usuario' => $this->identity(),
                'messages' => $this->flashmessenger()->getMessages(),
                'errorMessages' => $this->flashmessenger()->getErrorMessages()
            ]);
        } else {
            return $this->redirect()->toRoute('ingresar');
        }
    }

}
