<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14/4/16
 * Time: 23:55
 */

namespace LoginAlex\Factory;

use LoginAlex\Service\LoginService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoginServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        
        return new LoginService(
            $serviceLocator->get('LoginAlex\Mapper\LoginMapperInterface')
        );
    }
}