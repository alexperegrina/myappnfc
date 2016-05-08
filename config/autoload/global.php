<?php
/*
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=myappnfc;host=127.0.0.1',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
        ),
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
            array(
                'label' => 'Servicio', //Page #1
                'route' => 'servicio', //page-1
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'servicio/add',
                    ),
                ),
            ),
            array(
                'label' => 'User', //Page #2
                'route' => 'user',
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'user/add',
                    ),
                ),
            ),
            array(
                'label' => 'Comercializador', //Page #3
                'route' => 'comercializador',
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'comercializador/add',
                    ),
                ),
            ),
            array(
                'label' => 'Authenticate',
                'route' => 'authenticate',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
    'zf-mvc-auth' => array(
        'authentication' => array(
            'map' => array(
                'Status\\V1' => 'status',
            ),
        ),
    ),
);
