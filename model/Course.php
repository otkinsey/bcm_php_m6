<?php 

class Course{
    public $id;
    public $name;

    function __constuct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
} 
?>