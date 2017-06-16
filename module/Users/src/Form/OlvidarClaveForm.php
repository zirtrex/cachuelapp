<?php
namespace Users\Form;

use Zend\Form\Form;
use Zend\Captcha\Image as CaptchaImage;


class OlvidarClaveForm extends Form
{
    public function __construct($urlcaptcha)
    {
        parent::__construct('OlvidarClaveForm');
        
        $this->setAttribute('method', 'post');

        $this->add(array(
        		'name' => 'rol',
        		"type"     => 'Zend\Form\Element\Select',
        		"options"  => array(
        				'label' => 'Seleccione su rol',
        				'label_attributes' => array(
        						'class' => 'control-label'
        				),
        				'value_options' => array(
        						'administrador' => 'administrador',
        						'docente' => 'docente',
        						'estudiante' => 'estudiante',
        				),
        		),
        		'attributes' => array(
        				'class' => 'form-control',
        		),
        ));
        
        $this->add(array(
        		'name' => 'correo',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'required' => 'required',
        				'placeholder' =>'Ingrese su correo',
        				'class' => 'form-control',
        		),
        		'options' => array(
        				'label' => 'Correo',
        		),
        ));
        
        $dirdata = './public';
        
        $captchaImage = new CaptchaImage(array(
        		'font' => $dirdata . '/fonts/MGBLACK.ttf',
        		'fontSize' => 32,
        		'wordLen' => 5,
        		'width' => 240,
        		'height' => 100,
        		'dotNoiseLevel' => 5,
        		'lineNoiseLevel' => 2,
        ));
        
        $captchaImage->setImgDir($dirdata.'/captcha');
        $captchaImage->setImgUrl($urlcaptcha);
        
        $this->add(array(
        		'type' => 'Zend\Form\Element\Captcha',
        		'name' => 'captcha',
        		'attributes' => array(
        				'placeholder' =>'Ingresa el código de la imagen',
        				'required' => 'required',
        				'class' => 'form-control',
        		),
        		'options' => array(
        				'label' => 'Ingresa el código generado',
        				'captcha' => $captchaImage
        		),
        ));
        
        $this->add(array(
        		'name'    => 'csrf',
        		'type'    => 'Zend\Form\Element\Csrf',
        		'options' => array(
        				'csrf_options' => array(
        						'timeout' => 1200
        				)
        		)
        ));

        $this->add(array(
        		'name' => 'enviar',
        		'type'  => 'Zend\Form\Element\Submit',
        		'attributes' => array(
        				'value' => 'Enviar correo',
        				'class' => 'btn btn-success btn-block',
        				'id' => 'enviar-correo',
        		),
        ));
    }
}
