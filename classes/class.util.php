<?php
/*
 * File: class.util.php
 * File Created: Saturday, 9th July 2022 8:36:55 pm
 * Author: hiimcody1
 * 
 * Last Modified: Monday, 8th August 2022 3:57:16 am
 * Modified By: hiimcody1
 * 
 * License: MIT License http://www.opensource.org/licenses/MIT
 */



class Util {

    public static function DeferAndContinueExecution($hash,$retString=null) {
        if($retString)
            echo $retString;

        file_put_contents(Config::TemporaryPath.$hash,json_encode(array("starttime"=>time(),"status"=>"waiting")));
        
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
        
    }

    public static function FinishBackgroundProcess($hash,$newHash=null,$markFail=false) {
        if($markFail) {
            file_put_contents(Config::TemporaryPath.$hash,json_encode(array("status"=>"failed","hash"=>$hash)));
            return;
        }
        $status = file_get_contents(Config::TemporaryPath.$hash);
        if(Util::isJson($status)) {
            //Valid BG process
            if(!$newHash)
                $newHash=$hash;
            file_put_contents(Config::TemporaryPath.$hash,json_encode(array("starttime"=>$status['starttime'],"status"=>"done","hash"=>$newHash)));
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
}