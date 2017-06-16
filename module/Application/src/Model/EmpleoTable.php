<?php 
namespace Application\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Application\Entity\Empleo;

class EmpleoTable
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

    public function obtenerEmpleo($codEmpleo)
    {
        $codEmpleo = (int) $codEmpleo;
        $rowset = $this->tableGateway->select(['codEmpleo' => $codEmpleo]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d', $codEmpleo
            ));
        }

        return $row;
    }

    public function guardarEmpleo(Empleo $empleo)
    {
        $data = [
            'titulo'        => $empleo->titulo,
            'descripcion'   => $empleo->descripcion,
        ];

        $codEmpleo = (int) $empleo->codEmpleo;

        if ($codEmpleo === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->obtenerEmpleo($codEmpleo)) {
            throw new RuntimeException(sprintf(
                'Cannot update row with identifier %d; does not exist', $codEmpleo
            ));
        }

        $this->tableGateway->update($data, ['codEmpleo' => $codEmpleo]);
    }

    public function eliminarEmpleo($codEmpleo)
    {
        $this->tableGateway->delete(['codEmpleo' => (int) $codEmpleo]);
    }
}

