<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 16:21
 */

namespace Servicio\Mapper;

use Servicio\Model\ServicioInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ZendDbSqlMapper implements ServicioMapperInterface
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
     * @var \Servicio\Model\ServicioInterface
     */
    protected $servicioPrototype;

    /**
     * @param AdapterInterface  $dbAdapter
     * @param HydratorInterface $hydrator
     * @param ServicioInterface    $servicioPrototype
     */
    public function __construct(
        AdapterInterface $dbAdapter,
        HydratorInterface $hydrator,
        ServicioInterface $servicioPrototype
    ) {
        
        $this->dbAdapter      = $dbAdapter;
        $this->hydrator       = $hydrator;
        $this->servicioPrototype  = $servicioPrototype;
    }

    /**
     * @param int|string $id
     *
     * @return ServicioInterface
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
            return $this->hydrator->hydrate($result->current(), $this->servicioPrototype);
        }

        throw new \InvalidArgumentException("Servicio con ID:{$id} no existe.");
    }

    /**
     * @return array|ServicioInterface[]
     */
    public function findAll()
    {

        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('users');
        $select->where(array('tipo = "servicio"'));
        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->servicioPrototype);

            return $resultSet->initialize($result);
        }

        return array();
    }

    /**
     * @param ServicioInterface $servicioObject
     *
     * @return ServicioInterface
     * @throws \Exception
     */
    public function save(ServicioInterface $servicioObject)
    {
        $servicioData = $this->hydrator->extract($servicioObject);
        unset($servicioData['id']); // Neither Insert nor Update needs the ID in the array

        if ($servicioObject->getId()) {
            // ID present, it's an Update
            $action = new Update('users');
            $action->set($servicioData);
            $action->where(array('id = ?' => $servicioObject->getId()));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('users');
            $action->values($servicioData);
        }

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface) {
            if ($newId = $result->getGeneratedValue()) {
                // When a value has been generated, set it on the object
                $servicioObject->setId($newId);
            }

            return $servicioObject;
        }

        throw new \Exception("Database error");
    }

    /**
     * {@inheritDoc}
     */
    public function delete(ServicioInterface $servicioObject)
    {
        $action = new Delete('users');
        $action->where(array('id = ?' => $servicioObject->getId()));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }
}