<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 23:54
 */

namespace User\Service;

use User\Model\UserInterface;

interface UserServiceInterface
{
    /**
     * Devuelve un conjunto de Users
     * @return array|UserInterface[]
     */
    public function findAllUser();

    /**
     * Devulve un User
     * @param  int $id Identificador del User a devolver
     * @return UserInterface
     */
    public function findUser($id);

    /**
     * @param $username
     * @return UserInterface mixed
     */
    public function findUserByUsername($username);

    /**
     * Metodo para cojer el perfil de un usuario con un ID del un NFC
     * @param string $id
     * @return UserInterface
     */
    public function findUserByIdNFC($id);

    /**
     * Crea un User nuevo o actualiza uno existente
     * @param  UserInterface $user
     * @return UserInterface
     */
    public function saveUser(UserInterface $user);

    /**
     * Elimina un User y sino devuelve false.
     *
     * @param  UserInterface $user
     * @return bool
     */
    public function deleteUser(UserInterface $user);


    /**
     * Añade una etiqueta nueva $nfc
     * @param UserInterface $user
     * @return mixed
     */
    public function addItem($id, $nfc);

    /**
     * Borra una etiqueta $nfc
     * @param UserInterface $user
     * @return mixed
     */
    public function deleteItem($id, $nfc);

    /**
     * Devuelve el perfil de usuario como un array
     * @param User $id
     * @return mixed
     */
    public function getUserProfile($id);

    /**
     * Cambia el estado de un servicio existente
     * @param $username
     * @param array[$id_servicio, status]
     * @return mixed
     */
    public function changeServiceStatus($username, $id_servicio);

    /**
     * Lista todos los servicios disponibles
     * @param $id
     * @return mixed
     */
    public function listUserServices($id);

    /**
     * Devuelve la informacion sobre los servicios relacionada al usuario $id
     * @param $id
     * @return mixed
     */
    public function listUserInfoServices($id);

    /**
     * Metodo para cojer todos los tokens de un usuario con el username
     * 
     * @param string $username
     * @return mixed
     */
    public function findKeysByUsername($username);
    
    /**
     * Lista las etiquetas de usuario
     * @param $id
     * @return mixed
     */
    public function listUserTags($id);

    /**
     * Devuelve la informacion sobre los comercializadores relacionada al usuario $id
     * @param $id
     * @return mixed
     */
    public function listUserCompanies($id);

    /**
     * Añade una clave privada $key al usuario $user
     * @param UserInterface $user
     * @return mixed
     */
    public function addPrivateKey(UserInterface $user, $key);

    /**
     * Borra la clave privada $key al usuario $suser
     * @param UserInterface $user
     * @param $key
     * @return mixed
     */
    public function deletePrivateKey(UserInterface $user, $key);

    /**
     * Metodo para validar si un username ya esta siendo utilizado
     *
     * @param $username
     * @return bool
     */
    public function usernameValid($username);

    /**
     * Metodo para activar los servicios pasados como parametro, El metodo automaticamente elimina todos los
     * permisos para este usuario y los vuelve a insertar.
     *
     * @param $id
     * @param array $string $Services, id de los servicios que queremos activar.
     */
    public function replacePermisionServices($username, $services);
    
}