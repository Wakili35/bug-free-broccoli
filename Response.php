<?php

    class Response {

        // variables to return response details
        private $_success;
        private $_httpCode;

        // array as more than one message can be held
        private $_messages = array();

        // stores the data to be returned
        private $_data;

        // internal process variables
        // return cached response from client to reduce load on server - set to false to use only where appropriate
        private $_toCache =  false;
        // php convert array to JSON response 
        private $_responseData = array();


        // setters for success
        public function setSuccess($success){
            $this->_success = $success;
        }

        // setters for http status code
        public function setHttpCode($httpCode){
            $this->_httpCode = $httpCode;
        }

        // adding to the array of messages
        public function addMessage($message) {
            $this->_messages[] = $message;
        }

        // setter for data
        public function setData($data) {
            $this->_data = $data;
        }

        public function toCache($toCache) {
            $this->_toCache = $toCache;
        }

        // sends response back to client
        public function send() {

            // telling the client the type of data to be returned
            header('Content-type: application/json;charset-utf-8');

            // see if client can cache the response 
            if ($this->_toCache == true) {
                // telling the client it can cache the response for a maximum of 60 seconds
                header('Cache-control: max-age=60');
            } else {
                // tell client it can't cache the response -  has to go back to the server
                header('Cache-control: no-cache, no-store');
            }
            // if not true or false, return error message back to the client OR if it's not numeric then provide a standard response
            if(($this->_success !== false && $this->_success !== true) || !is_numeric($this->_httpCode)) {
                http_response_code(500);
                // error response code returned
                $this->_responseData['statusCode'] = 500;
                // failed success code returned
                $this->_responseData['success'] = false;
                // message created and assigned to json response
                $this->addMessage("Response error");
                $this->_responseData['messages'] = $this->_messages;

            } else {
                
                // successful response
                http_response_code($this->_httpCode);
                // send code in json response
                $this->_responseData['statusCode'] = $this->_httpCode;
                $this->_responseData['success'] = $this->_success;
                $this->_responseData['messages'] = $this->_messages;
                $this->_responseData['data'] = $this->_data;
            }

            echo json_encode($this->_responseData);
        }
    }

