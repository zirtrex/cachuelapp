<?php 
namespace Admin\Entity;

class Ubicacion
{
    public $codUbicacion;
    public $direccion;
    public $distrito;
    public $provincia;
    public $departamento;    

    public function exchangeArray(array $data)
    {
        $this->codUbicacion      = !empty($data['codUbicacion']) ? $data['codUbicacion'] : null;       
        $this->direccion         = !empty($data['direccion']) ? $data['direccion'] : null;
        $this->distrito          = !empty($data['distrito']) ? $data['distrito'] : null;
        $this->provincia         = !empty($data['provincia']) ? $data['provincia'] : null;
        $this->departamento      = !empty($data['departamento']) ? $data['departamento'] : null;        
    }
}

