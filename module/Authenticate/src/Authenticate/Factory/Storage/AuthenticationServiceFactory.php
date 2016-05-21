<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17/4/16
 * Time: 18:49
 */

/**
 * This is a Class that call AuthStorage class.
 */

namespace Authenticate\Factory\Storage;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class AuthenticationServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter           = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $dbTableAuthAdapter      = new DbTableAuthAdapter($dbAdapter, 'users',
            'username','password');

//        $dbTableAuthAdapter      = new DbTableAuthAdapter($dbAdapter, 'users',
//            'username','password', 'MD5(?)');

        $authService = new AuthenticationService($serviceLocator->get('AuthStorage'),
            $dbTableAuthAdapter);

        return $authService;
    }
}