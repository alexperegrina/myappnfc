<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/4/16
 * Time: 18:55
 */

namespace Comercializador\Factory;

use Comercializador\Controller\WriteController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WriteControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $comercializadorService = $realServiceLocator->get('Comercializador\Service\ComercializadorServiceInterface');
        $comercializadorInsertForm = $realServiceLocator->get('FormElementManager')
            ->get('Comercializador\Form\ComercializadorForm');

        
        return new WriteController(
            $comercializadorService,
            $comercializadorInsertForm
        );
    }
}