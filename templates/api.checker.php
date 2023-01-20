<?php
/*
 * File: api.checker.php
 * File Created: Tuesday, 17th January 2023 6:20:51 pm
 * Author: hiimcody1
 * 
 * Last Modified: Tuesday, 17th January 2023 7:49:52 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */
if($TemplateVars["_GET"][1] == "checker") {
    if(isset($TemplateVars["_GET"][2])) {
        //Checking a hash
        $cleanHash = Util::sanitizeHash($TemplateVars["_GET"][2]);
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
}
?>