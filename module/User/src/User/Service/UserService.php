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
     * {@inheritDoc}
     */
    public function findUser($id) {
        return $this->userMapper->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function findUserByUsername($username) {
        return $this->userMapper->findByUsername($username);
    }
    

    /**
     * {@inheritDoc}
     */
    public function saveUser(UserInterface $user) {
        // esta marranada hay que quitarla cuando se quite el atributo id_user
        if($user->getId_user() == null) {
            $user->getId_user($user->getId());
        }
        // fin marranada
        return $this->userMapper->save($user);
    }

    /**
     * {@inheritDoc}
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
    public function changeServiceStatus($username, $array_servicio) {
        return $this->userMapper->activeService($username, $array_servicio);
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
     * {@inheritDoc}
     */
    public function findKeysByUsername($username) {
        return $this->userMapper->findKeysByUsername($username);
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

    /**
     * {@inheritDoc}
     */
    public function usernameValid($username) {

        $row = $this->userMapper->getRowByUsername($username);
        return count($row) == 0 ? true : false;
    }

    /**
     * {@inheritDoc}
     */
    public function replacePermisionServices($username, $services) {
        $this->userMapper->deleteAllPermisionServicesByUsername($username);
        return $this->userMapper->insertPermisionsServicesActivesByUsername($username, $services);
    }

}