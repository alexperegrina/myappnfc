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
//        'invokables' => array(
//            'Comercializador\Controller\Comercializador' => 'Comercializador\Controller\ComercializadorController',
//            'Comercializador\Controller\List' => 'Comercializador\Controller\ListController',
//        ),
        'factories' => array(
            'Comercializador\Controller\List' => 'Comercializador\Factory\ListControllerFactory',
            'Comercializador\Controller\Write' => 'Comercializador\Factory\WriteControllerFactory',
            'Comercializador\Controller\Delete' => 'Comercializador\Factory\DeleteControllerFactory'
        )
    ),

    'service_manager' => array(
        'factories' => array(
            'Comercializador\Mapper\ComercializadorMapperInterface'   
                    => 'Comercializador\Factory\ZendDbSqlMapperFactory',
            'Comercializador\Service\ComercializadorServiceInterface' 
                    => 'Comercializador\Factory\ComercializadorServiceFactory',
            'Zend\Db\Adapter\Adapter'           => 'Zend\Db\Adapter\AdapterServiceFactory'
        )
    ),

    'router' => array(
// Uncomment below to add routes
        'routes' => array(
            'comercializador' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/comercializador',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Comercializador\Controller',
                        'controller' => 'List',
                        'action' => 'index',
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            )
                        )
                    ),
                    'add' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route'    => '/add',
                            'defaults' => array(
                                'controller' => 'Comercializador\Controller\Write',
                                'action'     => 'add'
                            )
                        )
                    ),
                    'edit' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/edit/:id',
                            'defaults' => array(
                                'controller' => 'Comercializador\Controller\Write',
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
                                'controller' => 'Comercializador\Controller\Delete',
                                'action'     => 'delete'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                )
            )
        ),

    )
);