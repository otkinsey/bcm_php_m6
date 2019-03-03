<?php require_once('config.php') ?>
<?php 
if(!isset($_GET[ 'courseID' ])){
    $courseID = 'cs601';

}
  
if (isset($_GET[ 'courseID' ])){
    $courseID = $_GET['courseID'];
    // echo "[ DIAGNOSTIC: index.php ] courseID: $courseID";
}

if (isset($_GET[ 'deleteID' ])){
    $deleteID = $_GET[ 'deleteID' ];
    $db->deleteStudentFromCourse($deleteID);
    // echo "[ DIAGNOSTIC: index.php ] deleteID: $deleteID";
}    
    // echo "[ DIAGNOSTIC: index.php ] get: $courseID";
    $courses = $db->selectAllCourses($courseID);
    $course = $db->selectCourse($courseID);
    $students = $db->selectStudentsFromCourses($courseID); 
?>
<section>
<h1>Student List</h1>
<div class="grid-x">
        <div class="cell small-12 medium-3 large-3">
                <ul>
                        <h3>Courses</h3>
                        <?php  foreach( $courses as $i ): ?>
                                <li>
                                    <a href="index.php?courseID=<?php echo $i['courseID']; ?>"><?php echo $i['courseName']; ?></a>    
                                </li>
                        <?php endforeach; ?>
                </ul>
        </div>
        <div class="cell small-12 medium-8 large-8">
                <h3><?php echo $course->courseName; ?></h3>
                <table>
                        <thead>
                                <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                </tr>
                        </thead>
                    <?php foreach($students as $student): ?>
                            <tr>
                                <td><?php echo $student['firstName']; ?></td>
                                <td><?php echo $student['lastName']; ?></td>
                                <td><?php echo $student['email']; ?></td>
                                <td>
                                    <a href='index.php?deleteID=<?php echo $student['studentID']; ?>' class='button'>delete</a>

                                </td>
                            </tr>
                    <?php endforeach; ?>
                </table>
                <div><a href="add_student.php">Add Student</a></div>
                <div><a href="course_list.php">List Courses</a></div>
        </div>
</div>


</section>
<section>
    <h2></h2>
</section>
<?php require('view/footer.php'); ?>