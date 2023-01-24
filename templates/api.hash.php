<?php
/*
 * File: api.fetch.php
 * File Created: Tuesday, 17th January 2023 6:20:51 pm
 * Author: hiimcody1
 * 
 * Last Modified: Sunday, 22nd January 2023 2:41:22 am
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */

header('Content-Type: application/json; charset=utf-8');

if($TemplateVars["_GET"][1] == "hash") {
    if(isset($TemplateVars["_GET"][2])) {
        //Checking a hash
        $cleanHash = Util::sanitizeHash($TemplateVars["_GET"][2]);
        $db = new Database();
        $seed = $db->fetchSeed($cleanHash);
        if($seed)
            echo Util::APIResponse($seed->serialize());
        else
            echo Util::APIResponse(null,404);
    }
}
?>