<?php
/*
 * File: class.pseudobitarray.php
 * File Created: Sunday, 15th January 2023 5:38:57 pm
 * Author: hiimcody1
 * 
 * Last Modified: Monday, 16th January 2023 9:19:22 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */


class PseudoBitArray {
    private array $bits;
    public int $length;

    public function __construct($length=6) {
        $this->bits = Array();
        $this->length = $length;
        //init bits to length
        for($i=0;$i<$length;$i++)
            $this->bits[] = 0;
    }

    public function getBit($index) {
        if(!array_key_exists($index,$this->bits))
            throw new Exception("BitArray Index [$index] out of bounds!");
            
        return $this->bits[$index];
    }

    public function setBit($index,$value) {
        if($value !== 0 && $value !== 1)
            throw new Exception("Value must be 1 or 0. Was given " . gettype($value) . " with value " . $value . " (" . gettype($value) . ")");
        if(!array_key_exists($index,$this->bits))
            echo("Exception: BitArray Index out of bounds when trying to set [$index] to $value" . var_export($this,true));
            
        $this->bits[$index] = $value;
    }

    public function getInt() {
        return $this->arrayToInt();
    }

    public function setInt($int) {
        $this->intToArray($int);
    }

    public function reverseArray() {
        $this->bits = array_reverse($this->bits);
    }

    private function arrayToInt() {
        $forwardBits = "";
        for($i=0;$i<$this->length;$i++) {
            $forwardBits .= $this->bits[$i];
        }

        return bindec(strrev($forwardBits));    //Only reverse the bits when extracting an integer, I think
    }

    private function intToArray($int) {
        $reversedBits = str_pad((string)decbin($int),$this->length,"0",STR_PAD_LEFT);
        //echo "$int turns to $reversedBits\r\n";
        for($i=0;$i<$this->length;$i++) {
            $this->bits[$i] = $reversedBits[$i];
        }
        /*
        for($i=0;$i<$this->length;$i++) {
            //echo "Setting bit $i to " . $reversedBits[$this->length-$i-1] . " (" . ($this->length - $i-1) . ")\r\n";
            $this->bits[$i] = $reversedBits[$this->length-1 - $i];
        }
        */
    }
}

?>