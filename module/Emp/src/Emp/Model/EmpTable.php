<?php

namespace Emp\Model;

 use Zend\Db\TableGateway\TableGateway;

 class EmpTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getEmp($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveEmp(Emp $Emp)
     {
         $data = array(
             'name' => $Emp->name,
             'address'  => $Emp->address,
             'email'  => $Emp->email,
             'phone'  => $Emp->phone,
             'dob'  => $Emp->dob,
         );
         if(isset($_FILES['image'])) {
            $data['image'] = $_FILES['image']['name'];
            $filepath = getcwd().'/public/uploads/'.$data['image'];
            $directory = getcwd().'/public/uploads/';
            if(! is_dir($directory)) {
                if(mkdir($directory)) {
                    $content = file_get_contents($data['tmp_name']);
                    file_put_contents($filepath , $content);
                }
            }else{
                if(file_exists($filepath.$data['image'])){
                    unlink($filepath);
                    $content = file_get_contents($data['tmp_name']);
                    file_put_contents($filepath , $content);
                }
            }
         }

         $id = (int) $Emp->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getEmp($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Emp id does not exist');
             }
         }
     }

     public function deleteEmp($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }

?>