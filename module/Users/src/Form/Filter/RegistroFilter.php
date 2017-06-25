<?php
namespace Users\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\Db\Adapter\Adapter;

class RegistroFilter extends InputFilter
{
    private $dbAdapter; 

    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        
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
            'name' => 'numeroDNI',
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
                        'max' => 8
                    )
                ),
                array(
                    'name' => 'Zend\Validator\Db\NoRecordExists',
                    'options' => array(
                        'table' => 'usuario',
                        'field' => 'numeroDNI',
                        'adapter' => $this->dbAdapter,
                        'messages' => array(
                            \Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 'El número de DNI ya existe',
                        ),
                    ),
                ),
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
                ),
                array(
                    'name' => 'Zend\Validator\Db\NoRecordExists',
                    'options' => array(
                        'table' => 'usuario',
                        'field' => 'celular',
                        'adapter' => $this->dbAdapter,
                        'messages' => array(
                            \Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 'El celular ya existe',
                        ),
                    ),
                ),
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
                ),
                array(
                    'name' => 'Zend\Validator\Db\NoRecordExists',
                    'options' => array(
                        'table' => 'usuario',
                        'field' => 'usuario',
                        'adapter' => $this->dbAdapter,
                        'messages' => array(
                            \Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 'El usuario ya existe',
                        ),
                    ),
                ),
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
                        'token' => 'confirmarClave',
                        'messages' => array(
                            \Zend\Validator\Identical::NOT_SAME => 'La nueva clave no coincide.'
                        )
                    )
                )
            )
        ));
            
        
    }
}