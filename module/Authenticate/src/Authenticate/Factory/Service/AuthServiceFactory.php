<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/5/16
 * Time: 23:51
 */

namespace Authenticate\Factory\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Authenticate\Service\AuthService;

class AuthServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
//        print_r($serviceLocator);die();

        $authService = $serviceLocator->get('AuthService');
        $service = new AuthService($authService);

        return $service;
    }
}