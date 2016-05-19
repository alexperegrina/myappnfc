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
     * Devuelve el perfil de usuario $id
     * @param int|string $id
     *
     * @return UserInterface
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
        $sql = new Sql($this->dbAdapter);

        $select = $sql->select()
            ->from(array('u' => 'users'))
            ->join(array('i' => 'info_user'), 'u.id = i.id_user')
            ->where(array('u.id = ?' => $id));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
            return $this->hydrator->hydrate($result->current(), $this->userPrototype);
        }

        throw new \InvalidArgumentException("User con ID:{$id} no existe.");
    }

    /**
     * Devuelve un array de perfiles de todos los usuarios
     * @return array|UserInterface[]
     */
    public function findAll()
    {
        $sql    = new Sql($this->dbAdapter);
        /*$select = $sql->select()
            ->from(array('u' => 'users'))
            ->join(array('i' => 'info_user'), 'u.id = i.id_user')
            ->where(array('tipo = "user"'));*/

        $select = $sql->select('users');
        $select->where('tipo = "user"');

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->userPrototype);

            return $resultSet->initialize($result);
        }

        return array();
    }

    /**
     * Crea un usuario nuevo o actualiza uno existente
     * @param UserInterface $userObject
     *
     * @return UserInterface
     * @throws \Exception
     */
    public function save(UserInterface $userObject)
    {
        $userData = $this->hydrator->extract($userObject);
        unset($userData['id']); // Neither Insert nor Update needs the ID in the array
        $userDI = $userData;
        $userInfo = array_slice($userData, 3);
        $userData = array_slice($userData, 0, 3);

        //insertamos el tipo de user
        $userData['tipo'] = 'user';

        if ($userObject->getId()) {
            // ID present, it's an Update
            /*$action = new Update('users');
            $action->set($userData);
            $action->where(array('id = ?' => $userObject->getId()));*/

            $action = new Update('users');
            $action->join(array('i' => 'info_user'), 'id = i.id_user')
                    ->where(array('id = ?' => $userObject->getId()))
                    ->set($userDI);

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
                    $userObject->setId_user($newId);
                    $userInfo['id_user']=$newId;
                }
            }

            $insertinfo = new Insert('info_user');
            $insertinfo->values($userInfo);

            $sql = new Sql($this->dbAdapter);
            $stmt = $sql->prepareStatementForSqlObject($insertinfo);
            $stmt->execute();

            return $userObject;
        }

        throw new \Exception("Database error");
    }

    /**
     * Borra un usuario
     * @param UserInterface $userObject
     * @return Numero de filas afectadas
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
     * Añade una etiqueta nueva ¢nfc al usuario $id
     * @param $id identificador del usuario
     * @param $nfc identificador del nfc tag
     *
     * @return UserInterface
     * @throws \Exception
     */
    public function addUserItem($id, $nfc)
    {
        //buscar el tag $nfc con el $id
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('banco_ids');
        $select->where(array('id = ?' => $nfc));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        $resultSet = new ResultSet();
        $list = $resultSet->initialize($result)->toArray();

        if (count($list) != 0) {
            // el tag existe
            $resultSet = new ResultSet();
            $list = $resultSet->initialize($result)->toArray();

            //si el tag ya está asignado a un usuario salta expcepción
            if (!is_null($list['id_user'])) throw new \Exception("The tag is already assigned to another user");

            $action = new Update('banco_ids');
            $action->set(array('id_user' => $id));
            $action->where(array('id = ?' => $nfc));

            $sql    = new Sql($this->dbAdapter);
            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();

            return (bool)$result->getAffectedRows();
        } else {
            throw new \Exception("The tag doesn't exist");
        }
    }

    /**
     * Borra una etiqueta $nfc al usuario $id
     * @param $id
     * @param $nfc
     * @return bool
     * @throws \Exception
     */
    public function deleteUserItem($id, $nfc)
    {
        /*$sql    = new Sql($this->dbAdapter);
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
        }*/

        $select = new Delete('banco_ids');
        $select->where(array('id = ?' => $nfc, 'id_user = ?' => $id));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }

    /**
     * Devuelve el perfil de usuario $id
     * @param $id
     * @return array
     */
    public function getProfile($id)
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('info_user');
        $select->where(array('id_user = ?' => $id));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        $resultSet = new ResultSet();

        return $resultSet->initialize($result)->toArray()[0];
    }


    /**
     * Cambia el estado del servicio $id_servicio segun el valor array[2]
     * @param $username
     * @param array[@id_servicio, activo/inactivo]
     * @return array
     * @throws \Exception
     */
    public function activeService($username, $array_servicio)
    {
        //buscar servicio $servicio del usuario $id
        $sql    = new Sql($this->dbAdapter);

        $select = $sql->select()
           ->from(array('u' => 'users'))
           ->join(array('p' => 'permisos_user_servicio'), 'p.id_user = u.id', array('informacion_total'), 'left')
           ->where(array('u.username = ?' => $username, 'p.id_servicio = ?' => $array_servicio[0]));

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();
        $resultSet = new ResultSet();
        $state = $resultSet->initialize($result)->toArray();
        $state = $state[0]['informacion_total'];

        //\Zend\Debug\Debug::dump($array_servicio[1]);die();

        if ($result->getAffectedRows() == 1) {
            //si el usuario con el servicio existe cambiar el estado
            $action = new Update('permisos_user_servicio');
            $action->join(array('u' => 'users'), 'id_user = u.id')
                    ->where(array('u.username = ?' => $username, 'id_servicio = ?' => $array_servicio[0]))
                    ->set(array('informacion_total' => !$state));
            $sql    = new Sql($this->dbAdapter);
            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();
            //print_r($resultSet->initialize($result)->toArray());
            //\Zend\Debug\Debug::dump($array_servicio[0]);die();

            return (bool)$result->getAffectedRows();
        }
        else {
            die("The user doesn't have such service");
        }
    }

    /**
     * Devuelve la lista de los servicios disponibles
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function listServices($id)
    {
        $sql    = new Sql($this->dbAdapter);
        /*$select = $sql->select()
            ->from(array('p' => 'permisos_user_servicio'))
            ->join(array('i' => 'info_servicio'), 'p.id_servicio = i.id_servicio', array('nombre'), 'left');*/

        $select = $sql->select("info_servicio");
        $stmt   = $sql->prepareStatementForSqlObject($select);

        $result = $stmt->execute();

        if ($result->isQueryResult() > 0) {
            $resultSet = new ResultSet();

            $list = $resultSet->initialize($result)->toArray();
            //\Zend\Debug\Debug::dump($list);die();
            return $list;
        }
        else {
            throw new \Exception("The services can't be retrieved");
        }
    }

    /**
     * Devuelve la informacion sobre los servicios relacionados al usuario $id
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function listInfoServices($id) {

        $sql    = new Sql($this->dbAdapter);
        /*$select = $sql->select()
            ->from(array('p' => 'permisos_user_servicio'))
            ->join(array('i' => 'info_servicio'), 'p.id_servicio = i.id_servicio', array('nombre'), 'left');*/

        $select = $sql->select("permisos_user_servicio");
        $select->where(array('id_user = ? ' => $id));
        $stmt   = $sql->prepareStatementForSqlObject($select);

        $result = $stmt->execute();

        if ($result->isQueryResult() > 0) {
            $resultSet = new ResultSet();

            $list = $resultSet->initialize($result)->toArray();
            return $list;
        }
        else {
            throw new \Exception("The user doesn't have any service");
        }
    }

    /**
     * Devuelve la lista de los comercializadores
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function listCompanies($id)
    {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('banco_ids');
        $select->where(array('id_user = ?' => $id));

        /*$select = $sql->select()
            ->from(array('b' => 'banco_ids'))
            ->join(array('i' => 'info_comercializador'), 'b.id_comercializador = i.id_comercializador')
            ->where(array('b.id_user = ?' => $id));*/


        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result->isQueryResult() > 0) {
            $resultSet = new ResultSet();

            $list = $resultSet->initialize($result)->toArray();

            return $list;
        }
        else {
            throw new \Exception("The user is not a member of any company");
        }
    }

    /**
     * Devuelve la lista de las etiquetas que tiene el usuario $id
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function listTags($id) {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('banco_ids');
        $select->where(array('id_user = ?' => $id));
        
        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result->isQueryResult() > 0) {
            $resultSet = new ResultSet();

            $list = $resultSet->initialize($result)->toArray();

            return $list;
        }
        else {
            throw new \Exception("The user doesn't have any tag");
        }
    }

    /**
     * Añade la clave privada $key al usuario $id
     * @param $id
     * @param $key
     * @return bool
     */
    public function addKey($id, $key)
    {
        $action = new Insert('claves_notificaciones');
        $action->values(array('id_user = ?' => $id, 'clave = ?' => $key));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }

    /**
     * Borra la clave privada $key al usuario $id
     * @param $id
     * @param $key
     * @return bool
     */
    public function deleteKey($id, $key)
    {
        $action = new Delete('claves_notificaciones');
        $action->where(array('id_user = ?' => $id, 'clave = ?' => $key));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }
}