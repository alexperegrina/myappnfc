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
     * @return ComercializadorInterface
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
     * @return array|ComercializadorInterface[]
     */
    public function findAll()
    {

        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('users');
        $select->where(array('tipo = "comercializador"'));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->comercializadorPrototype);

            return $resultSet->initialize($result);
        }

        return array();
    }

    /**
     * @param ComercializadorInterface $comercializadorObject
     *
     * @return ComercializadorInterface
     * @throws \Exception
     */
    public function save(ComercializadorInterface $comercializadorObject)
    {
        $comercializadorData = $this->hydrator->extract($comercializadorObject);
        unset($comercializadorData['id']); // Neither Insert nor Update needs the ID in the array

        //insertamos el tipo de user
        $comercializadorData['tipo'] = 'comercializador';

        if ($comercializadorObject->getId()) {
            // ID present, it's an Update
            $action = new Update('users');
            $action->set($comercializadorData);
            $action->where(array('id = ?' => $comercializadorObject->getId()));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('users');
            $action->values($comercializadorData);
        }

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface) {
            if ($newId = $result->getGeneratedValue()) {
                // When a value has been generated, set it on the object
                $comercializadorObject->setId($newId);
            }

            return $comercializadorObject;
        }

        throw new \Exception("Database error");
    }

    /**
     * {@inheritDoc}
     */
    public function delete(ComercializadorInterface $comercializadorObject)
    {
        $action = new Delete('users');
        $action->where(array('id = ?' => $comercializadorObject->getId()));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }
}