<?php
namespace Users\Form;
 
use Zend\Form\Form;
//use Zend\Captcha;
//use Zend\Form\Element; 


class LoginForm extends Form 
{
    public function __construct()
    {
        parent::__construct('LoginForm');
 
        $this->setAttributes(array('method' => 'post',));
 
        $this->add(
            array(
                'name' => 'usuario',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                    'placeholder' => 'Ingrese su usuario',
                    'required' => 'required',
                	'class' => 'uk-input uk-form-width-medium',
                ),
                'options' => array(
                    'label' => 'Usuario',
                    'label_attributes' => array(
                        'class' => 'control-label'
                    ),
                ),
            )
        );
 
        $this->add(
            array(
                'name' => 'clave',
                'type' => 'Zend\Form\Element\Password',
                'attributes' => array(
                    'placeholder' => 'Ingrese su clave',
                    'required' => 'required',
                	'class' => 'uk-input uk-form-width-medium',
                ),
                'options' => array(
                    'label' => 'Clave',
                    'label_attributes' => array(
                        'class' => 'control-label'
                    ),
                ),
            )
        );
        
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf'
        ));
        
        $this->add(
        		array(
        				'name' => 'session_token',
        				'type' => 'hidden',
        				'attributes' => array(
        						'id' => 'session_token'
        				),
        		)
        );
 
        $this->add(
            array(
                'name' => 'ingresar',
                'type' => 'Zend\Form\Element\Submit',
                'attributes' => array(
                    'value' => 'Ingresar',
                    'class' => 'uk-button',
                    'id' => 'loginbutton',
                ),
            )
        ); 
    }
}