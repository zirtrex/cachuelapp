<?php

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mail\Message;
use Admin\Entity\Usuario;
use Users\Form\CambiarClaveForm;
use Users\Form\OlvidarClaveForm;
use Users\Form\Filter\CambiarClaveFilter;
use Users\Form\Filter\OlvidarClaveFilter;


class ReestablecerClaveController extends AbstractActionController
{
	//Cargamos el formulario para enviarle un correo al usuario confimando su cambio de contraseña.
    public function indexAction()
    {
    	$form = new OlvidarClaveForm($this->getRequest()->getBaseUrl() . '/captcha/');    	
    	
    	$request = $this->getRequest();
          
        if($request->isPost())
        {        	        	
        	$form->setInputFilter(new OlvidarClaveFilter($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')));
        	$form->setData($request->getPost());
        	
        	if ($form->isValid())
        	{
        		//\Zend\Debug\Debug::dump($form->getData());
        		
        		$formData = $form->getData();
        		
        		$rol = $formData['rol'];
        		$correo = $formData['correo'];
        		
        		$usuarioTable = $this->getServiceLocator()->get('UsuarioTable');
        		
        		switch ($rol)
        		{
        			case 'administrador':
        				$usuarioSeleccionado = 	$usuarioTable->obtenerUsuarioPorCorreo('vw_administrador', $correo);
        				break;
        			case 'docente':
        				$usuarioSeleccionado = 	$usuarioTable->obtenerUsuarioPorCorreo('vw_docente', $correo);
        				break;
        		}
        		
        		if($usuarioSeleccionado)
        		{
        			$usuario = new Usuario(); 
        			$usuario->exchangeArray($usuarioSeleccionado);
        			$usuario->setToken(md5(uniqid(mt_rand(), true))); // \Zend\Debug\Debug::dump($usuario);
        			
        			$usuarioTable->actualizarToken($usuario);
        			
        			$this->enviarCorreoConfirmacionCambioClave($usuario, $correo);
        			$this->flashMessenger()->addMessage('¡Se le ha enviado las instrucciones para restablecer su clave a su correo: ' .$correo. '!');
        			return $this->redirect()->toRoute('reestablecer-clave');
        		}
        		else
        		{
        			$this->flashMessenger()->addErrorMessage('¡El correo ingresado no tiene asignado ningún usuario, intente de nuevo!');
        			return $this->redirect()->toRoute('reestablecer-clave');
        		}
        	}
        }
        
        $this->layout('layout/login');
        
        return new ViewModel(array(        		
        		'form' => $form,
        		'messages' => $this->flashmessenger()->getMessages(),
        		'errorMessages' => $this->flashmessenger()->getErrorMessages(),
        ));
        
    }
	//Enviamos el correo a través del mail.transport
    public function enviarCorreoConfirmacionCambioClave($usuario, $correo)
    {
    	try
    	{
    		$transport = new \Zend\Mail\Transport\Sendmail();
    		//$transport = $this->getServiceLocator()->get('MailTransport');
	    	$message = new Message();
    	
    		$hostname    = $_SERVER['HTTP_HOST'];
    		 
    		$fullLink = "http://" . $hostname . $this->url()->fromRoute('reestablecer-clave', array('action' => 'confirmar-cambio-clave', 'rol' => $usuario->getRol(), 'token' => $usuario->getToken()));
    	
	    	//$this->getRequest()->getServer();
	    	
	    	$message->addTo($correo)
	    		->addFrom('rcontreras@grupoparada.com')
	    		->setSubject('Por favor, confirma tu solicitud para cambio de contraseña!')
		    	->setBody('Hola, '. $usuario->getUsuario() .". Por favor, sigue el siguiente enlace: " .$fullLink. " para confirmar tu solicitud de cambio de clave.");
    	
	    	$transport->send($message);
	    	return true;
    	}
    	catch (\Exception $ex)
    	{
	    	throw new \Exception($ex);
	    	return false;
    	}
    }
	//Recibimos la confirmación del usuario para el cambio de clave
    public function confirmarCambioClaveAction()
    {
    	$rol = $this->params()->fromRoute('rol');
    	$token = $this->params()->fromRoute('token');   	
    	
    	$usuarioTable = $this->getServiceLocator()->get('UsuarioTable');
    	
    	$usuarioSeleccionado = null;
    	
    	switch ($rol)
    	{
    		case 'administrador':
    			$usuarioSeleccionado = 	$usuarioTable->obtenerUsuarioPorToken('vw_administrador', $token);
    			break;
    		case 'docente':
    			$usuarioSeleccionado = 	$usuarioTable->obtenerUsuarioPorToken('vw_docente', $token);
    			break;
    	}
    	
    	if ($rol !== '' && $token !== '' && $usuarioSeleccionado != null)
    	{
    		$form = new CambiarClaveForm($this->getRequest()->getBaseUrl() . '/captcha/');    		
    		$form->get('token')->setValue($token);    		
    		
    		$request = $this->getRequest();
    		
    		if($request->isPost())
    		{
    			$form->setInputFilter(new CambiarClaveFilter());
    			$form->setValidationGroup(array('nuevaClave', 'confirmarNuevaClave'));
    			$form->setData($request->getPost());
    			 
    			if ($form->isValid())
    			{
    				$formData = $form->getData();
    				
    				$clave = $formData['nuevaClave']; //\Zend\Debug\Debug::dump($form->getData()); return;    				
    				
    				$usuario = new Usuario();
    				$usuario->exchangeArray($usuarioSeleccionado);    				
    				$usuario->setClave($clave);
    				
    				if($usuarioTable->actualizar($usuario))
    				{
    					$this->enviarConfirmacionCambioClave($usuario, $usuarioSeleccionado['correo']);
    					$this->flashMessenger()->addMessage('¡Su clave a sido cambiada!');
    					$usuario->setToken(md5(uniqid(mt_rand(), true))); //cambiamos el token para que se inválide en una segunda confirmación
    					$usuarioTable->actualizarToken($usuario);
    					$this->flashMessenger()->addErrorMessage('¡Su clave ha sido cambiada!');
    					return $this->redirect()->toRoute('ingresar');
    				}
    				else
    				{
    					$this->flashMessenger()->addErrorMessage('¡Ha ocurrido un error al guardar su nueva clave, intente de nuevo!');
    					return $this->redirect()->toRoute('reestablecer-clave', array('action' => 'confirmar-cambio-clave', 'token' => $token));
    				}
    			}
    		}
    		
    		$this->layout('layout/login');
    		
    		return new ViewModel(array(
    				'form' => $form,
    				'data' => array('rol' => $rol, 'token' => $token),
    				'messages' => $this->flashmessenger()->getMessages(),
    				'errorMessages' => $this->flashmessenger()->getErrorMessages(),
    		));
    	}
		else
		{
			throw new \Exception('¡Ha Ocurrido un error, comuníquese con el administrador!');
		}
    }
    
    public function enviarConfirmacionCambioClave($usuario, $correo)
    {
    	try {
    		
    		$transport = new \Zend\Mail\Transport\Sendmail();
    		//$transport = $this->getServiceLocator()->get('MailTransport');
    		
	    	$hostname    = $_SERVER['HTTP_HOST'];
	    	
	    	$fullLink = "http://" . $hostname . $this->url()->fromRoute('ingresar');	    
	    	
	    	$message = new Message();
	    	$this->getRequest()->getServer(); 
	    	$message->addTo($correo)
	    		->addFrom('rcontreras@grupoparada.com')
	    		->setSubject('Tu clave ha sido cambiada!')
	    		->setBody('Hola de nuevo '.$usuario->getUsuario(). ' Tu clave ha sido cambiada. <br> Por favor, sigue el siguiente enlace: ' . $fullLink . ', para ingresar al sistema.'
	    	);
	    	
	    	$transport->send($message);
	    	return true;
    	}
    	catch (\Exception $ex)
    	{
    		throw new \Exception($ex);
    		return false;
    	}
    }
   
}















