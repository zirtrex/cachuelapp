<?php 
namespace Admin\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Admin\Entity\Usuario;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Sql;

class UsuarioTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function obtenerTodo($paginado = false)
    {
        if ($paginado) {
            
            $select = new Select("vw_usuario");

            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Usuario());

            $paginatorAdapter = new DbSelect($select, $this->tableGateway->getAdapter(),$resultSetPrototype);
            
            $paginator = new Paginator($paginatorAdapter);
            
            return $paginator;
        }
        $resultSet = $this->tableGateway->select();
        return $resultSet;
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
                'Could not find row with identifier %d', $token
                ));
        }
    
        return $row;
    }

    public function guardarUsuario(Usuario $usuario)
    {
        $data = [
            'rol'               => $usuario->rol,
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
            'imagenPerfil'      => $usuario->imagenPerfil,
            'imagenAdicional'   => $usuario->imagenAdicional,
            'fechaRegistro'     => $usuario->fechaRegistro,
            'tokenRegistro'     => $usuario->tokenRegistro,            
            'correoConfirmado'  => $usuario->correoConfirmado,
            'codUbicacion'      => $usuario->Ubicacion->codUbicacion
        ];

        $codUsuario = (int) $usuario->codUsuario;
        
        $sql = new Sql($this->tableGateway->getAdapter());
        
        if ($codUsuario === 0) {            
            $insert = $sql->insert('usuario');
            $insert->values($data);            
            $statement = $sql->prepareStatementForSqlObject($insert);
            $row = $statement->execute();
            return $this->tableGateway->lastInsertValue;
        }

        if (! $this->obtenerUsuario($codUsuario)) {
            throw new RuntimeException(sprintf(
                'Cannot update row with identifier %d; does not exist', $codUsuario
            ));
        }
        $update = $sql->update('usuario');
        $update->set($data)->where(['codUsuario' => $codUsuario]);
        $statement = $sql->prepareStatementForSqlObject($update);
        
        $row = $statement->execute();
        
        return $codUsuario;
    }
    
    public function guardarUsuarioImagen(Usuario $usuario)
    {
        $data = [            
            'imagenPerfil'      => $usuario->imagenPerfil,
        ];
    
        $codUsuario = (int) $usuario->codUsuario;
    
        if (! $this->obtenerUsuario($codUsuario)) {
            throw new RuntimeException(sprintf(
                'Cannot update row with identifier %d; does not exist', $codUsuario
                ));
        }
        
        $sql = new Sql($this->tableGateway->getAdapter());
        $update = $sql->update('usuario');
        $update->set($data)->where(['codUsuario' => $codUsuario]);
        $statement = $sql->prepareStatementForSqlObject($update);
        return $row = $statement->execute();
    }

    public function eliminarUsuario($codUsuario)
    {
        $sql = new Sql($this->tableGateway->getAdapter());
        $delete = $sql->delete('usuario');
        $delete->where(['codUsuario' => (int) $codUsuario]);
        $statement = $sql->prepareStatementForSqlObject($insert);
        return $row = $statement->execute();
    }
}

