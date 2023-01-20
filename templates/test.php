<?php
/*
 * File: testsuite.php
 * File Created: Monday, 16th January 2023 11:04:04 pm
 * Author: hiimcody1
 * 
 * Last Modified: Tuesday, 17th January 2023 7:12:20 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */

require_once("./classes/class.process.php");
require_once("./classes/class.PseudoBitArray.php");
require_once("./classes/class.Z2RFlags.php");
require_once("./classes/class.Z2Randomizer.php");

$db = new Database();
echo "<pre>";
$randomizer = new Z2Randomizer(new Z2RFlags($db->fetchFlagsetByName("beginner")["flags"]),987654321);
var_export($randomizer);
echo "\r\n";
$randomizer->DeferredGenerate();
echo "<iframe style=\"border: none; width:1px; height:1px;\" allowtransparency=\"true\" src=\"/api/checker/{$randomizer->hash}\"></iframe>";
//require("/var/www/html/z2r/tests/test.flags.php");
?>