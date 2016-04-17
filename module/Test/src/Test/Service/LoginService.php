<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14/4/16
 * Time: 23:56
 */

namespace Test\Service;

use Test\Model\UserInterface;
use Test\Mapper\LoginMapperInterface;

class LoginService implements LoginServiceInterface
{
    
    
    /**
     * @var \Test\Mapper\LoginMapperInterface
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