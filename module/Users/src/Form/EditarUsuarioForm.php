<?php
namespace Users\Form;

use Zend\Form\Form;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Empleos\Form\Fieldset\UbicacionFieldset;
use Admin\Entity\Usuario;


class EditarUsuarioForm extends Form
{
    protected $selectTable;
    
    public function init()
    {        
        
    	parent:: __construct('EditarUsuarioForm');

        $this->setHydrator(new ReflectionHydrator(false))->setObject(new Usuario());

    	$this->setAttribute('method', 'post');
    	
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
    	    'name' => 'enlaceFacebook',
    	    'type' => 'Zend\Form\Element\Text',
    	    'attributes' => array(
    	        'id' => 'enlaceFacebook',
    	        'placeholder' => 'ejemplo: facebook.com/r.zirtrex',
    	        'class' => 'uk-input'
    	    ),
    	    'options' => array(
    	        'label' => 'Enlace Facebook',
    	        'label_attributes' => array(
    	            'class' => 'uk-form-label'
    	        )
    	    )
    	));
    	
    	$this->add(array(
    	    'name' => 'fechaNacimiento',
    	    'type' => 'Zend\Form\Element\Text',
    	    'attributes' => array(
    	        'id' => 'fechaNacimiento',
    	        'placeholder' => 'Ejemplo: 1994-06-13',
    	        'class' => 'uk-input'
    	    ),
    	    'options' => array(
    	        'label' => 'Fecha Nacimiento',
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

    	$this->add(
            array(
                'type' => UbicacionFieldset::class,
                'options' => array(
                    //'use_as_base_fieldset' => true
                )
            )
        );
    	
    	$this->add(array(
    			'name' => 'csrf',
    			'type' => 'Zend\Form\Element\Csrf'
    	));
    	
    	$this->add(
        		array(
        				'name' => 'guardar',
        				'type' => 'Zend\Form\Element\Submit',
        				'attributes' => array(
        						'value' => 'Editar datos',
        						'class' => 'uk-button uk-button-primary',
        				),
        		)
        );
    }  
}