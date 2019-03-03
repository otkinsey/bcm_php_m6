<?php

//refator PDO object to be a class: containing all db access methods here
class Database{

    protected $username;
    protected $password;
    private $dsn;

    function __construct($username, $password, $dsn){
        $this->username = $username;
        $this->password = $password;
        $this->dsn = $dsn;
    }
    
    // encapsulate db connection in a function
    function connect(){
        try{
            $db = new PDO($this->dsn, $this->username, $this->password);
            
            return $db;
        } catch(PDOException $e){
            $errorMessage = $e->getMessage();
            require('errors/databaseError.php');
        }
    }
    //--------------------------
    //Select methods
    //--------------------------
    function selectAllStudents(){
        $db = $this->connect();
        $query = 'select * from sk_students';
        $dbs = $db->prepare($query);
        $dbs->execute();
        $results = $dbs->fetchAll();
        return $results;
    }

    function selectAllCourses(){
        $db = $this->connect();
        $query = 'select * from sk_courses';
        $dbs = $db->prepare($query);
        $dbs->execute();
        $results = $dbs->fetchAll();
        return $results;
    }

    function selectCourse($id=null){
        // echo "[ DIAGNOSTIC: Database.php - selectCourse ] id: $id | url: $url";
        if($id == null){
            $id = 'cs601';
        }else{ $id = $id; }

        // echo "<br>[ DIAGNOSTIC: Database.php - selectCourse ] id: $id <br>";
        $db = $this->connect();
        $dbs = $db->prepare('select * from sk_courses where courseID = :id');
        $dbs->bindValue(':id', $id, PDO::PARAM_STR);
        $dbs->execute();
        $results = $dbs->fetchAll();
        return $results;
    }

    function selectStudentsFromCourses($courseID='cs601'){
        $db = $this->connect();
        $dbs = $db->prepare('select * from sk_students where courseID = :c');
        $dbs->execute(array(':c'=>$courseID));
        $results = $dbs->fetchAll();
        return $results;
    }

    //--------------------------
    // Add methods
    //--------------------------
    function addStudentToCourse(){
        $db = $this->connect();
        $query = 'insert into sk_students values()';
        $dbs = $db->execute($query);
        $dbs->execute();
        $results = $dbs->fetchObject();
        return $results;
    }

    function addCourse($id, $n){
        $db = $this->connect();
        $dbs = $db->prepare('insert into sk_courses values(:i, :n)');
        $dbs->execute(array(':i'=>$id, ':n'=>$n));
        $results = $dbs->rowCount();
        return $results;
    }

    function addStudent($id, $f, $l, $e){
        $db = $this->connect();
        $dbs = $db->prepare('insert into sk_students values(null, :i, :f, :l, :e)');
        $dbs->execute(array(':i'=>$id, ':f'=>$f, ':l'=>$l, ':e'=>$e));
        $results = $dbs->rowCount();
        return $results;
    }

    //--------------------------
    // Delete methods
    //--------------------------
    function deleteStudentFromCourse($id){
        $db = $this->connect();
        $dbs = $db->prepare('delete from sk_students where studentID = :id');
        $dbs->execute(array(':id'=>$id));
        $results = $dbs->fetchObject();
        return $results;
    }

    function deleteCourse(){

    }
    
}
?>