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
     * Devuelve un conjunto de Users. se supone que son \User\Model\UserInterface
     *
     * @return array|UserInterface[]
     */
    public function findAllUser();

    /**
     * Devulve un unico User
     *
     * @param  int $id Identificador del User a devolver
     * @return UserInterface
     */
    public function findUser($id);

    /**
     * Guarda un User
     *
     * @param  UserInterface $user
     * @return UserInterface
     */
    public function saveUser(UserInterface $user);

    /**
     * @param UserInterface $user
     * @return mixed

    public function saveInfoUser(UserInterface $user);*/

    /**
     * Elimina un User y si no devuelve false.
     *
     * @param  UserInterface $user
     * @return bool
     */
    public function deleteUser(UserInterface $user);


    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function addItem(UserInterface $user);

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function deleteItem(UserInterface $user);

    public function getUserProfile($id);

    /**
     * @param $id
     * @return mixed
     */
    public function changeServiceStatus($id);

    /**
     * @param $id
     * @return mixed
     */
    public function listUserServices($id);

    /**
     * @param $id
     * @return mixed
     */
    public function listUserCompanies($id);

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function addPrivateKey(UserInterface $user);

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function deletePrivateKey(UserInterface $user);

    public function loginUser($userid, $passwd);

}