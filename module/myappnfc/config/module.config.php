<?php
return array(
    'controllers' => array(
        'factories' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => 'myappnfc\\V1\\Rpc\\Infousertoid\\InfousertoidControllerFactory',
            'myappnfc\\V1\\Rpc\\Login\\Controller' => 'myappnfc\\V1\\Rpc\\Login\\LoginControllerFactory',
            'myappnfc\\V1\\Rpc\\ServicesByUser\\Controller' => 'myappnfc\\V1\\Rpc\\ServicesByUser\\ServicesByUserControllerFactory',
            'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => 'myappnfc\\V1\\Rpc\\ProfileByUser\\ProfileByUserControllerFactory',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'AuthStorage' => 'Authenticate\\Factory\\Storage\\AuthStorageFactory',
            'AuthService' => 'Authenticate\\Factory\\Storage\\AuthenticationServiceFactory',
            'Authenticate\\Service\\AuthServiceInterface' => 'Authenticate\\Factory\\Service\\AuthServiceFactory',
            'User\Mapper\UserMapperInterface'   => 'User\Factory\ZendDbSqlMapperFactory',
            'User\Service\UserServiceInterface' => 'User\Factory\UserServiceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'myappnfc.rpc.infousertoid' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/infousertoid',
                    'defaults' => array(
                        'controller' => 'myappnfc\\V1\\Rpc\\Infousertoid\\Controller',
                        'action' => 'infousertoid',
                    ),
                ),
            ),
            'myappnfc.rpc.login' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/loginuser',
                    'defaults' => array(
                        'controller' => 'myappnfc\\V1\\Rpc\\Login\\Controller',
                        'action' => 'login',
                    ),
                ),
            ),
            'myappnfc.rpc.services-by-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/servicesbyuser',
                    'defaults' => array(
                        'controller' => 'myappnfc\\V1\\Rpc\\ServicesByUser\\Controller',
                        'action' => 'servicesByUser',
                    ),
                ),
            ),
            'myappnfc.rpc.profile-by-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/profilebyuser',
                    'defaults' => array(
                        'controller' => 'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller',
                        'action' => 'profileByUser',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'myappnfc.rpc.infousertoid',
            1 => 'myappnfc.rpc.login',
            2 => 'myappnfc.rpc.services-by-user',
            3 => 'myappnfc.rpc.profile-by-user',
        ),
    ),
    'zf-rpc' => array(
        'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => array(
            'service_name' => 'infousertoid',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'myappnfc.rpc.infousertoid',
        ),
        'myappnfc\\V1\\Rpc\\Login\\Controller' => array(
            'service_name' => 'Login',
            'http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'route_name' => 'myappnfc.rpc.login',
        ),
        'myappnfc\\V1\\Rpc\\ServicesByUser\\Controller' => array(
            'service_name' => 'ServicesByUser',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'myappnfc.rpc.services-by-user',
        ),
        'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => array(
            'service_name' => 'ProfileByUser',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'myappnfc.rpc.profile-by-user',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => 'Json',
            'myappnfc\\V1\\Rpc\\Login\\Controller' => 'Json',
            'myappnfc\\V1\\Rpc\\ServicesByUser\\Controller' => 'Json',
            'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => array(
                0 => 'application/vnd.myappnfc.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'myappnfc\\V1\\Rpc\\Login\\Controller' => array(
                0 => 'application/vnd.myappnfc.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'myappnfc\\V1\\Rpc\\ServicesByUser\\Controller' => array(
                0 => 'application/vnd.myappnfc.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => array(
                0 => 'application/vnd.myappnfc.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => array(
                0 => 'application/vnd.myappnfc.v1+json',
                1 => 'application/json',
            ),
            'myappnfc\\V1\\Rpc\\Login\\Controller' => array(
                0 => 'application/vnd.myappnfc.v1+json',
                1 => 'application/json',
            ),
            'myappnfc\\V1\\Rpc\\ServicesByUser\\Controller' => array(
                0 => 'application/vnd.myappnfc.v1+json',
                1 => 'application/json',
            ),
            'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => array(
                0 => 'application/vnd.myappnfc.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'myappnfc\\V1\\Rpc\\Login\\Controller' => array(
            'input_filter' => 'myappnfc\\V1\\Rpc\\Login\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'myappnfc\\V1\\Rpc\\Login\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'user',
                'description' => 'user a identificar',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'password',
                'description' => 'password del usuario a validar',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => array(
                'actions' => array(
                    'infousertoid' => array(
                        'GET' => true,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ),
                ),
            ),
            'myappnfc\\V1\\Rpc\\Login\\Controller' => array(
                'actions' => array(
                    'Login' => array(
                        'GET' => true,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ),
                ),
            ),
        ),
    ),
);
