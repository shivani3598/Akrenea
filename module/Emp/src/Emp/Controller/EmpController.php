<?php

namespace Emp\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Emp\Model\Emp;          
 use Emp\Form\EmpForm;      

 class EmpController extends AbstractActionController
 {
	 protected $EmpTable;
	 
	 public function indexAction()
     {
		 
         return new ViewModel(array(
             'Emps' => $this->getEmpTable()->fetchAll(),
         ));
     }

    
     public function addAction()
     {
		 $form = new EmpForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $Emp = new Emp();
             $form->setInputFilter($Emp->getInputFilter());
            
             $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $form->setData($post);
             if ($form->isValid()) {
                 $Emp->exchangeArray($post);
                 $this->getEmpTable()->saveEmp($Emp);
                 // Redirect to list of Emps
                 return $this->redirect()->toRoute('Emp');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
     {
		 $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('Emp', array(
                 'action' => 'add'
             ));
         }

         // Get the Emp with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $Emp = $this->getEmpTable()->getEmp($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('Emp', array(
                 'action' => 'index'
             ));
         }

         $form  = new EmpForm();
         $form->bind($Emp);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($Emp->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getEmpTable()->saveEmp($Emp);

                 // Redirect to list of Emps
                 return $this->redirect()->toRoute('Emp');
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
             return $this->redirect()->toRoute('Emp');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getEmpTable()->deleteEmp($id);
             }

             // Redirect to list of Emps
             return $this->redirect()->toRoute('Emp');
         }

         return array(
             'id'    => $id,
             'Emp' => $this->getEmpTable()->getEmp($id)
         );
		 
		 //--
		 
     }
	 
	 public function getEmpTable()
     {
         if (!$this->EmpTable) {
             $sm = $this->getServiceLocator();
             $this->EmpTable = $sm->get('Emp\Model\EmpTable');
         }
         return $this->EmpTable;
     }

     public function paginationresultsAction()
     {
        $db = Zend_Registry::get('db');
         @$searchName = trim($this->getRequest()->getPost('searchName'),'"');
         @$offSet = trim($this->getRequest()->getPost('offSet'));
         @$limit = trim($this->getRequest()->getPost('limit'));

         $offSet = (($offSet - 1) * 20);
         if ($offSet < 0) {
             $offSet = 0;
         }else if($searchName != '' && $offSet > 1){
             $offSet = 0;
         }
         $sqlQuery = "SELECT * FROM emp";
         if (isset($searchName) && $searchName != '') {
             $sqlQuery .= " AND name LIKE '%" . $searchName . "%'";
         }
         $sqlQuery .= " ORDER BY id DESC, name ASC";
         $sqlQuery .= " LIMIT " . $limit . " OFFSET " . $offSet;
         $reportResultData = $db->fetchAll($sqlQuery);
 
         $sqlQuery1 = "SELECT COUNT(id) as total FROM emp";
         if (isset($searchName) && $searchName != '') {
             $sqlQuery1 .= " AND name LIKE '%" . $searchName . "%'";
         }
         $totalCount = $db->fetchAll($sqlQuery1);
         
         $paginationResults = ""; 
         
         if(count($reportResultData) > 0) {
             $j = 1;
             foreach ($reportResultData as $rowValue) {
                 //Row Start
                 $paginationResults .= "<tr>";
                 $paginationResults .= "<td>" . $rowValue['name'] . "</td>";
                 $paginationResults .= "<td>" . $rowValue['address'] . "</td>";
                 $paginationResults .= "<td>" . $rowValue['email'] . "</td>";
                 $paginationResults .= "<td>" . $rowValue['phone'] . "</td>";
                 $paginationResults .= "<td>" . $rowValue['dob'] . "</td>";
                 $paginationResults .= "<td>" . $rowValue['image'] . "</td>";
                 
                 $paginationResults .= '</tr>';
 
                 $j++;
             }
         } else {
             $paginationResults .= '<tr><td colspan="8" style="text-align: center;">Sorry, no records have been added.</td></tr>';
         } 
         
         $ar = array("totalcount" => $totalCount[0]['total'],"count" => count($reportResultData),"paginationResults" => $paginationResults);
         echo json_encode($ar);
 
         //To resolve the ajax page rendering problem.
         $this->_helper->layout()->disableLayout();
         $this->_helper->viewRenderer->setNoRender();
     }
	 
	 
	 
	 
	 //--Class end
 }



?>
