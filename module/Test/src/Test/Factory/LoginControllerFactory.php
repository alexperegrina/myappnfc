<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14/4/16
 * Time: 23:38
 */

namespace Test\Factory;

use Test\Controller\LoginController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoginControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $loginService = $realServiceLocator->get('Test\Service\LoginServiceInterface');

        $loginInsertForm = $realServiceLocator->get('FormElementManager')
            ->get('Test\Form\LoginForm');
        
        return new LoginController(
            $loginService,
            $loginInsertForm
        );
    }

}