<?php
namespace Users\Form;

use Zend\Form\Form;
//use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
//use Admin\Entity\Persona;

class EditarUsuarioForm extends Form
{
    protected $selectTable;
    
    public function init()
    {        
        
    	parent:: __construct('EditarUsuarioForm');

        //$this->setHydrator(new ClassMethodsHydrator(false))->setObject(new Persona());

    	$this->setAttribute('method', 'post');

    	$this->add(
                array(
                        'type' => 'PersonaFieldset',
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
        						'class' => 'btn btn-success',
        				),
        		)
        );
    }  
}