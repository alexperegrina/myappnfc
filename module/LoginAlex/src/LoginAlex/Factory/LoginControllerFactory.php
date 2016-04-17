<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14/4/16
 * Time: 23:38
 */

namespace LoginAlex\Factory;

use LoginAlex\Controller\LoginController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoginControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $loginService = $realServiceLocator->get('LoginAlex\Service\LoginServiceInterface');

        $loginInsertForm = $realServiceLocator->get('FormElementManager')
            ->get('LoginAlex\Form\LoginForm');
        
        return new LoginController(
            $loginService,
            $loginInsertForm
        );
    }

}