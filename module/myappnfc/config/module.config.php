<?php
return array(
    'controllers' => array(
        'factories' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => 'myappnfc\\V1\\Rpc\\Infousertoid\\InfousertoidControllerFactory',
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
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'myappnfc.rpc.infousertoid',
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
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'myappnfc\\V1\\Rpc\\Infousertoid\\Controller' => array(
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
        ),
    ),
);
