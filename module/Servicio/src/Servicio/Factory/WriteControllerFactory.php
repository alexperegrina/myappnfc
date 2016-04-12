<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/4/16
 * Time: 18:55
 */

namespace Servicio\Factory;

use Servicio\Controller\WriteController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WriteControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $servicioService = $realServiceLocator->get('Servicio\Service\ServicioServiceInterface');
        $servicioInsertForm = $realServiceLocator->get('FormElementManager')
            ->get('Servicio\Form\ServicioForm');

        
        return new WriteController(
            $servicioService,
            $servicioInsertForm
        );
    }
}