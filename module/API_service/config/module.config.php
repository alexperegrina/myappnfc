<?php
return array(
    'controllers' => array(
        'factories' => array(
            'API_service\\V1\\Rpc\\Infousertoid\\Controller' => 'API_service\\V1\\Rpc\\Infousertoid\\InfousertoidControllerFactory',
            'API_service\\V1\\Rpc\\Login\\Controller' => 'API_service\\V1\\Rpc\\Login\\LoginControllerFactory',
            'API_service\\V1\\Rpc\\ServicesByUser\\Controller' => 'API_service\\V1\\Rpc\\ServicesByUser\\ServicesByUserControllerFactory',
            'API_service\\V1\\Rpc\\ProfileByUser\\Controller' => 'API_service\\V1\\Rpc\\ProfileByUser\\ProfileByUserControllerFactory',
            'API_service\\V1\\Rpc\\SaveUser\\Controller' => 'API_service\\V1\\Rpc\\SaveUser\\SaveUserControllerFactory',
            'API_service\\V1\\Rpc\\SetServicesByUser\\Controller' => 'API_service\\V1\\Rpc\\SetServicesByUser\\SetServicesByUserControllerFactory',
            'API_service\\V1\\Rpc\\TokensUser\\Controller' => 'API_service\\V1\\Rpc\\TokensUser\\TokensUserControllerFactory',
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
            'api_service.rpc.services-by-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/servicesbyuser',
                    'defaults' => array(
                        'controller' => 'API_service\\V1\\Rpc\\ServicesByUser\\Controller',
                        'action' => 'servicesByUser',
                    ),
                ),
            ),
            'api_service.rpc.tokens-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tokensuser',
                    'defaults' => array(
                        'controller' => 'API_service\\V1\\Rpc\\TokensUser\\Controller',
                        'action' => 'tokensUser',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            1 => 'api_service.rpc.login',
            2 => 'api_service.rpc.profile-by-user',
            3 => 'api_service.rpc.save-user',
            4 => 'api_service.rpc.set-services-by-user',
            5 => 'api_service.rpc.services-by-user',
            0 => 'api_service.rpc.tokens-user',
        ),
    ),
    'zf-rpc' => array(
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
                0 => 'POST',
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
        'API_service\\V1\\Rpc\\ServicesByUser\\Controller' => array(
            'service_name' => 'ServicesByUser',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'api_service.rpc.services-by-user',
        ),
        'API_service\\V1\\Rpc\\TokensUser\\Controller' => array(
            'service_name' => 'TokensUser',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'api_service.rpc.tokens-user',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'API_service\\V1\\Rpc\\Login\\Controller' => 'Json',
            'API_service\\V1\\Rpc\\ProfileByUser\\Controller' => 'Json',
            'API_service\\V1\\Rpc\\SaveUser\\Controller' => 'Json',
            'API_service\\V1\\Rpc\\SetServicesByUser\\Controller' => 'Json',
            'API_service\\V1\\Rpc\\ServicesByUser\\Controller' => 'Json',
            'API_service\\V1\\Rpc\\TokensUser\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
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
            'API_service\\V1\\Rpc\\ServicesByUser\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'API_service\\V1\\Rpc\\TokensUser\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
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
            'API_service\\V1\\Rpc\\ServicesByUser\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
            ),
            'API_service\\V1\\Rpc\\TokensUser\\Controller' => array(
                0 => 'application/vnd.api_service.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'API_service\\V1\\Rpc\\Login\\Controller' => array(
            'input_filter' => 'API_service\\V1\\Rpc\\Login\\Validator',
        ),
        'API_service\\V1\\Rpc\\SaveUser\\Controller' => array(
            'input_filter' => 'API_service\\V1\\Rpc\\SaveUser\\Validator',
        ),
        'API_service\\V1\\Rpc\\ProfileByUser\\Controller' => array(
            'input_filter' => 'API_service\\V1\\Rpc\\ProfileByUser\\Validator',
        ),
        'API_service\\V1\\Rpc\\ServicesByUser\\Controller' => array(
            'input_filter' => 'API_service\\V1\\Rpc\\ServicesByUser\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'API_service\\V1\\Rpc\\Login\\Validator' => array(
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
        'API_service\\V1\\Rpc\\SaveUser\\Validator' => array(
            0 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'id',
                'description' => 'Identificador del usuario, si no se pasa como parametro creara un nuevo usuario',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'username',
                'description' => 'username del usuario, tiene que se unico',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'password',
                'description' => 'pasword en MD5',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'mail',
                'description' => 'mail del usuario',
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'nombre',
                'description' => 'Nombre del usuario',
            ),
            5 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'apellidos',
                'description' => 'Apellidos del usuario',
            ),
            6 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(),
                'name' => 'fecha_nacimiento',
                'description' => 'Fecha de nacimiento del usuario, en formato YYYY-mm-dd hh:mm:ss',
            ),
        ),
        'API_service\\V1\\Rpc\\ProfileByUser\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'username',
                'description' => 'username del usuario',
            ),
        ),
        'API_service\\V1\\Rpc\\ServicesByUser\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'username',
                'description' => 'username del usuario',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
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
            'API_service\\V1\\Rpc\\ServicesByUser\\Controller' => array(
                'actions' => array(
                    'ServicesByUser' => array(
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
