<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Application;          
use Application\Form\ApplicationForm; 

class IndexController extends AbstractActionController
{
    protected $employeeTable;
	 
	 public function indexAction()
     {
		 
         return new ViewModel(array(
             'employees' => $this->getEmployeeTable()->fetchAll(),
         ));
     }

    
     public function addAction()
     {
		 $form = new EmployeeForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $employee = new Employee();
             $form->setInputFilter($employee->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $employee->exchangeArray($form->getData());
                 $this->getEmployeeTable()->saveEmployee($employee);

                 // Redirect to list of employees
                 return $this->redirect()->toRoute('application');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
     {
		 $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('application', array(
                 'action' => 'add'
             ));
         }

         // Get the employee with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $employee = $this->getEmployeeTable()->getEmployee($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('application', array(
                 'action' => 'index'
             ));
         }

         $form  = new EmployeeForm();
         $form->bind($employee);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($employee->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getEmployeeTable()->saveEmployee($employee);

                 // Redirect to list of employees
                 return $this->redirect()->toRoute('application');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
     }

     public function deleteAction()
     {
		 //--
		 $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('application');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getEmployeeTable()->deleteEmployee($id);
             }

             // Redirect to list of Employees
             return $this->redirect()->toRoute('application');
         }

         return array(
             'id'    => $id,
             'employee' => $this->getEmployeeTable()->getEmployee($id)
         );
		 
		 //--
		 
     }
	 
	 public function getEmployeeTable()
     {
         if (!$this->employeeTable) {
             $sm = $this->getServiceLocator();
             $this->employeeTable = $sm->get('Application\Model\ApplicationTable');
         }
         return $this->employeeTable;
     }
}
