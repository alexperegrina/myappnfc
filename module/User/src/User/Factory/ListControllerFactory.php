<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/4/16
 * Time: 0:04
 */

namespace User\Factory;

use User\Controller\ListController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListControllerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();

        $userService = $realServiceLocator->get('User\Service\UserServiceInterface');
        $authService = $serviceLocator->getServiceLocator()->get('Authenticate\Service\AuthServiceInterface');
        
        return new ListController($userService, $authService);
    }
}