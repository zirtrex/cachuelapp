<?php
namespace Empleos\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Admin\Entity\Ubicacion;
use Zend\Form\Element;

class UbicacionFieldset extends Fieldset implements InputFilterProviderInterface
{

    protected $dbAdapter;

    public function __construct($dbAdapter)
    {
        parent::__construct('Ubicacion');
        
        $this->dbAdapter = $dbAdapter;
        
        $this->setHydrator(new ReflectionHydrator(false))->setObject(new Ubicacion());
        
        $this->add(array(
            'name' => 'codUbicacion',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'codUbicacion'
            )
        ));
        
        $this->add(array(
            'name' => 'direccion',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'direccion',
                'placeholder' => 'Ingrese referencia (Ejemplo: Cerca a Plaza Norte)',
                'required' => 'required',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Referencia',
                'label_attributes' => array(
                    'class' => ''
                )
            )
        ));
        
        $this->add(array(
            'name' => 'distrito',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'distrito',
                'placeholder' => 'Ingrese su distrito',
                'required' => 'required',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Distrito',
                'label_attributes' => array(
                    'class' => ''
                )
            )
        ));
        
        $this->add(array(
            'name' => 'provincia',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'provincia',
                'placeholder' => 'Ingrese su provincia',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Provincia',
                'label_attributes' => array(
                    'class' => ''
                )
            )
        ));
        
        $this->add(array(
            'name' => 'departamento',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'departamento',
                'placeholder' => 'Ingrese su departamento',
                'required' => 'required',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Departamento',
                'label_attributes' => array(
                    'class' => ''
                )
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            
            'codUbicacion' => array(
                'required' => false
            ),
            
            'direccion' => array(
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
                            'min' => 3,
                            'max' => 45
                        )
                    )
                )
            ),
            
            'distrito' => array(
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
                            'min' => 3,
                            'max' => 45
                        )
                    )
                )
            ),
            
            'provincia' => array(
                'required' => false,
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
                            'min' => 3,
                            'max' => 45
                        )
                    )
                )
            ),
            
            'departamento' => array(
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
                            'min' => 3,
                            'max' => 42
                        )
                    )
                )
            )
        );
    }
}
