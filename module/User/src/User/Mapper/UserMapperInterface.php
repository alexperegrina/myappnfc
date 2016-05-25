<?php
/**
 * Created by PhpStorm.
 * User: irina
 * Date: 12/4/16
 * Time: 23:59
 */
namespace User\Mapper;
use User\Model\UserInterface;
interface UserMapperInterface
{
    /**
     * @param int|string $id
     * @return UserInterface
     * @throws \InvalidArgumentException
     */
    public function find($id);
    /**
     * Metodo para cojer el usuario con el username
     *
     * @param string $username
     * @return UserInterface
     * @throws \InvalidArgumentException
     */
    public function findByUsername($username);
    /**
     * Metodo para cojer el perfil de un usuario con un ID del un NFC
     * 
     * @param $id
     * @return mixed
     */
    public function findByIdNFC($id);

    /**
     * @return array|UserInterface[]
     */
    public function findAll();
    /**
     * @param UserInterface $userObject
     * @return UserInterface
     * @throws \Exception
     */
    public function save(UserInterface $userObject);
    /**
     * @param UserInterface $userObject
     * @return bool
     * @throws \Exception
     */
    public function delete(UserInterface $userObject);
    /**
     * @param UserInterface $userObject
     *
     * @param UserInterface $userObject
     * @return UserInterface
     * @throws \Exception
    public function saveInfo(UserInterface $userObject);*/
    public function getProfile($id);
    /**
     * @param $id
     * @param $nfc
     * @return mixed
     */
    public function addUserItem($id, $nfc);
    /**
     * @param $id
     * @param $nfc
     * @return mixed
     */
    public function deleteUserItem($id, $nfc);
    /**
     * @param $id
     * @return mixed
     */
    public function activeService($id);
    /**
     * @param $id
     * @return mixed
     */
    public function listServices($id);
    /**
     * @param $id
     * @return mixed
     */
    public function listInfoServices($id);
    /**
     * @param $id
     * @return mixed
     */
    public function listTags($id);
    /**
     * @param $id
     * @param $clave
     * @return mixed
     */
    public function listCompanies($id);
    /**
     * @param $id
     * @param $key
     * @return mixed
     */
    public function addKey($id, $key);
    /**
     * @param $id
     * @param $key
     * @return mixed
     */
    public function deleteKey($id, $key);
    /**
     * Metodo para cojer un usuario con un cierto username
     *
     * @param $username
     * @return array
     */
    public function getRowByUsername($username) ;
    /**
     * @param int|string $id
     * @return bool
     */
    public function deleteAllPermisionServicesById($id);
    /**
     * @param String $username
     * @return bool
     */
    public function deleteAllPermisionServicesByUsername($username);
    /**
     * Metodo para insertar en la tabla de permisos_user_servicio los servicios pasado como parametro
     *
     * @param string $username
     * @param array strings $servicios, se pasa un array con los ids de los servicios que queremos activados.
     */
    public function insertPermisionsServicesActivesByUsername($username, $servicios);
    /**
     * Metodo para cojer todos los tokens de un usuario con el id
     *
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function findKeysById($id);
    /**
     * Metodo para cojer todos los tokens de un usuario con el username
     *
     * @param $username
     * @return array
     */
    public function findKeysByUsername($username);
}