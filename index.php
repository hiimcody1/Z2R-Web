<?php
/*
 * File: index.php
 * File Created: Saturday, 6th August 2022 8:36:11 pm
 * Author: hiimcody1
 * 
 * Last Modified: Monday, 9th January 2023 9:55:03 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License http://www.opensource.org/licenses/MIT
 */

ob_start();
require("config.php");
require("classes/unique.php");
require("classes/class.process.php");
require("classes/class.template.php");
require("classes/class.ui.php");
require("classes/class.database.php");

$UI = new UI();
$UI->Render($UI->GetRoute($_GET['view']));


echo $Template->render("base.php");
ob_end_flush();
?>