<?php
/*
 * File: class.flips.php
 * File Created: Monday, 20th February 2023 5:36:02 pm
 * Author: hiimcody1
 * 
 * Last Modified: Monday, 20th February 2023 7:06:33 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */

class Patch {
    public static function CreateIPS($baseRomPath,$modifiedRomPath,$outputPath) {
        $flips = new Process(Config::Z2RDataPath . Config::FlipsBinary,array(
            "--create --ips " => $baseRomPath,
            " " => $modifiedRomPath,
            "  "=> $outputPath
        ));
        $flips->Start();
        $lines = explode("\n",$flips->GetOutput());
        if($lines[0] == "The patch was created successfully!") {
            return file_get_contents($outputPath);
        } else
            Util::FatalError("Failed to create patch!",array($baseRomPath,$modifiedRomPath,$outputPath));
    }

    public static function ApplyIPS($baseRomPath,$patchPath,$outputPath) {
        $flips = new Process(Config::Z2RDataPath . Config::FlipsBinary,array(
            "--apply " => $patchPath,
            " " => $baseRomPath,
            "  "=> $outputPath
        ));
        $flips->Start();
        $lines = explode("\n",$flips->GetOutput());
        if($lines[0] == "The patch was applied successfully!") {
            return file_get_contents($outputPath);
        } else
            Util::FatalError("Failed to create patch!",array($baseRomPath,$patchPath,$outputPath,$lines));
    }

    public static function NEStoSMC($nesFilePath) {
        $cwd = getcwd();
        chdir(Config::Z2RDataPath);
        $launchCommand = Config::Z2RDataPath . Config::NestedBinary;
        if(Config::UseMono)
            $launchCommand = "/usr/bin/mono " . $launchCommand;
        $nested = new Process($launchCommand,array(
            "--rom " => $nesFilePath
        ));
        $nested->Start();
        $lines = explode("\n",$nested->GetOutput());
        chdir($cwd);
        if($lines[2] == "Successfully Created ROM!") {
            return file_get_contents($nesFilePath . ".smc");
        } else
            Util::FatalError("Failed to create patch!",array($nesFilePath,$lines));
    }
}
?>