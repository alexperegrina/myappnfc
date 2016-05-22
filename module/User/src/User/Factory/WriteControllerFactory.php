<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/4/16
 * Time: 0:20
 */

namespace User\Factory;

use User\Controller\WriteController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WriteControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $userService = $realServiceLocator->get('User\Service\UserServiceInterface');
        $userInsertForm = $realServiceLocator->get('FormElementManager')
            ->get('User\Form\UserForm');
        $authService = $serviceLocator->getServiceLocator()->get('Authenticate\Service\AuthServiceInterface');


        return new WriteController(
            $userService,
            $userInsertForm,
            $authService
        );
    }
}