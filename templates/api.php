<?php
/*
 * File: api.php
 * File Created: Tuesday, 24th January 2023 3:17:55 pm
 * Author: hiimcody1
 * 
 * Last Modified: Tuesday, 24th January 2023 9:26:40 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */

header('Content-Type: application/json; charset=utf-8');

$api = $TemplateVars["_GET"][1];
$arg = $TemplateVars["_GET"][2];

switch($api) {
    case "hash":
        if(isset($arg)) {
            //Checking a hash
            $cleanHash = Util::sanitizeHash($arg);
            $db = new Database();
            $seed = $db->fetchSeed($cleanHash);
            if($seed)
                echo Util::APIResponse($seed->serialize());
            else
                echo Util::APIResponse(null,404);
        }
        break;
    case "flags":
        if(isset($arg)) {
            switch($arg) {
                case "validate":
                    $flags = new Z2RFlags();
                    echo Util::APIResponse($flags->ValidateExternalFlags($_POST['flags']),200);
                    break;
                case "save":
                    break;
                default:
                    echo Util::APIResponse(null,404);
            }
        }
        break;
    case "sprites":
        $db = new Database();
        $sprites = $db->fetchSprites();
        if($sprites)
            echo Util::APIResponse($sprites,200);
        else
            echo Util::APIResponse(null,500);
        break;
    case "checker":
        if(isset($arg)) {
            header_remove('Content-Type');
            //Checking a hash
            $cleanHash = Util::sanitizeHash($arg);
            $status = Util::QueryBackgroundProcess($cleanHash);
            if($status['status'] == "pregen") {
                echo('<html><head><meta http-equiv="refresh" content="5"></head></html>');
                Util::StartBackgroundProcess($cleanHash);
            } elseif($status['status'] == "done") {
                if(isset($status['hash']))
                    die('<html><head><script>parent.postMessage({"action": "switchUrl", "url": "/perm/'.$status['hash'].'"}, "https://z2r.hiimcody1.com/")</script></head></html>');
            
                die('<html><head><script>parent.postMessage({"action": "switchUrl", "url": "/index.php?genfailed&hash='.$cleanHash.'"}, "https://z2r.hiimcody1.com/")</script></head></html>');
            } elseif($status['status'] == "failed") {
                die('<html><head><script>parent.postMessage({"action": "switchUrl", "url": "/index.php?genfailed&hash='.$cleanHash.'"}, "https://z2r.hiimcody1.com/")</script></head></html>');
            } elseif(isset($status['starttime']) && time() - $status['starttime'] > (60 * 5)) {
                die('<html><head><script>parent.postMessage({"action": "switchUrl", "url": "/index.php?genfailed&hash='.$cleanHash.'"}, "https://z2r.hiimcody1.com/")</script></head></html>');
            } else {
                echo('<html><head><meta http-equiv="refresh" content="5"></head></html>');
            }
        }
        break;
    default:
        echo Util::APIResponse(null,500);

}

?>