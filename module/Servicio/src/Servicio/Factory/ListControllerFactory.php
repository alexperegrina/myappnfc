<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/4/16
 * Time: 0:34
 */

namespace Servicio\Factory;

use Servicio\Controller\ListController;
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
        
        $servicioService = $realServiceLocator->get('Servicio\Service\ServicioServiceInterface');
        return new ListController($servicioService);
    }
}