<?php
return array(
    'controllers' => array(
        'factories' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => 'myappnfc\\V1\\Rpc\\Infousertoid\\InfousertoidControllerFactory',
            'myappnfc\\V1\\Rpc\\Login\\Controller' => 'myappnfc\\V1\\Rpc\\Login\\LoginControllerFactory',
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'AuthStorage' => 'Authenticate\Factory\Storage\AuthStorageFactory',
            'AuthService' => 'Authenticate\Factory\Storage\AuthenticationServiceFactory',
            'Authenticate\Service\AuthServiceInterface' => 'Authenticate\Factory\Service\AuthServiceFactory',
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
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'myappnfc.rpc.infousertoid',
            1 => 'myappnfc.rpc.login',
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
            ),
            'route_name' => 'myappnfc.rpc.login',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => 'Json',
            'myappnfc\\V1\\Rpc\\Login\\Controller' => 'Json',
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
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ),
                ),
            ),
        ),
    ),
);
