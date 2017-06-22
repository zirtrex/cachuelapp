<?php 
namespace Admin\Model;

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
            $this->tableGateway->insert($data);
            return $this->tableGateway->lastInsertValue;
    }

    public function eliminarInteracion($codInteracion)
    {
        $this->tableGateway->delete(['codInteracion' => (int) $codInteracion]);
    }
}

