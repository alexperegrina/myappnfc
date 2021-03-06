<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29/3/16
 * Time: 1:39
 */

namespace Comercializador\Factory;

use Comercializador\Mapper\ZendDbSqlMapper;
use Comercializador\Model\Comercializador;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ZendDbSqlMapperFactory implements FactoryInterface
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
        return new ZendDbSqlMapper(
            $serviceLocator->get('Zend\Db\Adapter\Adapter'),
            new ClassMethods(false),
            new Comercializador()
        );
    }
}