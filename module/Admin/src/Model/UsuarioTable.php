<?php 
namespace Admin\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Admin\Entity\Usuario;

class UsuarioTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function obtenerTodo()
    {
        return $this->tableGateway->select();
    }

    public function obtenerUsuario($codUsuario)
    {
        $codUsuario = (int) $codUsuario;
        $rowset = $this->tableGateway->select(['codUsuario' => $codUsuario]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d', $codUsuario
            ));
        }

        return $row;
    }
    
    public function obtenerUsuarioPorToken($token)
    {
        $rowset = $this->tableGateway->select(['tokenRegistro' => $token]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d', $codUsuario
                ));
        }
    
        return $row;
    }

    public function guardarUsuario(Usuario $usuario)
    {
        $data = [
            'usuario'           => $usuario->usuario,
            'clave'             => $usuario->clave,
            'nombres'           => $usuario->nombres,
            'primerApellido'    => $usuario->primerApellido,
            'segundoApellido'   => $usuario->segundoApellido,
            'numeroDNI'         => $usuario->numeroDNI,            
            'imagenDNI'         => $usuario->imagenDNI,
            'enlaceFacebook'    => $usuario->enlaceFacebook,
            'fechaNacimiento'   => $usuario->fechaNacimiento,
            'correo'            => $usuario->correo,
            'celular'           => $usuario->celular,
            'direccion'         => $usuario->direccion,
            'distrito'          => $usuario->distrito,
            'departamento'      => $usuario->departamento,
            'provincia'         => $usuario->provincia,
            'imagenPerfil'      => $usuario->imagenPerfil,
            'imagenAdicional'   => $usuario->imagenAdicional,            
            'tokenRegistro'     => $usuario->tokenRegistro,
            'fechaRegistro'     => $usuario->fechaRegistro,
            'correoConfirmado'  => $usuario->correoConfirmado            
        ];

        $codUsuario = (int) $usuario->codUsuario;

        if ($codUsuario === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->obtenerUsuario($codUsuario)) {
            throw new RuntimeException(sprintf(
                'Cannot update row with identifier %d; does not exist', $codUsuario
            ));
        }

        $this->tableGateway->update($data, ['codUsuario' => $codUsuario]);
    }

    public function eliminarUsuario($codUsuario)
    {
        $this->tableGateway->delete(['codUsuario' => (int) $codUsuario]);
    }
}

