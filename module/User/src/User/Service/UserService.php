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
    public function __construct(UserMapperInterface $userMapper)
    {
        $this->userMapper = $userMapper;
    }

    /**
     * {@inheritDoc}
     */
    public function findAllUser() {
        return $this->userMapper->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function findUser($id) {
        return $this->userMapper->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function saveUser(UserInterface $user) {
        return $this->userMapper->save($user);
    }

    /**
     * {@inheritDoc}
     */
    public function saveInfoUser(UserInterface $user) {
        return $this->userMapper->saveInfo($user);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteUser(UserInterface $user) {
        return $this->userMapper->delete($user);
    }

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function registerItem(UserInterface $user) {
        return $this->userMapper->addItem($user);
    }

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function deleteItem(UserInterface $user) {
        return $this->userMapper->deleteUserItem($user);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function changeServiceStatus($id) {
        return $this->userMapper->activeService($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function listUserServices($id) {
        return $this->userMapper->listServices($id);
    }

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function addPrivateKey(UserInterface $user) {
        return $this->userMapper->addKey();
    }

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function deletePrivateKey(UserInterface $user) {
        return $this->userMapper->deleteKey();
    }

}