<?php
/*
 * File: class.process.php
 * File Created: Saturday, 6th August 2022 8:57:10 pm
 * Author: hiimcody1
 * 
 * Last Modified: Tuesday, 17th January 2023 4:16:32 am
 * Modified By: hiimcody1
 * 
 * License: MIT License http://www.opensource.org/licenses/MIT
 */

class Process {
    private $processHandle;
    private $program;
    private $args;

    public function __construct($Program,$Arguments=null) {
        $this->program = $Program;
        $this->args = ($Arguments !== null) ? $this->implodeArgs($Arguments) : "";
    }

    public function Start() {
        if(Config::Debug)
            echo "Launching '{$this->program} {$this->args}'...";
        $this->processHandle = popen($this->program." ".$this->args,"r");
        if(Config::Debug)
            var_export($this->processHandle);
    }

    public function GetOutput():string {
        $output = "";
        if(is_resource($this->processHandle)) {
            while(!feof($this->processHandle)) {
                $output .= fgets($this->processHandle);
            }
            fclose($this->processHandle);
        }
        return $output;
    }

    private function implodeArgs($Arguments) {
        $args="";
        foreach($Arguments as $key=>$value)
            $args .= $key . " '" . $value . "' ";
            
        return $args;
    }
}

?>