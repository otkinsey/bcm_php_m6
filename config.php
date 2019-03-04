<?php 
    require('model/Database.php');
    // require('view/header.php');
    
    // require('controller/controller.php');
    spl_autoload_register(function($class){
        require("model/$name.php");
    });
?>