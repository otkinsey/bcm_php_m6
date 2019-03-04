<?php require_once('config.php') ?>
<?php 

    if(isset($_POST[ 'addStudent' ])){
        $id = $_POST['courseID'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
  
        $addStudent = $db->addStudent($id, $firstName, $lastName, $email);
       echo "[ DIAGNOSTIC: add_student.php ] rows added: $addStudent";
    }

    // echo "[ DIAGNOSTIC: index.php ] get: $courseID";
    $courses = $db->selectAllCourses();
    
?>
<section>

<div class='grid-x'>
    <div class="cell small-12 medium-4 large-4">
            <h2>Add Student</h2>
            <form action="add_student.php" method="POST">
                <div class="grid-container">
                    <div class="medium-12 small-12 large-12">
                        <select name="courseID" id="">
                            <?php foreach($courses as $course):?>                              
                                <option  value="<?php echo $course['courseID']; ?>"><?php echo $course['courseName'] ?></option>
                            <?php endforeach; ?>  
                        </select>  
                    </div>
                    <div class="medium-12 small-12 large-12">
                        <label for="courseID">First Name</label>    
                        <input type="text" name="firstName">
                    </div>
                    <div class="medium-12 small-12 large-12">
                        <label for="courseName">Last Name</label>    
                        <input type="text" name="lastName">
                    </div>
                    <div class="medium-12 small-12 large-12">
                        <label for="courseName">Email</label>    
                        <input type="text" name="email">
                        <input type="hidden" name="addStudent" value="true">
                    </div>
                    <button class="button">add student</button>
                </div>
            </form>
        </div>
</div>
<div><a href="index.php">View Student List</a></div>

</section>
<section>
    <h2></h2>
</section>
<?php require('view/footer.php'); ?>