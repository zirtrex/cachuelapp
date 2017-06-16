<?php 
namespace Application\Entity;

class Usuario
{
    public $codUsuario;
    public $usuario;
    public $clave;
    public $nombres;
    public $primerApellido;
    public $segundoApellido;
    public $numeroDNI;
    public $imagenDNI;
    public $correo;
    public $celular;
    public $Empleo; //Un usuario puede haber postulado o publicado varios empleos.

    public function exchangeArray(array $data)
    {
        $this->codUsuario        = !empty($data['codUsuario']) ? $data['codUsuario'] : null;
        $this->usuario           = !empty($data['usuario']) ? $data['usuario'] : null;
        $this->clave             = !empty($data['clave']) ? $data['clave'] : null;
        $this->nombres           = !empty($data['nombres']) ? $data['nombres'] : null;
        $this->primerApellido    = !empty($data['primerApellido']) ? $data['primerApellido'] : null;
        $this->segundoApellido   = !empty($data['segundoApellido']) ? $data['segundoApellido'] : null;
        $this->numeroDNI         = !empty($data['numeroDNI']) ? $data['numeroDNI'] : null;        
        $this->imagenDNI         = !empty($data['imagenDNI']) ? $data['imagenDNI'] : null;
        $this->correo            = !empty($data['correo']) ? $data['correo'] : null;
        $this->celular           = !empty($data['celular']) ? $data['celular'] : null;
    }
}

