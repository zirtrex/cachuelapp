<?php 
namespace Admin\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;


class InteraccionTable
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

    public function guardarInteracion(Array $data)
    {
        try {
            $this->tableGateway->insert($data);
            return $this->tableGateway->lastInsertValue;
        } catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e)
        {
            throw new RuntimeException(sprintf(
                'Ya ha postulado o es propietario de este empleo'
            ));
        }
    }

    public function eliminarInteracion($codInteracion)
    {
        $this->tableGateway->delete(['codInteracion' => (int) $codInteracion]);
    }
}

