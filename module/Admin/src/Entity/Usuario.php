<?php 
namespace Admin\Entity;

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
    public $enlaceFacebook;
    public $fechaNacimiento;
    public $correo;
    public $celular;
    public $direccion;
    public $distrito;
    public $departamento;
    public $provincia;
    public $imagenPerfil;
    public $imagenAdicional;
    public $fechaRegistro;
    public $tokenRegistro;
    public $correoConfirmado;
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
        $this->enlaceFacebook    = !empty($data['enlaceFacebook']) ? $data['enlaceFacebook'] : null;
        $this->fechaNacimiento   = !empty($data['fechaNacimiento']) ? $data['fechaNacimiento'] : null;
        $this->correo            = !empty($data['correo']) ? $data['correo'] : null;
        $this->celular           = !empty($data['celular']) ? $data['celular'] : null;
        $this->direccion         = !empty($data['direccion']) ? $data['direccion'] : null;
        $this->distrito          = !empty($data['distrito']) ? $data['distrito'] : null;
        $this->departamento      = !empty($data['departamento']) ? $data['departamento'] : null;
        $this->provincia         = !empty($data['provincia']) ? $data['provincia'] : null;
        $this->imagenPerfil      = !empty($data['imagenPerfil']) ? $data['imagenPerfil'] : null;
        $this->imagenAdicional   = !empty($data['imagenAdicional']) ? $data['imagenAdicional'] : null;
    }
}

