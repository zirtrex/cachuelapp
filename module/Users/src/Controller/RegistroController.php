<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RegistroController extends AbstractActionController
{

    public function indexAction()
    {
        if (! $this->identity()) {
            $form = new \Users\Form\RegistroForm();
            $form->get('session_token')->setAttribute('value', 'hola');
            
            $request = $this->getRequest();
            
            if ($request->isPost()) {
                $form->setInputFilter(new \Users\Form\Filter\RegistroFilter());
                $form->setData($request->getPost());
                
                if ($form->isValid()) {                    
                        
                        $formData = $form->getData();

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

