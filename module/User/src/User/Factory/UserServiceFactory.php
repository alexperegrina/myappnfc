<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/4/16
 * Time: 0:05
 */

namespace User\Factory;

use User\Service\UserService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new UserService(
            $serviceLocator->get('User\Mapper\UserMapperInterface')
        );

    }
}