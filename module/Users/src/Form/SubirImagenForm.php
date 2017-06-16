<?php
namespace Users\Form;

use Zend\Form\Form;


class SubirImagenForm extends Form
{    
    public function __construct()
    {
        
        parent::__construct('SubirImagenForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');        
        
        
        $this->add(array(
        		'name' => 'imagen',
        		'type' => 'Zend\Form\Element\File',
        		'attributes' => array(
        				'required' => 'required',
        				'id' => 'imagen',
        				'class' => 'form-control hidden',
        		)
        ));
    }
}
