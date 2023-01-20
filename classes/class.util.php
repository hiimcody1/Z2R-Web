<?php
/*
 * File: class.util.php
 * File Created: Saturday, 9th July 2022 8:36:55 pm
 * Author: hiimcody1
 * 
 * Last Modified: Tuesday, 17th January 2023 7:37:39 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License http://www.opensource.org/licenses/MIT
 */



class Util {

    public static function DeferAndContinueExecution($randomizer) {
        file_put_contents(Config::TemporaryPath.$randomizer->hash,json_encode(array("starttime"=>time(),"status"=>"pregen","randomizer"=>serialize($randomizer))));
    }

    public static function StartBackgroundProcess($hash) {
        $batchProcess = Util::QueryBackgroundProcess($hash);
        if($batchProcess["status"] == "pregen") {
            
            ignore_user_abort(true);
            fastcgi_finish_request();

            // Send HTTP headers
            header('Content-Length: 0');
            header('Connection: close');

            // Clean up buffers
            if(ob_get_level() > 0)
            {
                    ob_end_clean();
                    ob_flush();
            }
            flush();
            //*/
            $randomizer = unserialize($batchProcess["randomizer"]);
            file_put_contents(Config::TemporaryPath.$hash,json_encode(array("starttime"=>time(),"status"=>"waiting")));
            $seed = $randomizer->generate();
            Util::FinishBackgroundProcess($randomizer->hash,$seed == null);
        } else {
            var_export($batchProcess);
        }
    }

    public static function FinishBackgroundProcess($hash,$markFail=false) {
        if($markFail) {
            file_put_contents(Config::TemporaryPath.$hash,json_encode(array("status"=>"failed","hash"=>$hash)));
            return;
        }
        $status = file_get_contents(Config::TemporaryPath.$hash);
        if(Util::isJson($status)) {
            //Valid BG process
            $status = json_decode($status,true);
            file_put_contents(Config::TemporaryPath.$hash,json_encode(array("starttime"=>$status['starttime'],"status"=>"done","hash"=>$hash)));
        }
    }

    public static function QueryBackgroundProcess($hash) {
        $status = file_get_contents(Config::TemporaryPath.$hash);
        if(Util::isJson($status)) {
            return json_decode($status,true);
        }
    }

    public static function isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public static function sanitizeHash($unsafeHash) {
        return preg_replace("/[^a-zA-Z0-9]+/", "",$unsafeHash);
    }

    public static function FatalError($error,$trace) {
        if(Config::Debug)
                die("{$error} <pre>" .  var_export($trace,true) . "</pre>");
            else
                die("{$error}");
    }

    public static function LogError($error,$trace) {
        //TODO
    }
}