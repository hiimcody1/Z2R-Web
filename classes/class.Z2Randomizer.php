<?php
/*
 * File: class.Z2RSeed.php
 * File Created: Monday, 9th January 2023 9:56:05 pm
 * Author: hiimcody1
 * 
 * Last Modified: Monday, 20th February 2023 5:35:38 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */

class Z2Randomizer {
    readonly string $flags;
    readonly int $seed;
    readonly string $hash;
    public array $meta;
    
    private array $arguments;
    private $ipsData;
    private $outputPath;

    function __construct(Z2RFlags $flags,int $seed=null) {
        $this->seed = ($seed == null) ? mt_rand(0,999999999) : $seed;
        $this->flags = $flags->SaveFlags();
        $this->hash = $this->generateUniqueHash();
        $this->meta = array();
        $this->arguments = array(
            "--rom"     => Config::Z2RDataPath . Config::RomFile,
            "--flags"   => $this->flags,
            "--seed"    => $this->seed,
            "--hash"    => $this->hash
        );
    }

    public function DeferredGenerate() {
        //Generate in the background and return the checker iframe
        Util::DeferAndContinueExecution($this);
    }

    public function generate():?Z2RSeed {
        $launchCommand = Config::Z2RBinary;
        if(Config::UseMono)
            $launchCommand = "/usr/bin/mono " . Config::Z2RDataPath . $launchCommand;
        $cd = getcwd();
        
        chdir(Config::OutputDir);
        $randomizer = new Process($launchCommand,$this->arguments);
        $attempts=0;
        $success=false;
        while($attempts<Config::MaxGenAttempts && !$success) {
            $randomizer->Start();
            $lines = explode("\n",$randomizer->GetOutput());
            if(str_starts_with($lines[count($lines)-4],"Done")) {
                if(file_exists(Config::OutputDir . "Z2_" . $this->hash . ".nes")) {
                    $success=true;
                    $db = new Database();
                    $seed = new Z2RSeed();
                    $seed->hash = $this->hash;
                    $seed->seed = $this->seed;
                    $seed->build=Config::Z2RBuildDate;
                    $seed->logic=Config::Z2RVersion;
                    $seed->flags=$this->flags;
                    $seed->meta=json_encode($this->meta);
                    $seed->patch=$this->seedToIPS(Config::OutputDir . "Z2_" . $this->hash . ".nes");
                    $db->storeSeed($seed);
                    unlink(Config::OutputDir . "Z2_" . $this->hash . ".nes");
                    unlink(Config::OutputDir . "Z2_" . $this->hash . ".ips");
                }
            }
            $attempts++;
        }
        chdir($cd);

        if(!$success) {
            Util::LogError("Failed to generate seed, please try again later!",array($this));
            return null;
        }
        
        return $seed;
    }

    public function generateUniqueHash() {
        $randomHash = alphaID(random_int(0,9007199254740992));
        $db = new Database();
        while($db->fetchSeed($randomHash))
            $randomHash = alphaID(random_int(0,9007199254740992));
        return $randomHash;
    }

    private function seedToIPS($seed):string {
        $flips = new Process(Config::Z2RDataPath . Config::FlipsBinary,array(
            "--create --ips " => Config::Z2RDataPath . Config::RomFile,
            " " => $seed,
            "  "=> "Z2_" . $this->hash . ".ips"
        ));
        $flips->Start();
        $lines = explode("\n",$flips->GetOutput());
        if($lines[0] == "The patch was created successfully!") {
            return file_get_contents("Z2_" . $this->hash . ".ips");
        } else
            Util::FatalError("Failed to create patch!",$this);
    }

    private function seedToSFC($seed):string {
        $nested = new Process(Config::Z2RDataPath . Config::NestedBinary,array(
            "--rom " => $seed
        ));
        $nested->Start();
        $lines = explode("\n",$nested->GetOutput());
        if($lines[2] == "Successfully Created ROM!") {
            return file_get_contents("Z2_" . $this->hash . ".nes.smc");
        } else
            Util::FatalError("Failed to create patch!",$this);
    }
}


?>