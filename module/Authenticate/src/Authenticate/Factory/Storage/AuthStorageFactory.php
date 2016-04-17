<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17/4/16
 * Time: 18:50
 */

/**
 * Remember, that setting up service via closure is bad for performance, so we need to make a factory class for it.
 */

namespace Authenticate\Factory\Storage;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Authenticate\Storage\AuthStorage;

class AuthStorageFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $storage = new AuthStorage('myappnfc');
        $storage->setServiceLocator($serviceLocator);
        $storage->setDbHandler();

        return $storage;
    }
}