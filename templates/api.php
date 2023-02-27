<?php
/*
 * File: api.php
 * File Created: Tuesday, 24th January 2023 3:17:55 pm
 * Author: hiimcody1
 * 
 * Last Modified: Monday, 20th February 2023 7:35:12 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */

header('Content-Type: application/json; charset=utf-8');

try {
    // Takes raw data from the request
    $json = file_get_contents('php://input');
    // Converts it into a PHP object
    $data = json_decode($json, true);
} catch(Exception $e) {
    //Nothing for now
}

$api = $TemplateVars["_GET"][1];
if(count($TemplateVars["_GET"]) > 2)
    $arg = $TemplateVars["_GET"][2];

switch($api) {
    case "generate":
        //Generate a seed via the API
        ob_start();
        $flags = new Z2RFlags($data['flags']);
        $db = new Database();
        $preset = $db->fetchFlagsetByFlags($data['flags']);
        $randomizer = new Z2Randomizer($flags,$data['seed']);
        if($preset)
            $randomizer->meta = array("notes"=>$preset['name'] . " preset");
        else
            $randomizer->meta = array("notes"=>"GanonGranny genned seed");
            
        $seed = $randomizer->generate();
        ob_clean();
        if($seed) {
            if($preset) {
                echo Util::APIResponse(array("hash"=>$seed->hash,"preset"=>$preset['name']));
            } else {
                echo Util::APIResponse(array("hash"=>$seed->hash));
            }
        } else
            echo Util::APIResponse(null,404);
        break;
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
    case "beams":
        $db = new Database();
        $beams = $db->fetchBeamSprites();
        if($beams)
            echo Util::APIResponse($beams,200);
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
    case "smc":
        if(isset($_FILES['patch'])) {
            /*
            $file = sha1(random_bytes(5));
            move_uploaded_file($_FILES['patch']['tmp_name'], Config::OutputDir . $file);
            Patch::ApplyIPS(Config::Z2RDataPath . Config::RomFile, Config::OutputDir . $file, Config::OutputDir . $file . ".nes");
            Patch::NEStoSMC(Config::OutputDir . $file . ".nes");
            */
            Patch::NEStoSMC($_FILES['patch']['tmp_name']);
            if(isset($_POST['msu']) || true)
                Patch::ApplyIPS($_FILES['patch']['tmp_name'] . ".smc", Config::Z2RDataPath . "naol-msu1.ips", $_FILES['patch']['tmp_name'] . ".smc");
            if(file_exists($_FILES['patch']['tmp_name'] . ".smc")) {
                echo Util::APIResponse(array(
                    "patch" => base64_encode(file_get_contents($_FILES['patch']['tmp_name'] . ".smc"))
                ),200);
                
                //unlink(Config::OutputDir . $file);
                //unlink(Config::OutputDir . $file . ".nes");
                //unlink(Config::OutputDir . $file . ".nes.smc");
            } else {
                echo Util::APIResponse(null,500);
            }
        } else
            echo Util::APIResponse(null,500);
        break;
    default:
        echo Util::APIResponse(null,500);

}

?>