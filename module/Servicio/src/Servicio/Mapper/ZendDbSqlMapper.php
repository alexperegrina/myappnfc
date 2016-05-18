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
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Join;
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
        $select = $sql->select()
            ->from(array('u' => 'users'))
            ->join(
                array('i' => 'info_servicio'),
                'u.id = i.id_servicio',
                Select::SQL_STAR, Join::JOIN_LEFT)
            ->where(array('u.id = ?' => $id));

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
        
        $select = $sql->select()
            ->from(array('u' => 'users'))
            ->join(
                array('i' => 'info_servicio'),
                'u.id = i.id_servicio',
                array('nombre', 'descripcion'), Join::JOIN_LEFT)
            ->where(array('tipo = "servicio"'));

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

        //insertamos el tipo de user
        $servicioData['tipo'] = 'servicio';

        $sql    = new Sql($this->dbAdapter);
        
        if ($servicioObject->getId()) {

            $action = new Update('users');
            $action->join(array('i' => 'info_servicio'), 'id = i.id_servicio')
                ->where(array('id = ?' => $servicioObject->getId()))
                ->set($servicioData);


            /**
             * esto demomento aqui
             */
            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();

            if ($result instanceof ResultInterface) {
                if ($newId = $result->getGeneratedValue()) {
                    // When a value has been generated, set it on the object
                    $servicioObject->setId($newId);
                }

                return $servicioObject;
            }
            
        } else {
            
            $servicio = $this->multiSelectArray($servicioData, array('username', 'password', 'mail', 'tipo'));
            $servicioInfo = $this->multiSelectArray($servicioData, array('nombre', 'descripcion'));

            // ID NOT present, it's an Insert
            $action = new Insert('users');
            $action->values($servicio);

            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();

            if ($result instanceof ResultInterface) {
                if ($newId = $result->getGeneratedValue()) {
                    // When a value has been generated, set it on the object
                    $servicioObject->setId($newId);
                }
            }

            $servicioInfo['id_comercializador'] = $servicioObject->getId();
            $action = new Insert('info_servicio');
            $action->values($servicioInfo);

            $stmt   = $sql->prepareStatementForSqlObject($action);
            $result = $stmt->execute();

            return $this->find($servicioObject->getId());
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

    /**
     * {@inheritDoc}
     */
    public function findServicesByUsername($username) {
        $sql    = new Sql($this->dbAdapter);


        $select = $sql->select()
            ->from(array('u' => 'users'))
//            ->columns(array('id', 'username', 'password', 'mail'))
            ->join(array('p' => 'permisos_user_servicio'),
                   'u.id = p.id_user',
                    array())
            ->join(array('i' => 'info_servicio'), 'i.id_servicio = p.id_servicio',
                array('id' =>'id_servicio','nombre', 'descripcion'))
            ->where(array('u.username = ?' => $username));

        $select = $sql->select()
            ->from(array('u' => 'users'))
//            ->columns(array('id', 'username', 'password', 'mail'))
            ->columns(array())
            ->join(array('p' => 'permisos_user_servicio'),
                'u.id = p.id_user',
                array())
            ->join(array('i' => 'info_servicio'), 'i.id_servicio = p.id_servicio', array('nombre', 'descripcion'))
            ->join(array('s' => 'users'), 's.id = p.id_servicio', array('id', 'username', 'password', 'mail'))
            ->where(array('u.username = ?' => $username));



//        SELECT i.id_servicio, i.nombre, i.descripcion
//        FROM users as u
//        JOIN permisos_user_servicio as p on u.id = p.id_user
//        LEFT JOIN info_servicio as i on i.id_servicio = p.id_servicio
//        LEFT JOIN users as s on s.id = p.id_servicio
//        WHERE u.username = 'alex'

        $stmt   = $sql->prepareStatementForSqlObject($select);
//print_r($stmt);die();
        $result = $stmt->execute();


        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new HydratingResultSet($this->hydrator, $this->servicioPrototype);

            return $resultSet->initialize($result);
        }

        return array();

//        if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
//            return $this->hydrator->hydrate($result->current(), $this->servicioPrototype);
//        }

        throw new \InvalidArgumentException("User con username:{$username} no existe.");
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