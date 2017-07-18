<?php 
namespace Admin\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;
use Admin\Entity\Ubicacion;

class UbicacionTable
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

    public function obtenerUbicacion($codUbicacion)
    {
        $codUbicacion = (int) $codUbicacion;
        $rowset = $this->tableGateway->select(['codUbicacion' => $codUbicacion]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d', $codEmpleo
            ));
        }

        return $row;
    }

    public function guardarUbicacion(Ubicacion $ubicacion)
    {
        $data = [
            'direccion'     => $ubicacion->direccion,
            'distrito'      => $ubicacion->distrito,
            'provincia'     => $ubicacion->provincia,
            'departamento'  => $ubicacion->departamento
        ];

        $codUbicacion = (int) $ubicacion->codUbicacion;

        if ($codUbicacion === 0) {
            $this->tableGateway->insert($data);
            return $this->tableGateway->lastInsertValue;
        }

        if (! $this->obtenerUbicacion($codUbicacion)) {
            throw new RuntimeException(sprintf(
                'Cannot update row with identifier %d; does not exist', $codUbicacion
            ));
        }

        $this->tableGateway->update($data, ['codUbicacion' => $codUbicacion]);
    }

    public function eliminarUbicacion($codUbicacion)
    {
        $this->tableGateway->delete(['codUbicacion' => (int) $codUbicacion]);
    }
}

