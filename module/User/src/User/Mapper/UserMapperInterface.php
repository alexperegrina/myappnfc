<?php
/**
 * Created by PhpStorm.
 * User: alex
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
    public function activeService($username, $id_servicio);

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
}