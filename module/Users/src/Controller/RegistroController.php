<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\UsuarioTable;
use Admin\Entity\Usuario;
use Admin\Model\Miscellanea;
use Admin\Factory\MailFactory;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;

class RegistroController extends AbstractActionController
{
    private $dbAdapter;
    private $usuarioTable;
    private $mailFactory;
    
    // Add this constructor:
    public function __construct(UsuarioTable $usuarioTable, $dbAdapter, Sendmail $mailFactory)
    {
        $this->usuarioTable = $usuarioTable;
        $this->dbAdapter = $dbAdapter;
        $this->mailFactory = $mailFactory;
    }
    
    public function indexAction()
    {
        if (!$this->identity()) {
            $form = new \Users\Form\RegistroForm();
            
            $request = $this->getRequest();
            
            if ($request->isPost()) {
                $form->setInputFilter(new \Users\Form\Filter\RegistroFilter($this->dbAdapter));
                $form->setData($request->getPost());
                
                if ($form->isValid())
                {      
                    $data = $form->getData();
                    
                    $usuario = new Usuario();
                    
                    $usuario->exchangeArray($data);
                    
                    $usuario->rol = 'user';
                    $usuario->tokenRegistro = md5(uniqid(mt_rand(), true));
                    $usuario->fechaRegistro = gmdate("Y-m-d H:i:s", Miscellanea::getHoraLocal(-5));
                    $usuario->correoConfirmado = '0';
                    
                    $this->usuarioTable->guardarUsuario($usuario);
                    
                    $this->enviarCorreoConfirmacion($usuario);                        
                    $this->flashMessenger()->addMessage('Se ha enviado un mensaje a '.$usuario->correo. ', por favor confirmar. Si no lo ha recibido aún, verifique la carpeta de spam');
                    return $this->redirect()->toRoute('registro');
                }
                //\Zend\Debug\Debug::dump($form->getInputFilter()->getMessages());

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
    
    public function confirmarCorreoAction()
    {
        $token = $this->params()->fromRoute('token');
        
        try {
            
            $usuario = $this->usuarioTable->obtenerUsuarioPorToken($token);
            
            if ($usuario) {
                $usuario->tokenRegistro = md5(uniqid(mt_rand(), true)); // cambiar el token
                $usuario->correoConfirmado = "1";
                $this->usuarioTable->guardarUsuario($usuario);
            } else {
                return $this->redirect()->toRoute('ingresar');
            }
        } catch (\Exception $e) {
            \Zend\Debug\Debug::dump("Ha ocurrido un error al validar el correo."); return;
        }
    
        return new ViewModel([]); 
    }
    
    public function enviarCorreoConfirmacion($usuario)
    {
        $hostname    = $_SERVER['HTTP_HOST'];
        $fullLink = "http://" . $hostname . $this->url()->fromRoute('confirmar-correo', array(
            'controller' => 'registro',
            'action' => 'confirmar-correo',
            'token' => $usuario->tokenRegistro));
        
        $transport = $this->mailFactory;
        
        $message = new Message(); 
        $this->getRequest()->getServer();
        
        $message->addTo($usuario->correo)
            ->addFrom('rcontreras@zirtrex.net')
            ->setSubject('Por favor, confirma tu correo (CACHUELAPP)!')
            ->setBody("Por favor, Click en el enlace para confirmar tu registro => " . $fullLink );
        
        $transport->send($message);
    }
}

