<?php

namespace Empleos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Empleos\Model\AlbumTable;

class IndexController extends AbstractActionController
{
    private $table;
    
    // Add this constructor:
    public function __construct(AlbumTable $table)
    {
        $this->table = $table;
    }
    
    public function indexAction()
    {
        return new ViewModel([
            'albums' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}
