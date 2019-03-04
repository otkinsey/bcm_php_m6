<?php require_once('config.php') ?>
<?php 

if(isset($_POST[ 'addCourse' ])){
    $id = $_POST['courseID'];
    $courseName = $_POST['courseName'];

    $addCourse = $db->addCourse($id, $courseName);
   echo "[ DIAGNOSTIC: add_student.php ] rows added: $addCourse";
}
    
    // echo "[ DIAGNOSTIC: index.php ] get: $courseID";
    $courses = $db->selectAllCourses();

?>
<section>

<div class="grid-x">
        <div class="cell small-12 medium-8 large-8">
                <h3>Course List</h3>
                <table>
                        <thead>
                                <tr>
                                        <th>ID</th>
                                        <th>Course Name</th>                          
                                </tr>
                        </thead>
                    <?php foreach($courses as $course): ?>
                            <tr>
                                <td><?php echo $course['courseID']; ?></td>
                                <td><?php echo $course['courseName']; ?></td>     
                            </tr>
                    <?php endforeach; ?>
                </table>                       
        </div>
</div>
<div class='grid-x'>
    <div class="cell small-12 medium-4 large-4">
            <h3>Add Courses</h3>
            <form action="course_list.php" method="POST">
                <div class="grid-container">
                    <div class="medium-12 small-12 large-12">
                        <label for="courseID">Course ID</label>    
                        <input type="text" name="courseID">
                    </div>
                    <div class="medium-12 small-12 large-12">
                        <label for="courseName">Course Name</label>    
                        <input type="text" name="courseName">
                        <input type="hidden" name="addCourse" value="addCourse">
                    </div>
                    <button class="button">send</button>
                </div>
            </form>
        </div>
</div>
<div><a href="index.php">List Students</a></div>

</section>
<section>
    <h2></h2>
</section>
<?php require('view/footer.php'); ?>