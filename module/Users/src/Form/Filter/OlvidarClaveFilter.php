<?php
namespace Users\Form\Filter;

use Zend\InputFilter\InputFilter;


class OlvidarClaveFilter extends InputFilter
{
	public function __construct($adapter)
	{
		
		$this->add(
				array(
						'name' => 'rol',
						'required' => true
				)
		);
		 
		$this->add(array(
            'name' => 'correo',
            'required' => true ,
            'filters' => array(
        		array('name' => 'StringTrim'),
            ),
				
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'domain' => true,
                        'messages' => array(
                        		\Zend\Validator\EmailAddress::INVALID_FORMAT => 'Email formato inválido'
                        )
                    ),        
                ),
            		
                array(
                    'name' => 'Zend\Validator\Db\RecordExists',
            		'options' => array(
            	        'table' => 'persona',
        				'field' => 'correo',
        				'adapter' => $adapter,
            		    'messages' => array(
            		    		\Zend\Validator\Db\NoRecordExists::ERROR_NO_RECORD_FOUND => 'El correo no existe',
            		    ),
            		),
                ),
            ),   
        ));
		
		$this->add(
				array(
						'name' => 'csrf',
						'required' => true
				)
		);

	}
}
