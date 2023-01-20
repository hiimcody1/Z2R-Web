<?php
//Config
require_once("./config.php");

//Base Classes
require_once("./classes/class.database.php");
require_once("./classes/class.process.php");
require_once("./classes/class.util.php");

//Glue and types
require_once("./classes/class.PseudoBitArray.php");
require_once("./classes/class.Z2RFlags.php");
require_once("./classes/class.Z2RSeed.php");

//The main thing
require_once("./classes/class.Z2Randomizer.php");
?>