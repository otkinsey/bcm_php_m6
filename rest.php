<?php 
require_once('config.php');
$vars =  $_GET;

function createXmlDoc($dataArray){ 
    
    // process $_GET array 
    if(key($dataArray[0])=='studentID'){
        $file = 'students.xml';
        $node = 'student';
    }
    else{
        $file = 'courses.xml';
        $node = 'course';
    }
    
    $rootString = $node.'s'; 
    $addRootElement = fopen($file, 'w'); fwrite($addRootElement, "<$rootString></$rootString>"); fclose($addRootElement);
    $doc = new DOMDocument('1.0'); $doc->preserveWhiteSpace = false; $doc->load($file);
    $rootElement = $doc->documentElement;
    $doc->formatOutput = true;
 
    foreach($dataArray as $item) {
        
        // add nested loop to provess values that are arrays
        if(is_array($item)){
            foreach($item as $itemKey=>$itemValue){

                // test to confirm $itemKey is a string
                if(is_string($itemKey)){
                    $i = $doc->createElement($itemKey, $itemValue);
                    $rootElement->appendChild($i);
                }
                else{
                    continue;
                }
            }
        } else{
            $i = $doc->createElement($dataKey, $dataValue);
            $rootElement->appendChild($i);
        }
    }
    $doc->save($file) or die('Something went in rest.php createXmlDoc()');
}

function formatOutput($format, $data){    
    switch($format){
        case('xml'):              
            return  createXmlDoc($data);
            
        case('json'):        
           return json_encode($data);
    }
}   

function processVars(){
    $vars =  $_GET;
    switch($vars){
        
        // 1. get specific course - course=<course id>
        case ($vars['action'] == 'students' && $vars['course'] !== null):
            global $db;           
            $data = $db->selectStudentsFromCourses($vars['course']); 
            print '[DIAG: rest.php - processVars] TEST';
            if(isset($vars['format'])){
                // print '[DIAG: rest.php - processVars] format: '.$vars['format'];
                echo formatOutput($vars['format'], $data);
            }
            else{  echo formatOutput('xml', $data);  } 
            break;

        // 2. get all students - action='student'
        case ($vars['action'] == 'students') :
            global $db;
            $data = $db->selectAllStudents();                                  
            if(isset($vars['format'])){
                echo formatOutput($vars['format'], $data);
            }
            else{ echo formatOutPut('xml', $data); } 
            break;
        
        // 3. get all courses - action='courses'
        case ($vars['action'] == 'courses'):
            global $db;          
            $data = $db->selectAllCourses();                        
            if(isset($vars['format'])){
                echo formatOutput($vars['format'], $data);
            }
            else{ echo formatOutPut('xml', $data); } 
            break;

        default:
            echo '<h2>This is an invalid query.</h2>';
            break;
    }

}
processVars();
?>


</div>
<hr>
<footer>
    <p class="copyright">
        &copy; <?php echo date("Y"); ?> Course Manager
    </p>
</footer>
<?php if(isset($vars['action'])): ?>
<script src="module-6_ajax.js"></script>
<?php endif; ?>
</div>
</body>
</html>