<?php 
    // include 'Student.php';
    // $a = new Student('1','okoa','kinsey','okoa@kinsey.com');

    // echo $a->firstName;

    spl_autoload_register(function($name){
        include("$name.php");
        
    });
    $a = new Student('1','okoa','kinsey','okoa@kinsey.com');
    $b = new Database('otkinsey','komet1','mysql:host=localhost;dbname=module_5');
    

    $c = $b->selectAllStudents();
    var_dump($c);
?>