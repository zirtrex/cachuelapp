<?php
namespace Users\Form\Filter;

use Zend\InputFilter\InputFilter;

class RegistroFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'nombres',
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
                        'max' => 45
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'primerApellido',
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
                        'max' => 45
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'segundoApellido',
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
                        'max' => 45
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'numeroDocumento',
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
                        'min' => 6,
                        'max' => 12
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'correo',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 200
                    )
                ),
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'domain' => true
                    )
                ),
                array(
                    'name' => 'Zend\Validator\Db\NoRecordExists',
                    'options' => array(
                        'table' => 'usuario',
                        'field' => 'correo',
                        'adapter' => $this->dbAdapter,
                        'messages' => array(
                            \Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 'El correo ya existe',
                        ),
                    ),
                ),
            )
        ));
        
        $this->add(array(
            'name' => 'celular',
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
                        'min' => 8,
                        'max' => 11
                    )
                )
            )
        ));
        
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
                        'min' => 4,
                        'max' => 16
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'confirmarClave',
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
                        'min' => 4,
                        'max' => 16
                    )
                ),
                array(
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'nuevaClave',
                        'messages' => array(
                            \Zend\Validator\Identical::NOT_SAME => 'La nueva clave no coincide.'
                        )
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