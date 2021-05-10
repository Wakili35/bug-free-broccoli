<?php

    // display php error
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


// calling in files
require_once('database.php');
require_once('../model/Course.php');
require_once('../model/Response.php');

// connecting to the db
try{
    $writeDatabase = Database::connectWriteDatabase();
    $readDatabase = Database::connectReadDatabase();   
} 
catch (PDOException $ex) {
    $response = new Response();
    $response->setHttpCode(500);
    $response->setSuccess("false");
    $response->addMessage("Not connected to database");
    $response->send();
    exit();     
}
// checking to see if the course ID exists
if(array_key_exists("courseid", $_GET)) {
    
    $courseid = $_GET['courseid'];

    if($courseid == '' || !is_numeric($courseid)) {
        $response = new Response();
        $response->setHttpCode(400);
        $response->setSuccess(false);
        $response->addMessage("Course ID cannot be left blank or must be a number");
        $response->send();
        exit;
    }

if($_SERVER['REQUEST_METHOD'] === 'GET'){
     // querying the database using the read database to reduce the load
     try {
        // try to retrieve course
        $query = $readDatabase->prepare('select course_id, course_title, course_url, number_of_lectures, content_duration, published_timestamp, number_of_subscribers, number_of_reviews, review_rating, instructor_name, level_id, category_id, price_id, from course where course_id = :courseid');
        $query->bindParam(':courseid', $course_id, PDO::PARAM_INT);
        $query->execute();
        
        // try to return the row 
        //if the course with that id doesn't exist then send the 404 error back
        $rowCount = $query->rowCount();

        if($rowCount === 0){
            $response = new Response();
            $response-> setHttpCode(404);
            $response->setSuccess(false);
            $response->addMessage("Course not found");
            $response->send();
            exit;
        }

        // if the row exists, retrieve using a while loop and fetch associative array
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            // create a course
            $course = new Course($row['course_id'], $row['course_title'], $row['course_url'], $row['number_of_lectures'], $row['content_duration'], $row['published_timestamp'], $row['number_of_subscribers'], $row['number_of_reviews'], $row['review_rating'], $row['instructor_name'], $row['level_id'], $row['category_id'], $row['price_id']);    
            // add returned course to an array
            $courseArray[] = $course->returnCourseAsArray();
        }
    
        $returnData = array();
        $returnData['rows_returned'] = $rowCount;
        $returnData['courses'] = $courseArray;

        // return a successful response to the client
        $response = new Response();
        $response->setHttpCode(200);
        $response->setSuccess(true);
        // caching the response
        $response->toCache(true);
        // returning response data - rows and courses
        $response->setData($returnData);
        $response->send();
        exit;
    } 
    catch(CourseException $ex) {
        $response = new Response();
        $response->setHttpCode(500);
        $response->setSuccess(false);
        // returning the standard error message
        $response->addMessage($ex->getMessage());
        $response->send();
        exit;
    }
    catch (PDOException $ex) {
        $response = new Response();
        $response->sethttpCode(500);
        $response->setSuccess("false");
        $response->addMessage("Failed to get course");
        $response->send();
        exit();
    }

}

elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    
}
elseif($_SERVER['REQUEST_METHOD'] === 'PATCH'){
    
} else {
    $response = new Response();
    $response->setHttpCode(405);
    $response->setSuccess(false);
    $response->addMessage("Method not allowed");
    $response->send();
    exit;
}
}
?>