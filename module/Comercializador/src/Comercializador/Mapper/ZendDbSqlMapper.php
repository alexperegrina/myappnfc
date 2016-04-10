<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/4/16
 * Time: 0:02
 */

namespace Comercializador\Mapper;

use Comercializador\Model\ComercializadorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ZendDbSqlMapper implements ComercializadorMapperInterface
{

    /**
     * @var \Zend\Db\Adapter\AdapterInterface
     */
    protected $dbAdapter;

    /**
     * @var \Zend\Stdlib\Hydrator\HydratorInterface
     */
    protected $hydrator;

    /**
     * @var \Comercializador\Model\ComercializadorInterface
     */
    protected $comercializadorPrototype;

//    /**
//     * ZendDbSqlMapper constructor.
//     * @param AdapterInterface $dbAdapter
//     * @param HydratorInterface $hydrator
//     * @param \Comercializador\Model\ComercializadorInterface $comercializadorPrototype
//     */
//    public function __construct()
//    {
//    }

    /**
     * @param AdapterInterface  $dbAdapter
     * @param HydratorInterface $hydrator
     * @param ComercializadorInterface    $comercializadorPrototype
     */
    public function __construct(
        AdapterInterface $dbAdapter,
        HydratorInterface $hydrator,
        ComercializadorInterface $comercializadorPrototype
    ) {
        $this->dbAdapter      = $dbAdapter;
        $this->hydrator       = $hydrator;
        $this->comercializadorPrototype  = $comercializadorPrototype;
    }

    
    
    /**
     * @param int|string $id
     *
     * @return ComercialzadorInterface
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('users');
        $select->where(array('id = ?' => $id));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
            return $this->hydrator->hydrate($result->current(), $this->comercializadorPrototype);
        }
        
        throw new \InvalidArgumentException("Comercializador con ID:{$id} no existe.");
    }

    /**
     * @return array|ComercialzadorInterface[]
     */
    public function findAll()
    {

        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('users');
        //$select->where(array('tipo = comercializador'));
        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->comercializadorPrototype);

            return $resultSet->initialize($result);
        }

        return array();
    }

}