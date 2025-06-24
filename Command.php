<?php

/**
 * Core Framework - DevCommand
 *
 * @license    MIT (https://mit-license.org/)
 * @author     Louis Ouellet <louis@laswitchtech.com>
 */

// Import additionnal class into the global namespace
use LaswitchTech\Core\Abstracts\Command;

class DevCommand extends Command {

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Enable development mode
     */
    public function onAction()
    {
        // Set development mode
        $this->Config->set('application', 'development', true);

        // Output the status
        $this->statusAction();
    }

    /**
     * Disable development mode
     */
    public function offAction()
    {
        // Set development mode
        $this->Config->set('application', 'development', false);

        // Output the status
        $this->statusAction();
    }

    /**
     * Check development mode
     */
    public function statusAction()
    {
        // Output the stored value
        if($this->Config->get('application', 'development') == true){
            $this->Output->print("Maintenance mode is on");
        } else {
            $this->Output->print("Maintenance mode is off");
        }
    }

    /**
     * Retrieve the CRON schedule
     */
    public function schedule(): string
    {
        return '*/5 * * * *';
    }

    /**
     * CRON Command
     */
    public function cron()
    {
        $this->Output->print("Executing Dev CRON Command");
    }

    /**
     * ucwords
     */
    public function ucwordsAction()
    {
        // Import Global Variables
        global $argv;

        if(isset($argv[3])){
            $table = $argv[3];

            if(isset($argv[4])){
                $column = $argv[4];

                foreach($this->Model->Dev->ucwords($table, $column) as $key => $record){
                    $this->Output->print($column . ' was updated to ' . $record[$column]);
                }
            } else {
                $this->Output->print("Missing column name");
            }
        } else {
            $this->Output->print("Missing table name");
        }
    }

    /**
     * Secure Doctypes
     */
    public function secureDoctypesAction()
    {
        // Import Global Variables
        global $UUID;

        // Loop through the Doctypes
        foreach($this->Model->Dev->read('doctypes') as $key => $record){
            $this->Model->Dev->update('doctypes',$record['id'],['password' => password_hash($UUID->toString($record['id'].$record['template'].$record['locale']), PASSWORD_DEFAULT)]);
        }
    }
}
