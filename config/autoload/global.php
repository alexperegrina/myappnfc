<?php
return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=myappnfc;host=127.0.0.1',
        'driver_options' => array(
            1002 => 'SET NAMES \'UTF8\'',
        ),
    ),
    'navigation' => array(
        'default' => array(
            0 => array(
                'label' => 'Home',
                'route' => 'home',
            ),
            1 => array(
                'label' => 'Servicio',
                'route' => 'servicio',
                'pages' => array(
                    0 => array(
                        'label' => 'Add',
                        'route' => 'servicio/add',
                    ),
                ),
            ),
            2 => array(
                'label' => 'User',
                'route' => 'user',
                'pages' => array(
                    0 => array(
                        'label' => 'Add',
                        'route' => 'user/add',
                    ),
                ),
            ),
            3 => array(
                'label' => 'Comercializador',
                'route' => 'comercializador',
                'pages' => array(
                    0 => array(
                        'label' => 'Add',
                        'route' => 'comercializador/add',
                    ),
                ),
            ),
            4 => array(
                'label' => 'Authenticate',
                'route' => 'authenticate',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\\Db\\Adapter\\Adapter' => 'Zend\\Db\\Adapter\\AdapterServiceFactory',
            'navigation' => 'Zend\\Navigation\\Service\\DefaultNavigationFactory',
        ),
    ),
    'zf-mvc-auth' => array(
        'authentication' => array(
            'map' => array(
                'Status\\V1' => 'status',
                'myappnfc\\V1' => 'status',
            ),
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
