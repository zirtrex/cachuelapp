<?php 
namespace Admin\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Admin\Entity\Empleo;

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
            'remuneracion'  => $empleo->remuneracion,
            'horas'         => $empleo->horas,
            'descripcion'   => $empleo->descripcion,
            'fechaCreacion' => gmdate("Y-m-d H:i:s",Miscellanea::getHoraLocal(-5)),
        ];

        $codEmpleo = (int) $empleo->codEmpleo;

        if ($codEmpleo === 0) {
            $this->tableGateway->insert($data);
            return $this->tableGateway->lastInsertValue;
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

