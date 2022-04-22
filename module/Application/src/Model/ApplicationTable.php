<?php

namespace Employee\Model;

 use Zend\Db\TableGateway\TableGateway;

 class EmployeeTable
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

     public function getEmployee($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

    public function saveEmployee(Employee $employee)
    {
        $data = array(
            'name' => $employee->name,
            'address' => $employee->address,
            'phone' => $employee->phone,
            'dob' => $employee->dob,
        );

        $id = (int) $employee->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getEmployee($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Employee id does not exist');
            }
        }
    }

     public function deleteEmployee($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }

     public function getEmployeeByEmail($email)
     {
        $rowset = $this->tableGateway->select(array('email' => $email));
        $row = $rowset->current();
        if ($row) {
            throw new \Exception("Email id already exists");
        }else{
            return true;
        }
     }
 }

?>