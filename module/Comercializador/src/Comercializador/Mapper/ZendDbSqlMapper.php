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
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Join;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Db\ResultSet\ResultSet;
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
        $select = $sql->select()
            ->from(array('u' => 'users'))
            ->join(
                array('i' => 'info_comercializador'),
                'u.id = i.id_comercializador',
                Select::SQL_STAR, Join::JOIN_LEFT)
            ->where(array('u.id = ?' => $id));

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

        $sql    = new Sql($this->dbAdapter);

        if ($comercializadorObject->getId()) {

            $action = new Update('users');
            $action->join(array('i' => 'info_comercializador'), 'id = i.id_comercializador')
                ->where(array('id = ?' => $comercializadorObject->getId()))
                ->set($comercializadorData);


            /**
             * esto demomento aqui
             */
            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();

            if ($result instanceof ResultInterface) {
                if ($newId = $result->getGeneratedValue()) {
                    // When a value has been generated, set it on the object
                    $comercializadorObject->setId($newId);
                }

                return $comercializadorObject;
            }

        } else {

            $comercializador = $this->multiSelectArray($comercializadorData, array('username', 'password', 'mail', 'tipo'));
            $comercializadorInfo = $this->multiSelectArray($comercializadorData, array('nombre', 'descripcion'));

            // ID NOT present, it's an Insert
            $action = new Insert('users');
            $action->values($comercializador);

            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();

            if ($result instanceof ResultInterface) {
                if ($newId = $result->getGeneratedValue()) {
                    // When a value has been generated, set it on the object
                    $comercializadorObject->setId($newId);
                }
            }

            $comercializadorInfo['id_comercializador'] = $comercializadorObject->getId();
            $action = new Insert('info_comercializador');
            $action->values($comercializadorInfo);

            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();

            return $this->find($comercializadorObject->getId());

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


    /**
     * {@inheritDoc}
     */
    public function validIds($ids) {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('banco_ids');
        $select->where->in('id', $ids);


        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        $resultSet = new ResultSet;
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet->initialize($result);
        }

        return $resultSet;
    }

    /**
     * {@inheritDoc}
     */
    public function saveIds(ComercializadorInterface $comercializadorObject, $ids)
    {
        $action = new Insert('banco_ids');
        foreach ($ids AS $id) {
            $values = array(
                'id' => $id,
                'id_comercializador' => $comercializadorObject->getId(),
            );


            $action->values($values);
            $sql    = new Sql($this->dbAdapter);
            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();

        }
    }

    /**
     * {@inheritDoc}
     */
    public function getIdsByComercializador(ComercializadorInterface $comercializadorObject)
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('banco_ids');
//        $select->where('id_comercializador', $comercializadorObject->getId());
        $select->where(array('id_comercializador = ?' => $comercializadorObject->getId()));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        $resultSet = new ResultSet;
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet->initialize($result);
        }

        return $resultSet->toArray();

    }

    /**
     * {@inheritDoc}
     */
    public function getRowByUsername($username) {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('users');
        $select->where(array('username = ?' => $username));


        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        $resultSet = new ResultSet;
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet->initialize($result);
        }

        return $resultSet->toArray();
    }

    
    //******************************************
    //*******  Metodos privados  ***************
    //******************************************


    /**
     * Metodo para cojer multiples valores de un array, si no estan las key en el array
     * crea la nueva posicion en la respuesta y lo deja vacio.
     * 
     * @param $array
     * @param $keys
     * @return array
     */
    private function multiSelectArray($array,$keys) {
        $result = array();
        foreach ($keys as $key) {
            if(array_key_exists($key, $array)) {
                $result[$key] = $array[$key];
            }
            else {
                $result[$key] = "";
            }

        }
        return $result;
    }
}