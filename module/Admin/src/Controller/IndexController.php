<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController 
{
    public function indexAction()
    {
        /*$recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
        
        var_dump($resp);
        
        if ($resp->isSuccess()) {
            // verified!
            // if Domain Name Validation turned off don't forget to check hostname field
            // if($resp->getHostName() === $_SERVER['SERVER_NAME']) {  }
        } else {
            $errors = $resp->getErrorCodes();
        }*/
        
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
