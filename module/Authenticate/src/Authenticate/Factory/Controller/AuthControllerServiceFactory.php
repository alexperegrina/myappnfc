<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17/4/16
 * Time: 18:49
 */

/**
 * Controller creation need a factory, so we need to create a factory for it.
 */

namespace Authenticate\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Authenticate\Controller\AuthController;

class AuthControllerServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

//        $authService = $serviceLocator->getServiceLocator()->get('AuthService');
        $authService = $serviceLocator->getServiceLocator()->get('Authenticate\Service\AuthServiceInterface');
        
        $controller = new AuthController($authService);

        return $controller;
    }
}