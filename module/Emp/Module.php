<?php

namespace Emp;

 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;
 
 
 // Add these import statements:
 use Emp\Model\Emp;
 use Emp\Model\EmpTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;

 class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
	 
	  // Add this method:
     public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Emp\Model\EmpTable' =>  function($sm) {
                     $tableGateway = $sm->get('EmpTableGateway');
                     $table = new EmpTable($tableGateway);
                     return $table;
                 },
                 'EmpTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Emp());
                     return new TableGateway('emp', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
	 
	 
	//-- *** Class end 
 }
 
 
 ?>