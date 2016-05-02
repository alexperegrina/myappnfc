<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/4/16
 * Time: 0:00
 */

namespace User\Mapper;

use User\Model\UserInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ZendDbSqlMapper implements UserMapperInterface
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
     * @var \User\Model\UserInterface
     */
    protected $userPrototype;

    /**
     * @param AdapterInterface  $dbAdapter
     * @param HydratorInterface $hydrator
     * @param UserInterface    $userPrototype
     */
    public function __construct(
        AdapterInterface $dbAdapter,
        HydratorInterface $hydrator,
        UserInterface $userPrototype
    ) {

        $this->dbAdapter      = $dbAdapter;
        $this->hydrator       = $hydrator;
        $this->userPrototype  = $userPrototype;
    }

    /**
     * @param int|string $id
     *
     * @return UserInterface
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
            return $this->hydrator->hydrate($result->current(), $this->userPrototype);
        }

        throw new \InvalidArgumentException("User con ID:{$id} no existe.");
    }

    /**
     * @return array|UserInterface[]
     */
    public function findAll()
    {

        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('users');
        $select->where(array('tipo = "user"'));
        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->userPrototype);

            return $resultSet->initialize($result);
        }

        return array();
    }

    /**
     * @param UserInterface $userObject
     *
     * @return UserInterface
     * @throws \Exception
     */
    public function save(UserInterface $userObject)
    {
        $userData = $this->hydrator->extract($userObject);
        unset($userData['id']); // Neither Insert nor Update needs the ID in the array
        //insertamos el tipo de user
        $userData = array_slice($userData, 0, 3);
        $userData['tipo'] = 'user';

        if ($userObject->getId()) {
            // ID present, it's an Update
            $action = new Update('users');
            $action->set($userData);
            $action->where(array('id = ?' => $userObject->getId()));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('users');
            $action->values($userData);
        }
        $sql = new Sql($this->dbAdapter);
        $stmt = $sql->prepareStatementForSqlObject($action);

        $result = $stmt->execute();

        if ($result instanceof ResultInterface) {
            if ($newId = $result->getGeneratedValue()) {
                // When a value has been generated, set it on the object
                $userObject->setId($newId);
            }
            return $userObject;
        }
        throw new \Exception("Database error");
    }

    /**
     * {@inheritDoc}
     */
    public function delete(UserInterface $userObject)
    {
        $action = new Delete('users');
        $action->where(array('id = ?' => $userObject->getId()));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }

    /**
     * @param UserInterface $userObject
     *
     * @return UserInterface
     * @throws \Exception
     */
    public function saveInfoUser(UserInterface $userObject)
    {
        $userData = $this->hydrator->extract($userObject);
        unset($userData['id_user']); // Neither Insert nor Update needs the ID in the array
        $userData = array_slice($userData, 4);

        if ($userObject->getId_user()) {
            // ID present, it's an Update
            $action = new Update('info_user');
            $action->set($userData);
            $action->where(array('id_user = ?' => $userObject->getId_user()));
            \Zend\Debug\Debug::dump($userData);die();
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('info_user');
            $action->values($userData);
        }

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);

        $result = $stmt->execute();

        if ($result instanceof ResultInterface) {
            if ($newId = $result->getGeneratedValue()) {
                // When a value has been generated, set it on the object
                $userObject->setId_user($newId);
            }
            //\Zend\Debug\Debug::dump($userObject);die();
            return $userObject;
        }

        throw new \Exception("Database error");
    }
}