<?php
namespace Users\Form\Filter;

use Zend\InputFilter\InputFilter;

class SubirImagenFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'type' => 'Zend\InputFilter\FileInput',
            'name' => 'imagen',
            'required' => true,
            'filters' => [
                [
                    'name' => 'FileRenameUpload',
                    'options' => [
                        'target'=>'./public/img/perfil',
                        'useUploadName'=>true,
                        'useUploadExtension'=>true,
                        'overwrite'=>true,
                        'randomize'=>false
                    ]
                ]
            ],
            'validators' => [
                ['name'    => 'FileUploadFile'],
                [
                    'name'    => 'FileMimeType',
                    'options' => [
                        'mimeType'  => ['image/jpeg', 'image/png'],
                        'messages' => [
                            //\Zend\Validator\File\ExcludeMimeType::FALSE_TYPE => 'Solo se permite PNG y JPG',
                        ],
                    ]
                ],
                ['name'    => 'FileIsImage'],
                [
                    'name'    => 'FileImageSize',
                    'options' => [
                        'minWidth'  => 420,
                        'minHeight' => 420,
                        'maxWidth'  => 4096,
                        'maxHeight' => 4096
                    ]
                ],
            ],
        ));
    }
}
