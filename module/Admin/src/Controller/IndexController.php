<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController 
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function elegirOpcionAction()
    {
        return new ViewModel();
    }
    
    public function preguntasFrecuentesAction()
    {
        return new ViewModel();
    }
}
