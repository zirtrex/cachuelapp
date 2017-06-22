<?php
namespace Empleos\Form;

use Zend\Form\Form;


class EmpleoForm extends Form
{

    public function __construct()
    {
        parent::__construct('EmpleoForm');
        
        $this->setAttributes(array(
            'method' => 'post'
        ));
        
        $this->add(array(
            'name' => 'codEmpleo',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'codEmpleo'
            )
        ));
        
        $this->add(array(
            'name' => 'titulo',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'titulo',
                'placeholder' => 'Ingrese un título para el empleo',
                'required' => 'required',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Título',
                'label_attributes' => array(
                    'class' => ''
                )
            )
        ));
        
        $this->add(array(
            'name' => 'remuneracion',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'id' => 'remuneracion',
                'placeholder' => 'Ingrese la remuneración en soles (S/)',
                'required' => 'required',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Remuneración',
                'label_attributes' => array(
                    'class' => ''
                )
            )
        ));
        
        $this->add(array(
            'name' => 'horas',
            'type' => 'Zend\Form\Element\Number',
            'attributes' => array(
                'id' => 'horas',
                'min'  => '1',
                'max'  => '24',
                'step' => '1',
                'placeholder' => 'Ingrese el número de horas a laborar',
                'required' => 'required',
                'class' => 'uk-input'
            ),
            'options' => array(
                'label' => 'Horas',
                'label_attributes' => array(
                    'class' => ''
                )
            )
        ));
        
        $this->add(
            array(
                'name' => 'categoria',
                "type"     => 'Zend\Form\Element\Select',
                "options"  => array(
                    'label' => 'Elige una categoría',
                    'label_attributes' => array(
                	   'class' => ''
                    ),
                    'value_options' => array(
                        'PetLovers' => 'PetLovers',
                        'Creativos' => 'Creativos',
                        'MilOficios' => 'MilOficios',
                    ),
                ),
                'attributes' => array(
                    'class' => 'uk-select',
                ),
            )
        );
        
        $this->add(array(
            'name' => 'descripcion',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'id' => 'descripcion',
                'rows' => '5',
                'placeholder' => 'Ingrese su descripción',
                'required' => 'required',
                'class' => 'uk-textarea'
            ),
            'options' => array(
                'label' => 'Descripción',
                'label_attributes' => array(
                    'class' => ''
                )
            )
        ));
        
        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf'
        ));
        
        $this->add(array(
            'name' => 'crearEmpleo',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Crear Empleo',
                'class' => 'uk-button uk-button-primary',
                'id' => 'empleoButton'
            )
        ));
    }
}