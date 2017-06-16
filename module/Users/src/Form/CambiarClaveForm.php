<?php
namespace Users\Form;

use Zend\Form\Form;
use Zend\Captcha\Figlet as CaptchaFiglet;


class CambiarClaveForm extends Form
{
    public function __construct($urlcaptcha)
    {
        parent::__construct('CambiarClaveForm');
        
        $this->setAttribute('method', 'post');
       
        $this->add(array(
        		'name' => 'anteriorClave',
        		'type' => 'Zend\Form\Element\Password',
        		'attributes' => array(
        				'required' => 'required',
        				'placeholder' =>'Ingrese su clave anterior',
        				'class' => 'form-control',
        		),
        		'options' => array(
        				'label' => 'Clave anterior',
        				'label_attributes' => array(
        						'class' => 'col-sm-3 control-label'
        				),
        		),
        ));

 		$this->add(array(
                'name' => 'nuevaClave',
                'type' => 'Zend\Form\Element\Password',
                'attributes' => array(
                        'required' => 'required',
                        'placeholder' =>'Ingrese su nueva clave',
                        'class' => 'form-control',
                ),
                'options' => array(
                        'label' => 'Nueva clave',
                        'label_attributes' => array(
                                'class' => 'col-sm-3 control-label'
                        ),
                ),
        ));

        $this->add(array(
                'name' => 'confirmarNuevaClave',
                'type' => 'Zend\Form\Element\Password',
                'attributes' => array(
                        'required' => 'required',
                        'placeholder' =>'Repita su nueva clave',
                        'class' => 'form-control',
                ),
                'options' => array(
                        'label' => 'Confirmar nueva clave',
                        'label_attributes' => array(
                                'class' => 'col-sm-3 control-label'
                        ),
                ),
        ));
        
        
        $this->add(array(
                'type' => 'Zend\Form\Element\Captcha',
                'name' => 'captcha',
                'attributes' => array(
                        'placeholder' =>'Ingresa el código de la imagen',
                        'required' => 'required',
                        'class' => 'form-control',
                ),
                'options' => array(
                        'label' => 'Ingresa el código generado',
                        'captcha' => new CaptchaFiglet(array('wordLen' => 6, 'timeout' => 300)),
                		'label_attributes' => array(
                				'class' => 'col-sm-3 control-label'
                		),
                ),
        ));
        
        $this->add(array(
                'name'    => 'csrf',
                'type'    => 'Zend\Form\Element\Csrf',
                'options' => array(
                        'csrf_options' => array(
                                'timeout' => 1200
                        )
                )
        ));
        
        $this->add(
                array(
                        'name' => 'token',
                        'type' => 'hidden',
                        'attributes' => array(
                                'id' => 'token'
                        ),
                )
        );

        $this->add(array(
            'name' => 'enviar',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Cambiar Clave',
                'class' => 'btn btn-success',
                'id' => 'cambiar-clave',
            ),
        ));
    }
}
