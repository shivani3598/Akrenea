<?php

namespace Emp\Model;

// Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;


 class Emp implements InputFilterAwareInterface
 {
     public $id;
     public $name;
     public $address;
     public $email;
     public $phone;
     public $dob;
     public $image;
	 protected $inputFilter;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->name = (!empty($data['name'])) ? $data['name'] : null;
         $this->address = (!empty($data['address'])) ? $data['address'] : null;
         $this->email = (!empty($data['email'])) ? $data['email'] : null;
         $this->phone = (!empty($data['phone'])) ? $data['phone'] : null;
         $this->dob  = (!empty($data['dob'])) ? $data['dob'] : null;
         $this->image  = (!empty($data['image'])) ? getcwd().'/public/uploads/'.$data['image'] : null;
     }
	 
	 // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'name',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                'name'     => 'address',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 500,
                        ),
                    ),
                ),
            ));

             $inputFilter->add(array(
                'name'     => 'email',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 10,
                            'max'      => 50,
                        ),
                    ),
                ),
            ));

             

             $inputFilter->add(array(
                'name'     => 'phone',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'Digits',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 10,
                            'max'      => 10,
                        ),
                    ),
                ),
            ));

            $date = date('Y-m-d');

            $inputFilter->add(array(
                'name'     => 'dob',
                'required' => true,
                'validators' => array(
                    array(
                        'name'    => 'Date',
                        'options' => array(
                            'max'      => $date,
                        ),
                    ),
                ),
            ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
	 
	  public function getArrayCopy()
     {
         return get_object_vars($this);
     }
	 
	 
	 //-- end class
 }

?>