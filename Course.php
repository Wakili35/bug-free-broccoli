<?php

class CourseException extends Exception {}

class Course {

    private $_course_id;
    private $_course_title;
    private $_course_url;
    private $_number_of_lectures;
    private $_content_duration;
    private $_published_timestamp;
    private $_number_of_subscribers;
    private $_number_of_reviews;
    private $_review_rating;
    private $_instructor_name;
    private $_level_id;
    private $_category_id;
    private $_price_id;

    // constructor using magic method
    public function __construct($course_id, $course_title, $course_url, $number_of_lectures, $content_duration, $published_timestamp, $number_of_subscribers, $number_of_reviews, $review_rating, $instructor_name, $level_id, $category_id, $price_id){
    // calling the setter methods
    $this->setCourseID($course_id);
    $this->setCourseTitle($course_title);
    $this->setCourseUrl($course_url);
    $this->setNumberOfLectures($number_of_lectures);
    $this->setContentDuration($content_duration);
    $this->setPublishedTimestamp($published_timestamp);
    $this->setNumberOfSubscribers($number_of_subscribers);
    $this->setNumberOfReviews($number_of_reviews);
    $this->setReviewRating($review_rating);
    $this->setInstructorName($instructor_name);
    $this->setLevelID($level_id);
    $this->setCategoryID($category_id);
    $this->setPriceID($price_id);
    }

    // getters
    public function getCourseID(){
        return $this->_course_id;
    }

    public function getCourseTitle(){
        return $this->_course_title;
    }

    public function getCourseUrl(){
        return $this->_course_url;
    }

    public function getNumberOfLectures(){
        return $this->_number_of_lectures;
    }

    public function getContentDuration(){
        return $this->_content_duration;
    }

    public function getPublishedTimestamp(){
        return $this->_published_timestamp;
    }

    public function getNumberOfSubscribers(){
        return $this->_number_of_subscribers;
    }

    public function getNumberOfReviews(){
        return $this->_number_of_reviews;
    }

    public function getReviewRating(){
        return $this->_review_rating;
    }

    public function getInstructorName(){
        return $this->_instructor_name;
    }

    public function getLevelID(){
        return $this->_level_id;
    }

    public function getCategoryID(){
        return $this->_category_id;
    }

    public function getPriceID(){
        return $this->_price_id;
    }

    // setters
    public function setCourseID($course_id){
        // exception handling for an invalid value
        if (($course_id != null) && (!is_numeric($course_id) || $course_id<=0 || $course_id > 9999999 || $this->_course_id !== null)) {
            throw new CourseException("Course ID error");
        }
        // otherwise set the id
        $this->_course_id = $course_id;
    }

    public function setCourseTitle($course_title){
        // mandatory field exception handling - based on database parameters
        if(strlen($course_title) <0 || strlen($course_title) >247) {
            throw new CourseException("Course title error");
        }
        //otherwise set course title
        $this->_course_title = $course_title;
    }

    public function setCourseUrl($course_url){
       // mandatory field exception handling - based on database parameters
       if(strlen($course_url) <0 || strlen($course_url) >93) {
        throw new CourseException("Course url error");
    }
        //otherwise set course url
        $this->_course_url = $course_url;
    }

    public function setNumberOfLectures($number_of_lectures){
        // mandatory field exception handling - based on database parameters
        if(intval($number_of_lectures) <0 || intval($number_of_lectures) >999) {
            throw new CourseException("Invalid number of lectures");
        }
            //otherwise set number of lectures
            $this->_number_of_lectures = $number_of_lectures;
        }

    public function setContentDuration($content_duration){
        // mandatory field exception handling - based on database parameters
        if(floatval($content_duration) <0 || floatval($content_duration) >999.9) {
            throw new CourseException("Invalid content duration");
        }
            //otherwise set content duration
            $this->_content_duration = $content_duration;
        }

    public function setPublishedTimestamp($published_timestamp){
        // mandatory field exception handling - based on database parameters
       if(strlen($published_timestamp) <0 || strlen($published_timestamp) >20) {
        throw new CourseException("Invalid timestamp");
    }
        //otherwise set timestamp
        $this->_published_timestamp = $published_timestamp;
    }

    public function setNumberOfSubscribers($number_of_subscribers){
         // mandatory field exception handling - based on database parameters
         if(intval($number_of_subscribers) <0 || intval($number_of_subscribers) >999999) {
            throw new CourseException("Invalid number of subscribers");
        }
            //otherwise set number of subscribers
            $this->_number_of_subscribers = $number_of_subscribers;
    }

    public function setNumberOfReviews($number_of_reviews){
         // mandatory field exception handling - based on database parameters
         if(intval($number_of_reviews) <0 || intval($number_of_reviews) >99999) {
            throw new CourseException("Invalid number of reviews");
        }
            //otherwise set number of reviews
            $this->_number_of_reviews = $number_of_reviews;
    }

    public function setReviewRating($review_rating){
        // mandatory field exception handling - based on database parameters
        if(intval($review_rating) <0 || intval($review_rating) >5) {
            throw new CourseException("Invalid review rating");
        }
            //otherwise set review rating
            $this->_review_rating = $review_rating;
    }

    public function setInstructorName($instructor_name){
        // mandatory field exception handling - based on database parameters
        if(strlen($instructor_name) <0 || strlen($instructor_name) >25) {
            throw new CourseException("Invalid instructor name");
        }
            //otherwise set instructor name
            $this->_instructor_name = $instructor_name;
        }

    public function setLevelID($level_id){
         // mandatory field exception handling - based on database parameters
         if(intval($level_id) <0 || intval($level_id) >4) {
            throw new CourseException("Invalid level ID");
        }
            //otherwise setlevel ID
            $this->_level_id = $level_id;
    }

    public function setCategoryID($category_id){
       // mandatory field exception handling - based on database parameters
       if(intval($category_id) <0 || intval($category_id) >4) {
        throw new CourseException("Invalid category ID");
    }
        //otherwise set category ID
        $this->_category_id = $category_id;
}

    public function setPriceID($price_id){
     // mandatory field exception handling - based on database parameters
     if(intval($price_id) <0 || intval($price_id) >25) {
        throw new CourseException("Invalid price ID");
    }
        //otherwise set price ID
        $this->_price_id = $price_id;
}

    // convert to array to format into json
    public function returnCourseAsArray(){
        $course = array();
        $course['course_id'] = $this->getCourseID();
        $course['course_title'] = $this->getCourseTitle();
        $course['course_url'] = $this->getCourseUrl();
        $course['number_of_lectures'] = $this->getNumberOfLectures();
        $course['content_duration'] = $this->getContentDuration();
        $course['published_timestamp'] = $this->getPublishedTimestamp();
        $course['number_of_subscribers'] = $this->getNumberOfSubscribers();
        $course['number_of_reviews'] = $this->getNumberOfReviews();
        $course['review_rating'] = $this->getReviewRating();
        $course['instructor_name'] = $this->getInstructorName();
        $course['level_id'] = $this->getLevelID();
        $course['category_id'] = $this->getCategoryID();
        $course['price_id'] = $this->getPriceID();
        return $course;
    }
}



