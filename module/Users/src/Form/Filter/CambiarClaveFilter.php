<?php
namespace Users\Form\Filter;

use Zend\InputFilter\InputFilter;


class CambiarClaveFilter extends InputFilter
{
    public function __construct()
    {
    	$this->add(array(
    			'name'     => 'anteriorClave',
    			'required' => true,
    			'filters'  => array(
    					array('name' => 'StripTags'),
    					array('name' => 'StringTrim'),
    			),
    			'validators' => array(
    					array(
    							'name'    => 'StringLength',
    							'options' => array(
    									'encoding' => 'UTF-8',
    									'min'      => 4,
    									'max'      => 16,
    							),
    					),
    			),
    	));
    	
    	$this->add(array(
            'name'     => 'nuevaClave',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 4,
                        'max'      => 16,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'confirmarNuevaClave',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 4,
                        'max'      => 16,
                    ),
                ),
                array(
                    'name'    => 'Identical',
                    'options' => array(
                        'token' => 'nuevaClave',
                        'messages' => array(
                        		\Zend\Validator\Identical::NOT_SAME => 'La nueva clave no coincide.',
                        ),
                    ),
                ),
            ),
        ));
    }
}
