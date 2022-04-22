<?php


return array(
     'controllers' => array(
         'invokables' => array(
             'Emp\Controller\Emp' => 'Emp\Controller\EmpController',
         ),
     ),
	 
	 // The following section 1 is new and should be added to your file
     'router' => array(
         'routes' => array(
             'Emp' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/Emp[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Emp\Controller\Emp',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
	 // -- End :section 1
	 
     'view_manager' => array(
         'template_path_stack' => array(
             'Emp' => __DIR__ . '/../view',
         ),
     ),
 );



?>