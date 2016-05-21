<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 15/5/16
 * Time: 17:34
 */

namespace Comercializador\Factory;

use Comercializador\Controller\IdController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IdControllerFactory implements FactoryInterface
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
        return new IdController($comercializadorService);
    }

}