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
    public function deleteUser(UserInterface $user) {
        return $this->userMapper->delete($user);
    }
}