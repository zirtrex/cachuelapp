<?php
namespace Users\Form;

use Zend\Form\Form;

class RegistroForm extends Form
{

    public function __construct()
    {
        parent::__construct('RegistroForm');
        
        $this->setAttributes(array(
            'method' => 'post',
            'class' => 'uk-form',
        ));
        
        $this->add(array(
            'name' => 'codUsuario',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'codUsuario'
            )
        ));
        
        $this->add(array(
            'name' => 'nombres',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'nombres',
                'placeholder' => 'Ingrese nombre(s)',
                'required' => 'required',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Nombre(s)',
                'label_attributes' => array(
                    'class' => 'uk-form-label'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'primerApellido',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'primerApellido',
                'placeholder' => 'Ingrese primer apellido',
                'required' => 'required',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Primer Apellido',
                'label_attributes' => array(
                    'class' => 'uk-form-label'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'segundoApellido',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'segundoApellido',
                'placeholder' => 'Ingrese segundo apellido',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Segundo Apellido',
                'label_attributes' => array(
                    'class' => 'uk-form-label'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'numeroDNI',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'numeroDNI',
                'placeholder' => 'Ingrese número de documento',
                'required' => 'required',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Número de documento',
                'label_attributes' => array(
                    'class' => 'uk-form-label'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'correo',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array(
                'id' => 'correo',
                'placeholder' => 'Ingrese correo',
                'required' => 'required',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Correo',
                'label_attributes' => array(
                    'class' => 'uk-form-label'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'celular',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'celular',
                'placeholder' => 'Ingrese celular',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Celular',
                'label_attributes' => array(
                    'class' => 'uk-form-label'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'usuario',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Ingrese su usuario',
                'required' => 'required',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Usuario',
                'label_attributes' => array(
                    'class' => 'uk-form-label'
                )
            )
        ));
        
        $this->add(array(
            'name' => 'clave',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => 'Ingrese su clave',
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
            'name' => 'confirmarClave',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => 'Repita su clave',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Confirmar nueva clave',
                'label_attributes' => array(
                    'class' => 'uk-form-label'
                )
            )
        ));
        
        /*
         * $this->add(array(
         * 'type' => 'captcha',
         * 'name' => 'captcha',
         * 'attributes' => array(
         * 'placeholder' => 'Ingresa el código de la imagen',
         * 'required' => 'required',
         * 'class' => 'uk-input uk-form-width-medium'
         * ),
         * 'options' => [
         * 'label' => 'Ingresa el código generado',
         * 'captcha' => [
         * 'class' => 'Figlet',
         * 'wordLen' => 6,
         * 'expiration' => 600,
         * ],
         * 'label_attributes' => array(
         * 'class' => 'col-sm-3 control-label'
         * )
         * ]
         * ));
         */
        
        
        $this->add(array(
            'name' => 'registrarse',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Registrarse',
                'class' => 'uk-button uk-button-primary',
                'id' => 'registrarse'
            )
        ));
    }
}