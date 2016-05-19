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
     * {@inheritDoc}
     */
    public function addItem(UserInterface $user) {
        return $this->userMapper->addUserItem($user);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteItem(UserInterface $user) {
        return $this->userMapper->deleteUserItem($user);
    }

    /**
     * {@inheritDoc}
     */
     public function getUserProfile($id){
         return $this->userMapper->getProfile($id);
     }

    /**
     * @param $id
     * @return mixed
     */
    public function changeServiceStatus($id) {
        return $this->userMapper->activeService($id);
    }

    /**
     * {@inheritDoc}
     */
    public function listUserServices($id) {
        return $this->userMapper->listServices($id);
    }

    /**
     * {@inheritDoc}
     */
    public function listUserInfoServices($id) {
        return $this->userMapper->listInfoServices($id);
    }


    public function listUserCompanies($id) {
        return $this->userMapper->listCompanies($id);
    }

    public function listUserTags($id) {
        return $this->userMapper->listTags($id);
    }

    /**
     * {@inheritDoc}
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