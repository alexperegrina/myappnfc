<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/4/16
 * Time: 0:38
 */

namespace Comercializador\Factory;

use Comercializador\Service\ComercializadorService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ComercializadorServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ComercializadorService(
            $serviceLocator->get('Comercializador\Mapper\ComercializadorMapperInterface')
        );
    }

}