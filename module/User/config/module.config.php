<?php

/**
 * Generated by ZF2ModuleCreator
 */

return array(

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'controllers' => array(
        'factories' => array(
            'User\Controller\List'      => 'User\Factory\ListControllerFactory',
            'User\Controller\Write'     => 'User\Factory\WriteControllerFactory',
            'User\Controller\Delete'    => 'User\Factory\DeleteControllerFactory',
            'User\Controller\Profile'   => 'User\Factory\ProfileControllerFactory',
        )
    ),

    'service_manager' => array(
        'factories' => array(
            'User\Mapper\UserMapperInterface'   => 'User\Factory\ZendDbSqlMapperFactory',
            'User\Service\UserServiceInterface' => 'User\Factory\UserServiceFactory',
            'Zend\Db\Adapter\Adapter'           => 'Zend\Db\Adapter\AdapterServiceFactory'
        )
    ),

    'router' => array(
// Uncomment below to add routes
        'routes' => array(
            'user' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'List',
                        'action' => 'index',
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
//                    'default' => array(
//                        'type' => 'Segment',
//                        'options' => array(
//                            'route' => '/[:controller[/:action]]',
//                            'constraints' => array(
//                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                            )
//                        )
//                    ),
                    'add' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'controller' => 'User\Controller\Write',
                                'action'     => 'add'
                            )
                        )
                    ),
                    'edit' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/edit/:id',
                            'defaults' => array(
                                'controller' => 'User\Controller\Write',
                                'action'     => 'edit'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                    'delete' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/delete/:id',
                            'defaults' => array(
                                'controller' => 'User\Controller\Delete',
                                'action'     => 'delete'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                    'profile' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/profile/:id',
                            'defaults' => array(
                                'controller' => 'User\Controller\Profile',
                                'action'     => 'profile'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        ),
                    ),
                    'login' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/login',
                            'defaults' => array(
                                'controller' => 'User\Controller\Profile',
                                'action'     => 'login'
                            )
                        )
                    )
                ),
            )
        )
    )
);
