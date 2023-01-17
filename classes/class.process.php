<?php
/*
 * File: class.process.php
 * File Created: Saturday, 6th August 2022 8:57:10 pm
 * Author: hiimcody1
 * 
 * Last Modified: Saturday, 6th August 2022 11:28:04 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License http://www.opensource.org/licenses/MIT
 */

class Process {
    private $process;
    private $pipes;

    public function __construct($Program,$WorkingDirectory) {
        $descriptorSpec = array(
            0 => array("pipe", "r"),    //STDIN
            1 => array("pipe", "w"),    //STDOUT
            2 => array("pipe", "w")     //STDERR
        );
        if(Config::Debug)
            echo "Launching ".implode(" ",$Program)." from {$WorkingDirectory}...";
        $this->process = proc_open($Program,$descriptorSpec,$this->pipes,$WorkingDirectory);
        if(Config::Debug)
            var_export($this->process);
    }
    
    public function ReadPipes() {
        if(is_resource($this->process)) {
            fclose($this->pipes[0]);
            
            while(!feof($this->pipes[2])) {
                echo fgets($this->pipes[2]);
            }
            fclose($this->pipes[2]);

            while(!feof($this->pipes[1])) {
                echo fgets($this->pipes[1]);
            }
            fclose($this->pipes[1]);
        }
    }

    public function Status() {
        return proc_get_status($this->process);
    }

    public function Terminate() {
        return proc_close($this->process);
    }
}

?>