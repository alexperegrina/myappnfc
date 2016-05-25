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
use Zend\Db\Sql\Join;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\TableIdentifier;
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
        $sql    = new Sql($this->dbAdapter);

        $select = $sql->select()
            ->from(array('u' => 'users'))
            ->join(array('i' => 'info_user'), 'u.id = i.id_user', Select::SQL_STAR, Join::JOIN_LEFT)
            ->where(array('u.id = ?' => $id));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
            return $this->hydrator->hydrate($result->current(), $this->userPrototype);
        }

        throw new \InvalidArgumentException("User con ID:{$id} no existe.");
    }

    /**
     * {@inheritDoc}
     */
    public function findByUsername($username)
    {
        $sql    = new Sql($this->dbAdapter);

        $select = $sql->select()
            ->from(array('u' => 'users'))
            ->join(array('i' => 'info_user'), 'u.id = i.id_user', Select::SQL_STAR, Join::JOIN_LEFT)
            ->where(array('u.username = ?' => $username));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
            return $this->hydrator->hydrate($result->current(), $this->userPrototype);
        }

        throw new \InvalidArgumentException("User con username:{$username} no existe.");
    }

    /**
     * {@inheritDoc}
     */
    public function findByIdNFC($id) {
        $sql    = new Sql($this->dbAdapter);

        $select = $sql->select()
            ->from(array('u' => 'users'))
            ->join(array('i' => 'info_user'), 'u.id = i.id_user', Select::SQL_STAR, Join::JOIN_LEFT)
            ->join(array('id' => 'banco_ids'), 'u.id = id.id_user', Select::SQL_STAR, Join::JOIN_LEFT)
            ->where(array('id.id' => $id));

        $stmt   = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
            return $this->hydrator->hydrate($result->current(), $this->userPrototype);
        }

        throw new \InvalidArgumentException("En el banco de id no existe $id");
    }

    /**
     * Devuelve un array de perfiles de todos los usuarios
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

        if ($result->count() == 1) {
            return $resultSet->initialize($result)->toArray()[0];
        }
        else {
            throw new \Exception("The user doesn't info");
        }
    }


    /**
     * Cambia el estado del servicio $id_servicio
     * @param $id
     * @return array
     * @throws \Exception
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
        /*$select = $sql->select()
            ->from(array('p' => 'permisos_user_servicio'))
            ->join(array('i' => 'info_servicio'),
                    'p.id_servicio = i.id_servicio',
                    array('nombre'), 'left');*/

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
     * {@inheritDoc}
     */
    public function listServicesByUsername($id) {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('permisos_user_servicio');

        $select->join(array('i' => 'info_servicio'), // join table with alias
                            'id_servicio = i.id_servicio');
        $select->where(array('id_user = ?' => $id));

        $stmt   = $sql->prepareStatementForSqlObject($select);

        //\Zend\Debug\Debug::dump($stmt);die();
        $result = $stmt->execute();

        if ($result->isQueryResult() > 0) {
            $resultSet = new ResultSet();

            $list = $resultSet->initialize($result)->toArray();

            return $list;
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
     * {@inheritDoc}
     */
    public function findKeysById($id) {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('claves_notificaciones');
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
     * {@inheritDoc}
     */
    public function findKeysByUsername($username) {
        $sql    = new Sql($this->dbAdapter);
        $select = $sql->select('claves_notificaciones');
        $select->columns(array('clave'));
        $select->join(array('u' => 'users'), // join table with alias
            'id_user = u.id', array());
        $select->where(array('u.username = ?' => $username));

        $stmt   = $sql->prepareStatementForSqlObject($select);

        $result = $stmt->execute();

        if ($result->isQueryResult() > 0) {
            $resultSet = new ResultSet();

            $list = $resultSet->initialize($result)->toArray();

            return $list;
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
        $action->values(array('id_user' => $id, 'clave' => $key));

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

    /**
     * {@inheritDoc}
     */
    public function deleteAllPermisionServicesById($id)
    {
        $action = new Delete('permisos_user_servicio');
        $action->where(array('id_user = ?' => $id));

        $sql    = new Sql($this->dbAdapter);
        $stmt   = $sql->prepareStatementForSqlObject($action);
//        print_r($stmt);die();
        $result = $stmt->execute();

        return (bool)$result->getAffectedRows();
    }

    /**
     * {@inheritDoc}
     */
    public function deleteAllPermisionServicesByUsername($username) 
    {
        $user = $this->findByUsername($username);
        return $this->deleteAllPermisionServicesById($user->getId());
    }

    /**
     * {@inheritDoc}
     */
    public function insertPermisionsServicesActivesByUsername($username, $servicios) 
    {
        $user = $this->findByUsername($username);

        foreach ($servicios AS $servicio) {
            $action = new Insert('permisos_user_servicio');
            $action->values(array(
                'id_user' => $user->getId(),
                'id_servicio' => $servicio,
                'informacion_total' => true));

            $sql    = new Sql($this->dbAdapter);
            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();
        }
        return true;
    }
}