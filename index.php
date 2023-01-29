<?php
/*
 * File: index.php
 * File Created: Saturday, 6th August 2022 8:36:11 pm
 * Author: hiimcody1
 * 
 * Last Modified: Friday, 27th January 2023 11:05:32 am
 * Modified By: hiimcody1
 * 
 * License: MIT License http://www.opensource.org/licenses/MIT
 */

ob_start();
require_once("config.php");
textdomain("z2r");
require_once("classes/unique.php");
require_once("classes/class.template.php");
require_once("classes/class.ui.php");

require_once("classes/class.Z2R.php");

$UI = new UI();
$UI->Render($UI->GetRoute($_GET['view']));

ob_end_flush();
?>