<?php

/**
 * Core Framework - DevEndpoint
 *
 * @license    MIT (https://mit-license.org/)
 * @author     Louis Ouellet <louis@laswitchtech.com>
 */

// Import additionnal class into the global namespace
use \LaswitchTech\Core\Abstracts\Endpoint;

class DevEndpoint extends Endpoint {

    /**
     * Constructor
     */
    public function __construct()
    {

        // Call Parent Constructor
        parent::__construct();

        // Retrieve the namespace
        $namespace = $this->Request->getNamespace();

        // Set Global access
        $this->Public = true;

        // Set Properties
        switch($namespace){
            case "/dev/status":
                $this->Level = 1;
                break;
            case "/dev/on":
            case "/dev/off":
                $this->Public = false;
                $this->Level = 1;
                break;
        }
    }

    /**
     * Enable development mode
     */
    public function onAction()
    {
        // Set the default message
        $message = ["status" => 200, "message" => "OK", "data" => []];

        // Check if the status is still OK
        if($message['status'] == 200){

            // Check the request method
            if($this->Request->getMethod() == "GET"){

                // Set development mode
                $this->Config->set('application', 'development', true);

                // Set the message data
                $message["data"]["status"] = $this->Config->get('application', 'development');

                // Set the message
                if($message["data"]["status"]){
                    $message["data"]["message"] = "Development mode is now on";
                } else {

                    // Set an error message
                    $message = ["status" => 500, "message" => "Internal Server Error", "data" => "Unable to set development mode"];
                }
            } else {

                // Set an error message
                $message = ["status" => 405, "message" => "Method Not Allowed", "data" => "Invalid Request"];
            }
        }

        // Return the message
        return $message;
    }

    /**
     * Disable development mode
     */
    public function offAction()
    {
        // Set the default message
        $message = ["status" => 200, "message" => "OK", "data" => []];

        // Check if the status is still OK
        if($message['status'] == 200){

            // Check the request method
            if($this->Request->getMethod() == "GET"){

                // Set development mode
                $this->Config->set('application', 'development', false);

                // Set the message data
                $message["data"]["status"] = $this->Config->get('application', 'development');

                // Set the message
                if(!$message["data"]["status"]){
                    $message["data"]["message"] = "Development mode is now off";
                } else {

                    // Set an error message
                    $message = ["status" => 500, "message" => "Internal Server Error", "data" => "Unable to set development mode"];
                }
            } else {

                // Set an error message
                $message = ["status" => 405, "message" => "Method Not Allowed", "data" => "Invalid Request"];
            }
        }

        // Return the message
        return $message;
    }

    /**
     * Check development mode
     */
    public function statusAction()
    {
        // Set the default message
        $message = ["status" => 200, "message" => "OK", "data" => []];

        // Check if the status is still OK
        if($message['status'] == 200){

            // Check the request method
            if($this->Request->getMethod() == "GET"){

                // Set the message data
                $message["data"]["status"] = $this->Config->get('application', 'development');
                $message["data"]["refresh"] = !$this->Auth->isAuthorized('Administrator', 1);

                // Set the message
                if($message["data"]["status"]){
                    $message["data"]["message"] = "Development mode is now on";
                } else {
                    $message["data"]["message"] = "Development mode is now off";
                }
            } else {

                // Set an error message
                $message = ["status" => 405, "message" => "Method Not Allowed", "data" => "Invalid Request"];
            }
        }

        // Return the message
        return $message;
    }
}
