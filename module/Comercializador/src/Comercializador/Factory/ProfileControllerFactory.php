<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14/5/16
 * Time: 21:17
 */

namespace Comercializador\Factory;

use Comercializador\Controller\ProfileController;
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
        $comercializadorService = $realServiceLocator->get('Comercializador\Service\ComercializadorServiceInterface');

        return new ProfileController(
            $comercializadorService
        );
    }
}