<?php

namespace Users\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Entity\Usuario;
use Interop\Container\ContainerInterface;
use Admin\Model\EmpleoTable;
use Admin\Model\UsuarioTable;
use Admin\Model\InteraccionTable;
use Admin\Model\UbicacionTable;
use Users\Form\EditarUsuarioForm;
use Users\Form\CambiarClaveForm;
use Users\Form\SubirImagenForm;

 
class PerfilController extends AbstractActionController
{    
    private $container;
    private $empleoTable;
    private $usuarioTable;
    private $interaccionTable;
    private $ubicacionTable;
    // The image manager.
    private $imageManager;
    
    public function __construct(ContainerInterface $container,
        EmpleoTable $empleoTable, UsuarioTable $usuarioTable,
        InteraccionTable $interaccionTable, UbicacionTable $ubicacionTable)
    {
        $this->container = $container;
        $this->empleoTable = $empleoTable;
        $this->usuarioTable = $usuarioTable;
        $this->interaccionTable = $interaccionTable;
        $this->ubicacionTable = $ubicacionTable;
        $this->imageManager = null;
    }
    
    public function indexAction()
    {       
        if ($this->identity())
        { 
            $formManager = $this->container->get('FormElementManager');            
            $editarUsuarioForm = $formManager->get(EditarUsuarioForm::class);
            
            $cambiarClaveForm = new \Users\Form\CambiarClaveForm($this->getRequest()->getBaseUrl() . '/captcha/');
            
            $subirImagenForm = new \Users\Form\SubirImagenForm();
            
            $codUsuario = $this->identity()['codUsuario'];            
    		$usuario = $this->usuarioTable->obtenerUsuario($codUsuario);
    		$editarUsuarioForm->bind($usuario);            		

            
            $viewModel = new ViewModel(array(
                    'editarUsuarioForm' => $editarUsuarioForm,
            		'cambiarClaveForm' => $cambiarClaveForm,
            		'subirImagenForm' => $subirImagenForm,
            		'messages' => $this->flashmessenger()->getMessages(),
            		'errorMessages' => $this->flashmessenger()->getErrorMessages(),
            ));

            
            return $viewModel;
        }

        return $this->redirect()->toRoute('ingresar');
        
    }
	
    //Editar los datos del usuario
    public function editarPerfilAction()
    {
    	if($this->identity())
    	{
    		$formManager = $this->container->get('FormElementManager');            
            $editarUsuarioForm = $formManager->get(EditarUsuarioForm::class);
    		
    		$cambiarClaveForm = new \Users\Form\CambiarClaveForm($this->getRequest()->getBaseUrl() . '/captcha/');
    		
    		$subirImagenForm = new \Users\Form\SubirImagenForm(); 		
    		
    		$codUsuario = $this->identity()['codUsuario'];
    		$usuario = $this->usuarioTable->obtenerUsuario($codUsuario);
    		$editarUsuarioForm->bind($usuario);
    		
    		$request = $this->getRequest();
    	
    		if($request->isPost())
    		{    	
    			$editarUsuarioForm->setData($request->getPost());
    			 
    			if ($editarUsuarioForm->isValid())
    			{
    				$usuario = $editarUsuarioForm->getData();				
    				
    				$ubicacion = $usuario->Ubicacion;
    				
				    if($codUbicacion = $this->ubicacionTable->guardarUbicacion($ubicacion))
				    {				        
				        $usuario->Ubicacion->codUbicacion = $codUbicacion;
				        
				        if($this->usuarioTable->guardarUsuario($usuario))
				        {
    				        $this->flashMessenger()->addMessage('¡Sus datos han sido cambiado correctamente!');
    				        return $this->redirect()->toRoute('perfil');
    				    }				
    				}
    				else
    				{
    					$this->flashMessenger()->addErrorMessage('¡Ha ocurrido un error al guardar los datos!');
    					return $this->redirect()->toRoute('perfil');
    				}    					
    				    	
    			}
    	
    		}
    	
    		$view = new ViewModel(array(
    				'editarUsuarioForm' => $editarUsuarioForm,
    				'cambiarClaveForm' => $cambiarClaveForm,
    				'messages' => $this->flashmessenger()->getMessages(),
    				'errorMessages' => $this->flashmessenger()->getErrorMessages(),
    		));
    	
    		//$this->layout('layout/layout');
    		return $view;
    	}
    	 
    	return $this->redirect()->toRoute('ingresar');
    } 
	
    //Cambiar la clave del usuario
	public function cambiarClaveAction()
    {
    	if ($this->identity())
    	{
    		$formManager = $this->container->get('FormElementManager');            
            $editarUsuarioForm = $formManager->get(EditarUsuarioForm::class);
    		
    		$cambiarClaveForm = new \Users\Form\CambiarClaveForm($this->getRequest()->getBaseUrl() . '/captcha/');
    		
    		$subirImagenForm = new \Users\Form\SubirImagenForm(); 		
    		
    		$codUsuario = $this->identity()['codUsuario'];
    		$usuario = $this->usuarioTable->obtenerUsuario($codUsuario);
    		$editarUsuarioForm->bind($usuario);
    		
    		$request = $this->getRequest();
    		
    		if ($request->isPost())
    		{      		      			
    			$cambiarClaveForm->setData($request->getPost());
    			$cambiarClaveForm->setInputFilter(new \Users\Form\Filter\CambiarClaveFilter());
    			
    			if ($cambiarClaveForm->isValid())
    			{
    				$data = $cambiarClaveForm->getData();
    				
    				$claveActual = (string) $data['anteriorClave']; //md5($data['anteriorClave']);
    				$nuevaClave = (string) $data['nuevaClave']; //md5($data['nuevaClave']);
    				
    				$usuario = $this->usuarioTable->obtenerUsuario($this->identity()['codUsuario']);
    				
    				$claveOriginal = (string) $usuario->clave;
    
    				if ($claveOriginal == $claveActual)
    				{    					
    					$usuario->clave = $nuevaClave;
    					
    					if($this->usuarioTable->guardarUsuario($usuario))
    					{
    						$this->flashMessenger()->addMessage('¡Su clave ha sido cambiada correctamente, vuelva a ingresar por favor!');    						
    						return $this->redirect()->toRoute('salir');
    					}
    					
    				}
    				else
    				{ 
    					$this->flashMessenger()->addErrorMessage('¡La clave proporcionada no es correcta');
    					return $this->redirect()->toRoute('perfil', array('action' => 'cambiar-clave'));
    				}
    			}
    			$error = true;
    		}
    		
    		$view = new ViewModel(array(
    				'editarUsuarioForm' => $editarUsuarioForm,
    				'cambiarClaveForm' => $cambiarClaveForm,
    				'subirImagenForm' => $subirImagenForm,
    				'messages' => $this->flashmessenger()->getMessages(),
    				'errorMessages' => $this->flashmessenger()->getErrorMessages(),
    		));
    		 
    		$view->setTemplate('users/perfil/index.phtml');
    		return $view;
    
    	}
    	return $this->redirect()->toRoute('ingresar');
    }

    //Subir imagen a través de ajax
    public function subirImagenAction()
    {
        if ($this->identity())
        {
        	$response = $this->getResponse();

			$form = new \Users\Form\SubirImagenForm();
               	
			$request = $this->getRequest();  

			if ($request->isPost())
            {				
				$data = array_merge_recursive(
				    $request->getPost()->toArray(),
				    $request->getFiles()->toArray()
				);
				
				$form->setInputFilter(new \Users\Form\Filter\SubirImagenFilter());

				$form->setData($data);
                      
                if ($form->isValid())
				{   
				    $data = $form->getData();
				    
				    $File = $data['imagen'];
				    
				    $destination =  './public/img/perfil/';				    	
				    	
				    $extension = pathinfo($File['name'], PATHINFO_EXTENSION);
				    	
				    $nombreImagen = $this->identity()['usuario'] . "." . $extension;
				    
				    //$nombreImagen = time() . substr(md5(microtime()), 0, rand(5, 12)) . "." . $extension;
				    	
				    if(rename($destination . $File['name'], $destination.$nombreImagen)){

    					//guardar la imagen del usuario
    					$usuario = $this->usuarioTable->obtenerUsuario($this->identity()['codUsuario']);
    				    
    					$usuario->imagenPerfil	= $nombreImagen;
    					
    					$updated = $this->usuarioTable->guardarUsuarioImagen($usuario);
    				
    					if ($updated)
    					{
    						$response->setContent(\Zend\Json\Json::encode(array('response' => true, 'message'=>'Imagen guardada correctamente.')));
    					}
    					else
    					{					    
    						$response->setContent(\Zend\Json\Json::encode(array('response' => false, 'message'=>'Fallo el guardado de la imagen.')));
    					}
				    }

				}
				else{
				    //var_dump($form->get('imagen')); return;
				    $response->setContent(\Zend\Json\Json::encode(array('response' => false, 'errores'=> $form->get('imagen')->getMessages())));
				}
			}
			
            return $response;
        }        

    }

}









