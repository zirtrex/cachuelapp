<?php
namespace Users\Form\Filter;

use Zend\InputFilter\InputFilter;

class LoginFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'usuario',
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
                        'min' => '4',
                        'max' => '10'
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'clave',
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
                        'min' => '4',
                        'max' => '16'
                    )
                )
            )
        )
        );
        
        $this->add(array(
            'name' => 'csrf',
            'required' => true
        ));
        
    }
}