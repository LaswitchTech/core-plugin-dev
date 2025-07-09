<?php

// Import additionnal class into the global namespace
use LaswitchTech\Core\Abstracts\Command;

class DevCommand extends Command {

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
}
