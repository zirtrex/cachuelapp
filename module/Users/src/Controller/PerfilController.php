<?php

namespace Users\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\File\Size;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Admin\Entity\Administrador;
use Admin\Entity\Docente;
use Admin\Entity\Usuario;

 
class PerfilController extends AbstractActionController
{
    protected $personaTable;
    protected $usuarioTable;
    
    public function indexAction()
    {       
        if ($this->identity())
        { 
            $formManager = $this->getServiceLocator()->get('FormElementManager');
            $editarUsuarioForm = $formManager->get('Users\Form\EditarUsuarioForm');
            
            $cambiarClaveForm = new \Users\Form\CambiarClaveForm($this->getRequest()->getBaseUrl() . '/captcha/');
            
            $subirImagenForm = new \Users\Form\SubirImagenForm();       
            
            switch ($this->identity()['rol'])
            {
            	case 'administrador':
            		$administrador = new Administrador();
            		$administrador->exchangeArray($this->obtenerDatosUsuario());
            		
            		$editarUsuarioForm->setHydrator(new ClassMethodsHydrator(false))->setObject(new Administrador());           		
            		$editarUsuarioForm->bind($administrador);
            		
            		break;
            		
            	case 'docente':
            		$docente = new Docente();
            		$docente->exchangeArray($this->obtenerDatosUsuario());
            		
            		$editarUsuarioForm->setHydrator(new ClassMethodsHydrator(false))->setObject(new Docente());
            		$editarUsuarioForm->bind($docente);            		
            		
            		break;            		
            }
            
            $viewModel = new ViewModel(array(
                    'editarUsuarioForm' => $editarUsuarioForm,
            		'cambiarClaveForm' => $cambiarClaveForm,
            		'subirImagenForm' => $subirImagenForm,
            		'messages' => $this->flashmessenger()->getMessages(),
            		'errorMessages' => $this->flashmessenger()->getErrorMessages(),
            ));

            $this->layout('layout/admin');
            
            return $viewModel;
        }

        return $this->redirect()->toRoute('ingresar');
        
    }
	
    //Editar los datos del usuario
    public function editarPerfilAction()
    {
    	if($this->identity())
    	{
    		$formManager = $this->getServiceLocator()->get('FormElementManager');
    		$editarUsuarioForm = $formManager->get('Users\Form\EditarUsuarioForm');
    		
    		$cambiarClaveForm = new \Users\Form\CambiarClaveForm($this->getRequest()->getBaseUrl() . '/captcha/');
    		
    		$subirImagenForm = new \Users\Form\SubirImagenForm(); 		
    		
    		switch ($this->identity()['rol'])
    		{
    			case 'administrador':
    				$administrador = new Administrador();
    				$administrador->exchangeArray($this->obtenerDatosUsuario());
    		
    				$editarUsuarioForm->setHydrator(new ClassMethodsHydrator(false))->setObject(new Administrador());
    				$editarUsuarioForm->bind($administrador);
    				
    				$editarUsuarioForm->setInputFilter(new \Admin\Form\Filter\AdministradorFilter());
    				$editarUsuarioForm->setValidationGroup(array(
    						'codAdministrador',
    						'Persona' => array('codPersona', 'nombres', 'primerApellido', 'segundoApellido','correo', 'celular')
    				));
    		
    				break;
    		
    			case 'docente':
    				$docente = new Docente();
    				$docente->exchangeArray($this->obtenerDatosUsuario());
    		
    				$editarUsuarioForm->setHydrator(new ClassMethodsHydrator(false))->setObject(new Docente());
    				$editarUsuarioForm->bind($docente);
    				
    				$editarUsuarioForm->setInputFilter(new \Admin\Form\Filter\DocenteFilter());
    				$editarUsuarioForm->setValidationGroup(array(
    						'codDocente',
    						'Persona' => array('codPersona', 'nombres', 'primerApellido', 'segundoApellido', 'correo', 'celular')
    				));
    		
    				break;
    		}
    		
    		$request = $this->getRequest();
    	
    		if($request->isPost())
    		{    	
    			$editarUsuarioForm->setData($request->getPost());
    			 
    			if ($editarUsuarioForm->isValid())
    			{
    				$administrador = $editarUsuarioForm->getData();
    	
    				$persona = $administrador->getPersona();
    	
    				if($this->getDBPersonaTable()->actualizar($persona))
    				{
    					$this->flashMessenger()->addMessage('¡Sus datos han sido cambiado correctamente!');
    					return $this->redirect()->toRoute('perfil');
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
    				'subirImagenForm' => $subirImagenForm,
    				'messages' => $this->flashmessenger()->getMessages(),
    				'errorMessages' => $this->flashmessenger()->getErrorMessages(),
    		));
    	
    		$view->setTemplate('users/perfil/index.phtml');
    		$this->layout('layout/admin');
    		return $view;
    	}
    	 
    	return $this->redirect()->toRoute('ingresar');
    } 
	
    //Cambiar la clave del usuario
	public function cambiarClaveAction()
    {
    	if ($this->identity())
    	{
    		$formManager = $this->getServiceLocator()->get('FormElementManager');
    		$editarUsuarioForm = $formManager->get('Users\Form\EditarUsuarioForm');
    		
    		$cambiarClaveForm = new \Users\Form\CambiarClaveForm($this->getRequest()->getBaseUrl() . '/captcha/');
    		
    		$subirImagenForm = new \Users\Form\SubirImagenForm();
    		
    		switch ($this->identity()['rol'])
    		{
    			case 'administrador':
    				$administrador = new Administrador();
    				$administrador->exchangeArray($this->obtenerDatosUsuario());
    		
    				$editarUsuarioForm->setHydrator(new ClassMethodsHydrator(false))->setObject(new Administrador());
    				$editarUsuarioForm->bind($administrador);
    		
    				$editarUsuarioForm->setInputFilter(new \Admin\Form\Filter\AdministradorFilter());
    				$editarUsuarioForm->setValidationGroup(array(
    						'codAdministrador',
    						'Persona' => array('codPersona', 'nombres', 'primerApellido', 'segundoApellido','correo', 'celular')
    				));
    		
    				break;
    		
    			case 'docente':
    				$docente = new Docente();
    				$docente->exchangeArray($this->obtenerDatosUsuario());
    		
    				$editarUsuarioForm->setHydrator(new ClassMethodsHydrator(false))->setObject(new Docente());
    				$editarUsuarioForm->bind($docente);
    		
    				$editarUsuarioForm->setInputFilter(new \Admin\Form\Filter\DocenteFilter());
    				$editarUsuarioForm->setValidationGroup(array(
    						'codDocente',
    						'Persona' => array('codPersona', 'nombres', 'primerApellido', 'segundoApellido', 'correo', 'celular')
    				));
    		
    				break;
    		}    		
    		
    		$request = $this->getRequest();
    		
    		if ($request->isPost())
    		{      		      			
    			$cambiarClaveForm->setData($request->getPost());
    			$cambiarClaveForm->setInputFilter(new \Users\Form\Filter\CambiarClaveFilter());
    			
    			if ($cambiarClaveForm->isValid())
    			{
    				$data = $cambiarClaveForm->getData();
    				
    				$claveActual = (string) md5($data['anteriorClave']);
    				$nuevaClave = (string) md5($data['nuevaClave']);
    				
    				$usuarioTable = $this->getDBUsuarioTable();
    				
    				$usuarioSeleccionado = $usuarioTable->obtenerUsuario($this->obtenerDatosUsuario()['codUsuario']);

    				
    				$usuario = new Usuario();
    				$usuario->exchangeArray($usuarioSeleccionado);
    				
    				$claveOriginal = (string) $usuario->getClave();

    
    				if ($claveOriginal == $claveActual)
    				{
    					
    					$usuario->setClave($nuevaClave);
    					
    					if($usuarioTable->actualizar($usuario))
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
    		$this->layout('layout/admin');
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
				// $profile = new Profile();
				$nonFile = $request->getPost()->toArray();
				$File    = $this->params()->fromFiles('imagen');
				$data = array_merge($nonFile, array('imagen'=> $File['name']));
 
				$form->setData($data);
                      
                if ($form->isValid())
				{   
					$size = new Size(array('min'=>2000)); //minimum bytes filesize
					$adapter = new \Zend\File\Transfer\Adapter\Http();
					
					$adapter->setValidators(array($size), $File['name']);
					
					if (!$adapter->isValid())
					{
						$dataError = $adapter->getMessages();
						$error = array();
						foreach($dataError as $key=>$row)
						{
							$error[] = $row;
						}
					
						$response->setContent(\Zend\Json\Json::encode(array('response' => false, 'error'=> $error)));
						
						return $response;
						//$form->setMessages(array('fileupload'=>$error ));
					}
					else
					{
						$destination = $this->getFileUploadLocation();
						
						$extension = pathinfo($File['name'], PATHINFO_EXTENSION);
						
						$nombreImagen = time() . substr(md5(microtime()), 0, rand(5, 12)) . "." . $extension;
						
						$adapter->addFilter('File\Rename', array(
								'target' => $destination . '/' . $nombreImagen,
						));
						
						$adapter->setDestination($destination);
						
						if ($adapter->receive($File['name']))
						{
							//guardar la imagen del usuario
							$persona = array(									
									'codPersona'=> $this->obtenerDatosUsuario()['codPersona'],
									'imagen'	=> $nombreImagen
							);
						
							$updated = $this->getDBPersonaTable()->actualizarImagen($persona);
						
							if ($updated)
							{
								$response->setContent(\Zend\Json\Json::encode(array('response' => true,'message'=>'Imagen guardada correctamente::')));
							}
							else
							{
								$response->setContent(\Zend\Json\Json::encode(array('response' => false,'message'=>'Fallo el guardado de la imagen')));
							}
						
						}
						else
						{
							$response->setContent(\Zend\Json\Json::encode(array('response' => false,'message'=>'¡Ha ocurrido un error inesperado!')));						
						}
					}
				}  
			}
			
            return $response;
        }        

    }

    private  function getDBPersonaTable()
    {
        if (!$this->personaTable)
        {
            $this->personaTable = $this->getServiceLocator()->get('PersonaTable');
        }
        return $this->personaTable;
    }

    private  function getDBUsuarioTable()
    {
        if (!$this->usuarioTable)
        {
            $this->usuarioTable = $this->getServiceLocator()->get('UsuarioTable');
        }
        return $this->usuarioTable;
    }

    public function getFileUploadLocation()
    {
        $config = $this->getServiceLocator()->get('config');
        return $config['module_config']['perfil_location'];
    }

    private function obtenerDatosUsuario()
    {
        $rol = $this->identity()['rol'];
        $codUsuario = $this->identity()['codUsuario'];
        
        if ($rol == "administrador")
        {
        	$administradorTable = $this->getServiceLocator()->get('AdministradorTable');
        	return $administradorTable->obtenerAdministradorPorCodUsuario($codUsuario);
        }
        
        else if($rol == "docente")
        {
            $docenteTable = $this->getServiceLocator()->get('DocenteTable');
            return $docenteTable->obtenerDocentePorCodUsuario($codUsuario);
        }        

        return false;
    }

}









