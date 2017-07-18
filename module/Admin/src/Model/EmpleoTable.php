<?php 
namespace Admin\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Admin\Entity\Empleo;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Sql;

class EmpleoTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function obtenerTodo($paginado = false)
    {
        if ($paginado) {
            
            $select = new Select("vw_empleo");

            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Empleo());

            $paginatorAdapter = new DbSelect($select, $this->tableGateway->getAdapter(),$resultSetPrototype);
            
            $paginator = new Paginator($paginatorAdapter);
            
            return $paginator;
        }
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function obtenerEmpleo($codEmpleo)
    {
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select();
        
        $select->from('vw_empleo')
                ->columns(array('*'))
                ->where(array('codEmpleo' => $codEmpleo));
        
        $statement = $sql->prepareStatementForSqlObject($select);
        $row = $statement->execute();
        
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d', $codEmpleo
            ));
        }

        return $row->current();
    }

    public function guardarEmpleo(Empleo $empleo)
    {
        $data = [
            'titulo'        => $empleo->titulo,
            'descripcion'   => $empleo->descripcion,
            'remuneracion'  => $empleo->remuneracion,
            'fechaCreacion' => gmdate("Y-m-d H:i:s", Miscellanea::getHoraLocal(-5)),
            'horas'         => $empleo->horas,
            'categoria'     => $empleo->categoria,
            'etiquetas'     => $empleo->etiquetas,            
            'codUbicacion'  => $empleo->Ubicacion->codUbicacion,
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

