<?php
namespace Users\Form;

use Zend\Form\Form;


class CambiarClaveForm extends Form
{

    public function __construct($urlcaptcha)
    {
        parent::__construct('CambiarClaveForm');
        
        $this->setAttributes(array(
            'method' => 'post',
            'class' => 'uk-form'
        ));
        
        $this->add(array(
            'name' => 'anteriorClave',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => 'Ingrese su clave anterior',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Clave anterior',
                'label_attributes' => array(
                    'class' => 'uk-form-label'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'nuevaClave',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => 'Ingrese su nueva clave',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Nueva clave',
                'label_attributes' => array(
                    'class' => 'uk-form-label'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'confirmarNuevaClave',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => 'Repita su nueva clave',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Confirmar nueva clave',
                'label_attributes' => array(
                    'class' => 'uk-form-label'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 1200
                )
            )
        ));
        
        $this->add(array(
            'name' => 'token',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'token'
            )
        ));
        
        $this->add(array(
            'name' => 'enviar',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Cambiar Clave',
                'class' => 'uk-button uk-button-primary',
                'id' => 'cambiar-clave'
            )
        ));
    }
}
