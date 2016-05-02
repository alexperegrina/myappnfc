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
     *
     * @param UserInterface $userObject
     * @return UserInterface
     * @throws \Exception
     */
    public function save(UserInterface $userObject);

    /**
     * @param UserInterface $userObject
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(UserInterface $userObject);
}