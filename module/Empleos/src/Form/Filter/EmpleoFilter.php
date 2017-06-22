<?php
namespace Empleos\Form\Filter;

use Zend\InputFilter\InputFilter;

class EmpleoFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'titulo',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 200
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'remuneracion',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 20
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'horas',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 3
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'descripcion',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 10,
                        'max' => 500
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'csrf',
            'required' => true
        ));        
        
    }
}