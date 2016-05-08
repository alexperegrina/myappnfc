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
use Zend\Db\ResultSet\ResultSet;
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

            $sql = new Sql($this->dbAdapter);
            $stmt = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();

            if ($result instanceof ResultInterface) {
                if ($newId = $result->getGeneratedValue()) {
                    // When a value has been generated, set it on the object
                    $userObject->setId($newId);
                }
            }

            $insertinfo = new Insert('info_user');
            $insertinfo->values(array('id_user' => $userObject->getId(), 'nombre' => NULL, 'apellidos' => NULL, 'fecha_nacimiento' => NULL));

            $sql = new Sql($this->dbAdapter);
            $stmt = $sql->prepareStatementForSqlObject($insertinfo);
            $result = $stmt->execute();

        }

        /*if ($result instanceof ResultInterface) {
            if ($newId = $result->getGeneratedValue()) {
                // When a value has been generated, set it on the object
                $userObject->setId($newId);
            }
            return $userObject;
        }
        throw new \Exception("Database error");*/

        return (bool)$result->getAffectedRows();
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
    public function saveInfo(UserInterface $userObject)
    {
        $userData = $this->hydrator->extract($userObject);
        unset($userData['id_user']); // Neither Insert nor Update needs the ID in the array
        $userData = array_slice($userData, 4);

        if ($userObject->getId()) {
            // ID present, it's an Update
            $action = new Update('info_user');
            $action->set($userData);
            $action->where(array('id_user = ?' => $userObject->getId()));
            $userObject->setId_user($userObject->getId());
        } else {
            throw new \Exception("The user doesn't exist");
        }

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface) {
            if ($newId = $result->getGeneratedValue()) {
                // When a value has been generated, set it on the object

                $userObject->setId_user($newId);
                $userObject->setId($newId);
                print_r($newId);
            }
            //\Zend\Debug\Debug::dump($userObject);die();
            return $userObject;
        }
        //\Zend\Debug\Debug::dump('info_user');die();
        throw new \Exception("Database error");
    }

    /**
     * @param $id identificador del usuario, $nfc identificador del nfc tag
     *
     * @return UserInterface
     * @throws \Exception
     */
    public function addItem($id, $nfc)
    {
        //buscar el tag $nfc con el $id
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('banco_ids');
        $select->where(array('id = ?' => $nfc));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result->isQueryResult() == 1) {
            // el tag existe
            $resultSet = new ResultSet();
            $list = $resultSet->initialize($result)->toArray();

            //si el tag ya está asignado a un usuario salta expcepción
            if (!is_null($list[0]['id_user'])) throw new \Exception("The tag is already assigned to another user");

            $action = new Update('banco_ids');
            $action->set(array('id_user' => $id));
            $action->where(array('id = ?' => $nfc));

            $sql    = new Sql($this->dbAdapter);
            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();

            return (bool)$result->getAffectedRows();
        } else {
            throw new \Exception("The user doesn't exist");
        }
    }

    /**
     * @param $id
     * @param $nfc
     * @return bool
     * @throws \Exception
     */
    public function deleteUserItem($id, $nfc)
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('banco_ids');
        $select->where(array('id = ?' => $nfc, 'id_user = ?' => $id));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result->isQueryResult() == 1) {
            $select = new Delete('banco_ids');
            $select->where(array('id = ?' => $nfc, 'id_user = ?' => $id));

            $sql    = new Sql($this->dbAdapter);
            $stmt   = $sql->prepareStatementForSqlObject($select);
            $result = $stmt->execute();

            return (bool)$result->getAffectedRows();
        } else {
            throw new \Exception("The tag is not assigned to the user");
        }
    }


    /**
     * @param $id
     * @return array
     */
    public function activeService($id)
    {
        //buscar servicio $servicio del usuario $id
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('permisos_user_servicio');
        $select->columns(array('informacion_total'));
        $select->where(array('id_user = ?' => $id /*, 'id_servicio = ?' => $servicio*/));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();
        
        if ($result->isQueryResult() == 1) {
            //si el usuario con el servicio existe cambiar el estado
            $resultSet = new ResultSet();
            $list = $resultSet->initialize($result)->toArray();
            $activar = !($list[0]['informacion_total']);

            $action = new Update('permisos_user_servicio');
            $action->set(array('informacion_total' => $activar));
            $action->where(array('id_user = ?' => $id /*, 'id_servicio = ?' => $servicio*/));

            $sql    = new Sql($this->dbAdapter);
            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();

            return (bool)$result->getAffectedRows();
        }
        else {
            throw new \Exception("The user doesn't have such service");
        }
    }

    /**
     * @param $id
     */
    public function listServices($id)
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('permisos_user_servicio');
        $select->where(array('id_user = ?' => $id));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result->isQueryResult() > 0) {
            $resultSet = new ResultSet();

            $list = $resultSet->initialize($result)->toArray();

            //return $list;

            foreach ($list as $item) {
                print_r("Servicio No.: " . $item['id_servicio'] . "\n");
                print_r("Activado: " . $item['informacion_total'] . "\n");
            }
        }
    }

    /**
     * @param $id
     * @param $clave
     * @return bool
     */
    public function addKey($id, $clave)
    {
        $action = new Insert('claves_notificaciones');
        $action->values(array('id_user = ?' => $id, 'clave = ?' => $clave));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }

    /**
     * @param $id
     * @param $clave
     * @return bool
     */
    public function deleteKey($id, $clave)
    {
        $action = new Delete('claves_notificaciones');
        $action->where(array('id_user = ?' => $id, 'clave = ?' => $clave));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }
}