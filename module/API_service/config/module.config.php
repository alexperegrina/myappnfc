<?php
return array(
    'controllers' => array(
        'factories' => array(
            'API_service\\V1\\Rpc\\Test\\Controller' => 'API_service\\V1\\Rpc\\Test\\TestControllerFactory',
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => 'myappnfc\\V1\\Rpc\\Infousertoid\\InfousertoidControllerFactory',
            'myappnfc\\V1\\Rpc\\Login\\Controller' => 'myappnfc\\V1\\Rpc\\Login\\LoginControllerFactory',
            'myappnfc\\V1\\Rpc\\ServicesByUser\\Controller' => 'myappnfc\\V1\\Rpc\\ServicesByUser\\ServicesByUserControllerFactory',
            'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => 'myappnfc\\V1\\Rpc\\ProfileByUser\\ProfileByUserControllerFactory',
            'myappnfc\\V1\\Rpc\\SaveUser\\Controller' => 'myappnfc\\V1\\Rpc\\SaveUser\\SaveUserControllerFactory',
            'myappnfc\\V1\\Rpc\\SetServicesByUser\\Controller' => 'myappnfc\\V1\\Rpc\\SetServicesByUser\\SetServicesByUserControllerFactory',
            'API_service\\V1\\Rpc\\Login\\Controller' => 'API_service\\V1\\Rpc\\Login\\LoginControllerFactory',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'AuthStorage' => 'Authenticate\\Factory\\Storage\\AuthStorageFactory',
            'AuthService' => 'Authenticate\\Factory\\Storage\\AuthenticationServiceFactory',
            'Authenticate\\Service\\AuthServiceInterface' => 'Authenticate\\Factory\\Service\\AuthServiceFactory',
            'User\\Mapper\\UserMapperInterface' => 'User\\Factory\\ZendDbSqlMapperFactory',
            'User\\Service\\UserServiceInterface' => 'User\\Factory\\UserServiceFactory',
            'Servicio\\Mapper\\ServicioMapperInterface' => 'Servicio\\Factory\\ZendDbSqlMapperFactory',
            'Servicio\\Service\\ServicioServiceInterface' => 'Servicio\\Factory\\ServicioServiceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'api_service.rpc.test' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/test',
                    'defaults' => array(
                        'controller' => 'API_service\\V1\\Rpc\\Test\\Controller',
                        'action' => 'test',
                    ),
                ),
            ),
            'api_service.rpc.login' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/loginuser',
                    'defaults' => array(
                        'controller' => 'API_service\\V1\\Rpc\\Login\\Controller',
                        'action' => 'login',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'api_service.rpc.test',
            1 => 'api_service.rpc.login',
        ),
    ),
    'zf-rpc' => array(
        'API_service\\V1\\Rpc\\Test\\Controller' => array(
            'service_name' => 'Test',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'api_service.rpc.test',
        ),
        'API_service\\V1\\Rpc\\Login\\Controller' => array(
            'service_name' => 'Login',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'api_service.rpc.login',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'API_service\\V1\\Rpc\\Test\\Controller' => 'Json',
            'API_service\\V1\\Rpc\\Login\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'API_service\\V1\\Rpc\\Test\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'API_service\\V1\\Rpc\\Login\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'API_service\\V1\\Rpc\\Test\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
            ),
            'API_service\\V1\\Rpc\\Login\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'API_service\\V1\\Rpc\\Test\\Controller' => array(
                'actions' => array(
                    'Test' => array(
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
