<?php

namespace Emp\Form;

 use Zend\Form\Form;

 class EmpForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('Emp');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'name',
             'type' => 'Text',
         ));
         $this->add(array(
             'name' => 'address',
             'type' => 'Text',
         ));
         $this->add(array(
            'name' => 'email',
            'type' => 'email',
        ));
         $this->add(array(
            'name' => 'phone',
            'type' => 'Text',
        ));
        $this->add(array(
            'name' => 'dob',
            'type' => 'date',
        ));
        $this->add(array(
            'name' => 'image',
            'type' => 'file',
        ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
                 'class' => 'btn btn-success',
             ),
         ));
     }
 }

?>