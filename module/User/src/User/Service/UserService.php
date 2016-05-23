<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/4/16
 * Time: 0:15
 */

namespace User\Service;

use User\Model\UserInterface;
use User\Mapper\UserMapperInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var \User\Mapper\UserMapperInterface
     */
    protected $userMapper;

    /**
     * @param UserMapperInterface $userMapper
     */
    public function __construct(UserMapperInterface $userMapper){
        $this->userMapper = $userMapper;
    }

    /**
     * {@inheritDoc}
     */
    public function findAllUser() {
        return $this->userMapper->findAll();
    }

    /**
     * @param User $id
     */
    public function findUser($id) {
        return $this->userMapper->find($id);
    }

    /**
     * @param UserInterface $user
     */
    public function saveUser(UserInterface $user) {
        return $this->userMapper->save($user);
    }

    /**
     * @param UserInterface $user
     */
    public function deleteUser(UserInterface $user) {
        return $this->userMapper->delete($user);
    }

    /**
     * @param UserInterface $user
     * @param $nfc tag
     * @return mixed
     */
    public function addItem($id, $nfc) {
        return $this->userMapper->addUserItem($id, $nfc);
    }

    /**
     * @param UserInterface $user
     * @param $nfc tag
     * @return mixed
     */
    public function deleteItem($id, $nfc) {
        return $this->userMapper->deleteUserItem($id, $nfc);
    }

    /**
     * @param User $id
     * @return mixed
     */
     public function getUserProfile($id){
         return $this->userMapper->getProfile($id);
     }

    /**
     * @param $username
     * @param array[$id_servicio, status]
     * @return mixed
     */
    public function changeServiceStatus($username, $id_servicio) {
        return $this->userMapper->activeService($username, $id_servicio);
    }

    /**
     * @param User $id
     * @return mixed
     */
    public function listUserServices($id) {
        return $this->userMapper->listServices($id);
    }

    /**
     * @param User $id
     * @return mixed
     */
    public function listUserInfoServices($id) {
        return $this->userMapper->listInfoServices($id);
    }

    /**
     * @param User $id
     * @return mixed
     */
    public function listUserCompanies($id) {
        return $this->userMapper->listCompanies($id);
    }

    /**
     * @param User $id
     * @return mixed
     */
    public function listUserTags($id) {
        return $this->userMapper->listTags($id);
    }

    /**
     * @param UserInterface $user
     * @param $key
     * @return mixed
     */
    public function addPrivateKey(UserInterface $user, $key) {
        return $this->userMapper->addKey($user, $key);
    }

    /**
     * @param UserInterface $user
     * @param $key
     * @return mixed
     */
    public function deletePrivateKey(UserInterface $user, $key) {
        return $this->userMapper->deleteKey($user, $key);
    }

}