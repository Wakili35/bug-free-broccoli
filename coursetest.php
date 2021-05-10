<?php

require_once('Course.php');

try{
    $course = new Course(123456, "How to win the lottery", "https://www.udemy.com/how-to-win-the-lottery/", 10, 10.2, "2021-07-06T21:46:30Z", 90, 20, 5, "Ralph Puppins", 2, 1, 25 );
    //returning as json
    header('Content-type: application/json;charset=UTF-8');
    echo json_encode($course->returnCourseAsArray());
} catch(CourseException $ex) {
    echo "Error: ".$ex->getMessage();
}