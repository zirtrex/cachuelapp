<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RegistroController extends AbstractActionController
{
     public function indexAction(){
        
         if(!$this->identity()){
             return new ViewModel([
             
             ]);
         }else{
             return $this->redirect()->toRoute('home');
         }
         
        
    }
}

