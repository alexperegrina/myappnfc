<?php
/**
 * Created by PhpStorm.
 * User: irinavasilieva
 * Date: 23/04/16
 * Time: 13:11
 */

namespace User\Factory;

use User\Controller\ProfileController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProfileControllerFactory implements FactoryInterface
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
        //$userInsertForm = $realServiceLocator->get('FormElementManager')->get('User\Form\ProfileForm');
        $authService = $serviceLocator->getServiceLocator()->get('Authenticate\Service\AuthServiceInterface');

        return new ProfileController(
            $userService,
            //$userInsertForm,
            $authService
        );
    }
}