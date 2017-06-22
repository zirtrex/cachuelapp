<?php 
namespace Admin\Entity;

class Empleo
{
    public $codEmpleo;
    public $titulo;
    public $descripcion;
    public $remuneracion;
    public $horas;
    public $categoria;
    public $etiquetas;
    public $Usuario; //Un empleo puede ser publicado por un usuario

    public function exchangeArray(array $data)
    {
        $this->codEmpleo        = !empty($data['codEmpleo']) ? $data['codEmpleo'] : null;
        $this->titulo           = !empty($data['titulo']) ? $data['titulo'] : null;
        $this->descripcion      = !empty($data['descripcion']) ? $data['descripcion'] : null;
        $this->remuneracion     = !empty($data['remuneracion']) ? $data['remuneracion'] : null;
        $this->horas            = !empty($data['horas']) ? $data['horas'] : null;
        $this->categoria        = !empty($data['categoria']) ? $data['categoria'] : null;
        $this->etiquetas        = !empty($data['etiquetas']) ? $data['etiquetas'] : null;

        $this->Usuario = new Usuario();
        
        $this->Usuario->codUsuario      = !empty($data['codUsuario']) ? $data['codUsuario'] : null;
        $this->Usuario->usuario         = !empty($data['usuario']) ? $data['usuario'] : null;
        $this->Usuario->nombres         = !empty($data['nombres']) ? $data['nombres'] : null;        
    }
}

