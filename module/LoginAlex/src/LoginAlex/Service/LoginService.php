<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14/4/16
 * Time: 23:56
 */

namespace LoginAlex\Service;

use LoginAlex\Model\UserInterface;
use LoginAlex\Mapper\LoginMapperInterface;

class LoginService implements LoginServiceInterface
{
    /**
     * @var \LoginAlex\Mapper\LoginMapperInterface
     */
    protected $loginMapper;

    /**
     * @param LoginMapperInterface $loginMapper
     */
    public function __construct(LoginMapperInterface $loginMapper)
    {

        $this->loginMapper = $loginMapper;

    }

    /**
     * {@inheritDoc}
     */
    public function findUser($username) {
        return $this->loginMapper->findByUsername($username);
    }
}