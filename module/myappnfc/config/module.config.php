<?php
return array(
    'controllers' => array(
        'factories' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => 'myappnfc\\V1\\Rpc\\Infousertoid\\InfousertoidControllerFactory',
            'myappnfc\\V1\\Rpc\\Login\\Controller' => 'myappnfc\\V1\\Rpc\\Login\\LoginControllerFactory',
            'myappnfc\\V1\\Rpc\\ServicesByUser\\Controller' => 'myappnfc\\V1\\Rpc\\ServicesByUser\\ServicesByUserControllerFactory',
            'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => 'myappnfc\\V1\\Rpc\\ProfileByUser\\ProfileByUserControllerFactory',
            'myappnfc\\V1\\Rpc\\SaveUser\\Controller' => 'myappnfc\\V1\\Rpc\\SaveUser\\SaveUserControllerFactory',
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
            'myappnfc.rpc.save-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/saveuser',
                    'defaults' => array(
                        'controller' => 'myappnfc\\V1\\Rpc\\SaveUser\\Controller',
                        'action' => 'saveUser',
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
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'myappnfc.rpc.infousertoid',
            1 => 'myappnfc.rpc.login',
            3 => 'myappnfc.rpc.profile-by-user',
            5 => 'myappnfc.rpc.save-user',
            7 => 'myappnfc.rpc.services-by-user',
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
        'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => array(
            'service_name' => 'ProfileByUser',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'myappnfc.rpc.profile-by-user',
        ),
        'myappnfc\\V1\\Rpc\\SaveUser\\Controller' => array(
            'service_name' => 'SaveUser',
            'http_methods' => array(
                0 => 'POST',
                1 => 'PUT',
            ),
            'route_name' => 'myappnfc.rpc.save-user',
        ),
        'myappnfc\\V1\\Rpc\\ServicesByUser\\Controller' => array(
            'service_name' => 'ServicesByUser',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'myappnfc.rpc.services-by-user',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => 'Json',
            'myappnfc\\V1\\Rpc\\Login\\Controller' => 'Json',
            'myappnfc\\V1\\Rpc\\ServicesByUser\\Controller' => 'Json',
            'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => 'Json',
            'myappnfc\\V1\\Rpc\\SaveUser\\Controller' => 'Json',
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
                3 => 'application/vnd.myappnfc.v1+json',
                4 => 'application/json',
                5 => 'application/*+json',
            ),
            'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => array(
                0 => 'application/vnd.myappnfc.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'myappnfc\\V1\\Rpc\\SaveUser\\Controller' => array(
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
                2 => 'application/vnd.myappnfc.v1+json',
                3 => 'application/json',
            ),
            'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => array(
                0 => 'application/vnd.myappnfc.v1+json',
                1 => 'application/json',
            ),
            'myappnfc\\V1\\Rpc\\SaveUser\\Controller' => array(
                0 => 'application/vnd.myappnfc.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'myappnfc\\V1\\Rpc\\Login\\Controller' => array(
            'input_filter' => 'myappnfc\\V1\\Rpc\\Login\\Validator',
        ),
        'myappnfc\\V1\\Rpc\\SaveUser\\Controller' => array(
            'input_filter' => 'myappnfc\\V1\\Rpc\\SaveUser\\Validator',
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
        'myappnfc\\V1\\Rpc\\SaveUser\\Validator' => array(
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
            'myappnfc\\V1\\Rpc\\SaveUser\\Controller' => array(
                'actions' => array(
                    'SaveUser' => array(
                        'GET' => false,
                        'POST' => true,
                        'PUT' => true,
                        'PATCH' => false,
                        'DELETE' => false,
                    ),
                ),
            ),
        ),
    ),
);
