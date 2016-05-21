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
            'API_service\\V1\\Rpc\\ProfileByUser\\Controller' => 'API_service\\V1\\Rpc\\ProfileByUser\\ProfileByUserControllerFactory',
            'API_service\\V1\\Rpc\\SaveUser\\Controller' => 'API_service\\V1\\Rpc\\SaveUser\\SaveUserControllerFactory',
            'API_service\\V1\\Rpc\\SetServicesByUser\\Controller' => 'API_service\\V1\\Rpc\\SetServicesByUser\\SetServicesByUserControllerFactory',
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
            'api_service.rpc.profile-by-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/profilebyuser',
                    'defaults' => array(
                        'controller' => 'API_service\\V1\\Rpc\\ProfileByUser\\Controller',
                        'action' => 'profileByUser',
                    ),
                ),
            ),
            'api_service.rpc.save-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/saveuser',
                    'defaults' => array(
                        'controller' => 'API_service\\V1\\Rpc\\SaveUser\\Controller',
                        'action' => 'saveUser',
                    ),
                ),
            ),
            'api_service.rpc.set-services-by-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/setservicebyuser',
                    'defaults' => array(
                        'controller' => 'API_service\\V1\\Rpc\\SetServicesByUser\\Controller',
                        'action' => 'setServicesByUser',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'api_service.rpc.test',
            1 => 'api_service.rpc.login',
            2 => 'api_service.rpc.profile-by-user',
            3 => 'api_service.rpc.save-user',
            4 => 'api_service.rpc.set-services-by-user',
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
        'API_service\\V1\\Rpc\\ProfileByUser\\Controller' => array(
            'service_name' => 'ProfileByUser',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'api_service.rpc.profile-by-user',
        ),
        'API_service\\V1\\Rpc\\SaveUser\\Controller' => array(
            'service_name' => 'SaveUser',
            'http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'route_name' => 'api_service.rpc.save-user',
        ),
        'API_service\\V1\\Rpc\\SetServicesByUser\\Controller' => array(
            'service_name' => 'SetServicesByUser',
            'http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'route_name' => 'api_service.rpc.set-services-by-user',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'API_service\\V1\\Rpc\\Test\\Controller' => 'Json',
            'API_service\\V1\\Rpc\\Login\\Controller' => 'Json',
            'API_service\\V1\\Rpc\\ProfileByUser\\Controller' => 'Json',
            'API_service\\V1\\Rpc\\SaveUser\\Controller' => 'Json',
            'API_service\\V1\\Rpc\\SetServicesByUser\\Controller' => 'Json',
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
            'API_service\\V1\\Rpc\\ProfileByUser\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'API_service\\V1\\Rpc\\SaveUser\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'API_service\\V1\\Rpc\\SetServicesByUser\\Controller' => array(
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
            'API_service\\V1\\Rpc\\ProfileByUser\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
            ),
            'API_service\\V1\\Rpc\\SaveUser\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
            ),
            'API_service\\V1\\Rpc\\SetServicesByUser\\Controller' => array(
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
            'API_service\\V1\\Rpc\\ProfileByUser\\Controller' => array(
                'actions' => array(
                    'ProfileByUser' => array(
                        'GET' => true,
                        'POST' => false,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ),
                ),
            ),
            'API_service\\V1\\Rpc\\SaveUser\\Controller' => array(
                'actions' => array(
                    'SaveUser' => array(
                        'GET' => true,
                        'POST' => true,
                        'PUT' => false,
                        'PATCH' => false,
                        'DELETE' => false,
                    ),
                ),
            ),
            'API_service\\V1\\Rpc\\SetServicesByUser\\Controller' => array(
                'actions' => array(
                    'SetServicesByUser' => array(
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
