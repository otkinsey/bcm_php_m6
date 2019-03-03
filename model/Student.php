<?php 

class Student{

    public $id;
    public $fistName;
    public $lastName;
    public $email;

    function __construct($id, $firstName, $lastName, $email){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }
}
?>