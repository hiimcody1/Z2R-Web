<?php
/*
 * File: config.php
 * File Created: Saturday, 6th August 2022 8:49:42 pm
 * Author: hiimcody1
 * 
 * Last Modified: Saturday, 28th January 2023 7:22:56 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License http://www.opensource.org/licenses/MIT
 */

class Config {
    //Application Config
    const Debug             = true;
    const TemporaryPath     = "/tmp/Z2R-";
    const TemplatesPath     = __DIR__."/templates/";
    const RoutesPath        = __DIR__."/routes/";
    const Version           = "0.0.1-alpha";
    const Lang              = "en_US.utf8";

    //Database Config
    const DBType            = "mysql";
    const DBAddress         = "127.0.0.1";
    const DBPort            = 3306;
    const DBName            = "z2r";
    const DBUser            = "z2r";
    const DBPass            = "z2r";

    //Z2R Randomizer Config
    const Z2RDataPath       = "/path/to/Z2R/program/";
    const Z2RVersion        = "4.0.4";
    const Z2RBuildDate      = "";
    const OutputDir         = "/path/to/output/generated/seed";
    const RomFile           = "ZELDA2.ROM";
    const UseMono           = true; //Linux servers should leave this as true
    const Z2RBinary         = "Z2Randomizer.exe";
    const FlipsBinary       = "flips";
    const MaxGenAttempts    = 5;
}
?>