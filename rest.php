<?php 
require_once('config.php');
$db = new Database('otkinsey','komet1','mysql:host=localhost;dbname=module_5'); 
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
    // echo $doc->save($file) or die('Something went in rest.php createXmlDoc()');
    echo header('Content-type: application/xml');
    echo $doc->saveXML($rootElement);
}

function formatOutput($format, $data){    
    switch($format){
        case('xml'):              
            return  createXmlDoc($data);
            
        case('json'):  
        header('Content-type: application/json');
           return json_encode($data, JSON_PRETTY_PRINT);
    }
}   

function processVars(){
    $vars =  $_GET;
    switch($vars){
        
        // 1. get specific course - course=<course id>
        case ($vars['action'] == 'students' && (($vars['course'] !== null) && is_string($vars['course']))):            
            global $db;  
            $data = $db->selectStudentsFromCourses($vars['course']);             
            if(isset($vars['format'])){
                echo formatOutput($vars['format'], $data);
            }
            else{  echo formatOutput('xml', $data);  } 
            break;

        // 2. get all students - action='student'
        case (($vars['action'] == 'students') && ($vars['course'] == null) && count($vars) <= 2):        
            global $db;
            
            $data = $db->selectAllStudents();                                  
            if(isset($vars['format'])){
                echo formatOutput($vars['format'], $data);
            }
            else{ echo formatOutPut('xml', $data); } 
            break;
        
        // 3. get all courses - action='courses'
        case ($vars['action'] == 'courses' && count($vars) <= 2):            
            global $db;          
            $data = $db->selectAllCourses();                        
            if(isset($vars['format'])){
                echo formatOutput($vars['format'], $data);
            }
            else{ echo formatOutPut('xml', $data); } 
            break;

        default:
            echo '<h3>This is an invalid query</h3>';
            
    }
}
processVars();
?>


