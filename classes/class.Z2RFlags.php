<?php
/*
 * File: class.Z2RFlags.php
 * File Created: Saturday, 14th January 2023 7:17:21 pm
 * Author: hiimcody1
 * 
 * Last Modified: Thursday, 2nd February 2023 12:33:16 am
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */

require_once("./classes/class.PseudoBitArray.php");

//Basically a carbon-copy of RandomizerProperties.cs from the Z2R program
class Z2RFlags {
        protected const TOTAL_FLAGS = 28;

        //ROM Info
        public String $filename;
        public int $seed;
        public String $flags;

        //Items
        public Z2RFlag $shuffleItems;
        public Z2RFlag $startCandle;
        public Z2RFlag $startGlove;
        public Z2RFlag $startRaft;
        public Z2RFlag $startBoots;
        public Z2RFlag $startFlute;
        public Z2RFlag $startCross;
        public Z2RFlag $startHammer;
        public Z2RFlag $startKey;

        //Spells
        public Z2RFlag $shuffleSpells;
        public Z2RFlag $startShield;
        public Z2RFlag $startJump;
        public Z2RFlag $startLife;
        public Z2RFlag $startFairy;
        public Z2RFlag $startFire;
        public Z2RFlag $startReflect;
        public Z2RFlag $startSpell;
        public Z2RFlag $startThunder;
        public Z2RFlag $combineFire;
        public Z2RFlag $dashSpell;

        //Other starting attributes
        public Z2RFlag $startHearts;
        public Z2RFlag $maxHearts;
        public Z2RFlag $startTech;
        public Z2RFlag $shuffleLives;
        public Z2RFlag $permanentBeam;
        public Z2RFlag $community;
        public Z2RFlag $startAtk;
        public Z2RFlag $startMag;
        public Z2RFlag $startLifeLvl;

        //Overworld
        public Z2RFlag $swapPalaceCont;
        public Z2RFlag $p7shuffle;
        public Z2RFlag $shuffleEncounters;
        public Z2RFlag $allowPathEnemies;
        public Z2RFlag $hiddenPalace;
        public Z2RFlag $hiddenKasuto;
        public Z2RFlag $townSwap;
        public Z2RFlag $encounterRate;
        public Z2RFlag $continentConnections;
        public Z2RFlag $boulderBlockConnections;
        public Z2RFlag $westBiome;
        public Z2RFlag $eastBiome;
        public Z2RFlag $mazeBiome;
        public Z2RFlag $dmBiome;
        public Z2RFlag $vanillaOriginal;
        public Z2RFlag $shuffleHidden;
        public Z2RFlag $bootsWater;
        public Z2RFlag $bagusWoods;

        //Palaces
        public Z2RFlag $shufflePalaceRooms;
        public Z2RFlag $startGems;
        public Z2RFlag $requireTbird;
        public Z2RFlag $palacePalette;
        public Z2RFlag $upaBox; //Start at palace on game over
        public Z2RFlag $shortenGP;
        public Z2RFlag $removeTbird;
        public Z2RFlag $bossItem;
        public Z2RFlag $createPalaces;
        public Z2RFlag $customRooms;
        public Z2RFlag $blockersAnywhere;
        public Z2RFlag $bossRoomConnect;

        //Enemies
        public Z2RFlag $shuffleEnemyHP;
        public Z2RFlag $shuffleEnemyStealExp;
        public Z2RFlag $shuffleStealExpAmt;
        public Z2RFlag $shuffleSwordImmunity;
        public Z2RFlag $shuffleOverworldEnemies;
        public Z2RFlag $shufflePalaceEnemies;
        public Z2RFlag $mixEnemies;
        public Z2RFlag $shuffleDripper;
        public Z2RFlag $shuffleEnemyPalettes;
        public Z2RFlag $expLevel;

        //Levels
        public Z2RFlag $shuffleAllExp;
        public Z2RFlag $shuffleAtkExp;
        public Z2RFlag $shuffleMagicExp;
        public Z2RFlag $shuffleLifeExp;
        public Z2RFlag $shuffleAtkEff;
        public Z2RFlag $shuffleMagEff;
        public Z2RFlag $shuffleLifeEff;
        public Z2RFlag $shuffleLifeRefill;
        public Z2RFlag $shuffleSpellLocations;
        public Z2RFlag $disableMagicRecs;
        public Z2RFlag $ohkoEnemies;
        public Z2RFlag $tankMode;
        public Z2RFlag $ohkoLink;
        public Z2RFlag $wizardMode;
        public Z2RFlag $highAtk;
        public Z2RFlag $lowAtk;
        public Z2RFlag $highDef;
        public Z2RFlag $highMag;
        public Z2RFlag $lowMag;
        public Z2RFlag $attackCap;
        public Z2RFlag $magicCap;
        public Z2RFlag $lifeCap;
        public Z2RFlag $scaleLevels;
        public Z2RFlag $hideLocs;
        public Z2RFlag $saneCaves;
        public Z2RFlag $spellEnemy;

        //Items
        public Z2RFlag $shuffleOverworldItems;
        public Z2RFlag $shufflePalaceItems;
        public Z2RFlag $mixOverworldPalaceItems;
        public Z2RFlag $shuffleSmallItems;
        public Z2RFlag $extraKeys;
        public Z2RFlag $kasutoJars;
        public Z2RFlag $pbagItemShuffle;
        public Z2RFlag $removeSpellItems;
        public Z2RFlag $shufflePbagXp;

        //Drops
        public Z2RFlag $pbagDrop;
        public Z2RFlag $shuffleEnemyDrops;
        public Z2RFlag $smallbluejar;
        public Z2RFlag $smallredjar;
        public Z2RFlag $small50;
        public Z2RFlag $small100;
        public Z2RFlag $small200;
        public Z2RFlag $small500;
        public Z2RFlag $small1up;
        public Z2RFlag $smallkey;
        public Z2RFlag $largebluejar;
        public Z2RFlag $largeredjar;
        public Z2RFlag $large50;
        public Z2RFlag $large100;
        public Z2RFlag $large200;
        public Z2RFlag $large500;
        public Z2RFlag $large1up;
        public Z2RFlag $largekey;
        public Z2RFlag $standardizeDrops;
        public Z2RFlag $randoDrops;

        //Hints
        public Z2RFlag $spellItemHints;
        public Z2RFlag $helpfulHints;
        public Z2RFlag $townNameHints;

        //Misc.
        public bool $disableBeep;
        public Z2RFlag $jumpAlwaysOn;
        public Z2RFlag $dashAlwaysOn;
        public bool $fastCast;
        public String $beamSprite;
        public bool $disableMusic;
        public String $charSprite;
        public String $tunicColor;
        public String $shieldColor;
        public bool $upAC1;
        public bool $removeFlashing;

        //Functions

        public function __construct(String $flags=null) {
            $this->initFlags();
            if($flags != null) {
                $this->flags = $flags;
                $this->ParseFlags();
            }
        }

        public function ValidateExternalFlags($flags) {
            //Simple validation for now until better testing is build for flags
            while(strlen($flags) < $this::TOTAL_FLAGS)
                $flags .= "A";

            for($i=0;$i<strlen($flags);$i++) {
                if(strpos(Z2RBitArray::GLYPHS,substr($flags,$i,1)) === false) {
                    return false;
                }
                //else
                //var_export(array(Z2RBitArray::GLYPHS,substr($flags,$i,1),$i));
            }
            return true;
        }

        public function ParseFlags() {
            /*
                Flag storage information
                There are {$this::TOTAL_FLAGS} sets of flags defined right now.

                Each flag contains a 6 digit binary represention of the position that character is in within our Glyphs array, Eg A = 000000, B = 000001, etc
                
                To obtain your value for a specific setting, you digest the binary right-to-left and get your boolean out of it.
                In some cases you must combine multiple bits to obtain your value and those will be documented below.

                TODO: Add more robust digestion and generation of flag strings, tests must be created to verify robustness of digestion and generation functions

            */
            while(strlen($this->flags) < $this::TOTAL_FLAGS)
                $this->flags .= "A";
            
            $BitArrays = Array();

            $props = $this->getAllProps();

            for($i=0;$i<$this::TOTAL_FLAGS;$i++) {
                $BitArrays[] = new Z2RBitArray($this->flags[$i]);
                for($b=0;$b<6;$b++) {
                    foreach($props as $prop) {
                        if($prop->matchesArrayAndBit($i,$b)) {
                            $prop->setBit($i,$b,$BitArrays[$i]->getBit($b));
                        }
                    }
                    
                }
            }
        }

        public function SaveFlags():string {
            $BitArrays = Array();

            $props = $this->getAllProps();
            for($i=0;$i<$this::TOTAL_FLAGS;$i++) {
                $ba = new PseudoBitArray();
                for($b=0;$b<6;$b++) {
                    foreach($props as $prop) {
                        if($prop->matchesArrayAndBit($i,$b))
                            $ba->setBit($b,(int)$prop->getBit($i,$b));
                    }
                }
                $BitArrays[$i] = new Z2RBitArray();
                $ba->reverseArray();
                $BitArrays[$i]->setInt($ba->getInt());
            }

            $flags="";
            foreach($BitArrays as $ba) {
                $flags = $flags . $ba->asGlyph();
            }
            return $flags;
        }

        public function dumpProps() {
            $props = $this->getAllProps();
            foreach($props as $prop)
                echo str_pad($prop->Name,25) . ": " . str_pad("(" . $prop->Type . ")",10) . $prop->getValue() . "\r\n";
        }

        private function getAllProps() {
            $vars = get_object_vars($this);
            $props = Array();
            foreach($vars as $var) {
                if(gettype($var) == "object") {
                    if(get_class($var) == "Z2RFlag")
                        $props[] = $var;
                }
            }
            return $props;
        }

        private function initFlags() {

            //Items                                         name                    type        tab                   bitarrayId , bitId
            $this->shuffleItems            = new Z2RFlag("shuffleItems",            "bool",     Z2RTabs::StartConfiguration,    0,0);
            $this->startCandle             = new Z2RFlag("startCandle",             "bool",     Z2RTabs::StartConfiguration,    0,1);
            $this->startGlove              = new Z2RFlag("startGlove",              "bool",     Z2RTabs::StartConfiguration,    0,2);
            $this->startRaft               = new Z2RFlag("startRaft",               "bool",     Z2RTabs::StartConfiguration,    0,3);
            $this->startBoots              = new Z2RFlag("startBoots",              "bool",     Z2RTabs::StartConfiguration,    0,4);
            $this->startFlute              = new Z2RFlag("startFlute",              "bool",     Z2RTabs::StartConfiguration,    1,0);
            $this->startCross              = new Z2RFlag("startCross",              "bool",     Z2RTabs::StartConfiguration,    1,1);
            $this->startHammer             = new Z2RFlag("startHammer",             "bool",     Z2RTabs::StartConfiguration,    1,2);
            $this->startKey                = new Z2RFlag("startKey",                "bool",     Z2RTabs::StartConfiguration,    1,3);

            //Spells
            $this->shuffleSpells           = new Z2RFlag("shuffleSpells",           "bool",     Z2RTabs::StartConfiguration,    1,4);
            $this->startShield             = new Z2RFlag("startShield",             "bool",     Z2RTabs::StartConfiguration,    2,0);
            $this->startJump               = new Z2RFlag("startJump",               "bool",     Z2RTabs::StartConfiguration,    2,1);
            $this->startLife               = new Z2RFlag("startLife",               "bool",     Z2RTabs::StartConfiguration,    2,2);
            $this->startFairy              = new Z2RFlag("startFairy",              "bool",     Z2RTabs::StartConfiguration,    2,3);
            $this->startFire               = new Z2RFlag("startFire",               "bool",     Z2RTabs::StartConfiguration,    2,4);
            $this->startReflect            = new Z2RFlag("startReflect",            "bool",     Z2RTabs::StartConfiguration,    3,0);
            $this->startSpell              = new Z2RFlag("startSpell",              "bool",     Z2RTabs::StartConfiguration,    3,1);
            $this->startThunder            = new Z2RFlag("startThunder",            "bool",     Z2RTabs::StartConfiguration,    3,2);
            $this->combineFire             = new Z2RFlag("combineFire",             "bool",     Z2RTabs::StartConfiguration,    2,5);
            $this->dashSpell               = new Z2RFlag("dashSpell",               "bool",     Z2RTabs::Spells,                7,2);

            //Other starting attributes
            $this->startHearts             = new Z2RFlag("startHearts",             "int",      Z2RTabs::StartConfiguration,    array(4,5),array(4=>array(0,1,2),5=>array(2)));
            $this->maxHearts               = new Z2RFlag("maxHearts",               "int",      Z2RTabs::StartConfiguration,    array(13),array(13=>array(0,1,2,3)));
            $this->startTech               = new Z2RFlag("startTech",               "int",      Z2RTabs::StartConfiguration,    4,array(4=>array(3,4,5)));
            $this->shuffleLives            = new Z2RFlag("shuffleLives",            "bool",     Z2RTabs::StartConfiguration,    3,3);
            $this->permanentBeam           = new Z2RFlag("permanentBeam",           "bool",     Z2RTabs::Misc,                  7,0);
            $this->community               = new Z2RFlag("community",               "bool",     Z2RTabs::Hints,                 12,4);
            $this->startAtk                = new Z2RFlag("startAtk",                "int",      Z2RTabs::StartConfiguration,    array(20,21),array(20=>array(5),21=>array(0,1)));
            $this->startMag                = new Z2RFlag("startMag",                "int",      Z2RTabs::StartConfiguration,    array(21),array(21=>array(2,3,4)));
            $this->startLifeLvl            = new Z2RFlag("startLifeLvl",            "int",      Z2RTabs::StartConfiguration,    array(21,22),array(21=>array(5),22=>array(0,1)));

            //Overworld
            $this->swapPalaceCont          = new Z2RFlag("swapPalaceCont",          "bool",     Z2RTabs::Overworld,             6,1);
            $this->p7shuffle               = new Z2RFlag("p7shuffle",               "bool",     Z2RTabs::Overworld,             5,3);
            $this->shuffleEncounters       = new Z2RFlag("shuffleEncounters",       "bool",     Z2RTabs::Overworld,             5,5);
            $this->allowPathEnemies        = new Z2RFlag("allowPathEnemies",        "bool",     Z2RTabs::Overworld,             6,5);
            $this->hiddenPalace            = new Z2RFlag("hiddenPalace",            "int",      Z2RTabs::Overworld,             13,array(13=>array(4,5)));
            $this->hiddenKasuto            = new Z2RFlag("hiddenKasuto",            "int",      Z2RTabs::Overworld,             14,array(14=>array(0,1)));
            //$this->townSwap              = new Z2RFlag("townSwap",                "bool",     Z2RTabs::Overworld,             );    //Legacy flag, not in the flags any longer
            $this->encounterRate           = new Z2RFlag("encounterRate",           "int",      Z2RTabs::Overworld,             20,array(20=>array(0,1)));
            $this->continentConnections    = new Z2RFlag("continentConnections",    "int",      Z2RTabs::Overworld,             array(21,22),array(21=>array(5),22=>array(2,3)));
            $this->boulderBlockConnections = new Z2RFlag("boulderBlockConnections","bool",      Z2RTabs::Overworld,             22,4);
            $this->westBiome               = new Z2RFlag("westBiome",               "int",      Z2RTabs::Overworld,             array(22,23),array(22=>array(5),23=>array(0,1,2)));
            $this->eastBiome               = new Z2RFlag("eastBiome",               "int",      Z2RTabs::Overworld,             24,array(24=>array(1,2,3,4)));
            $this->mazeBiome               = new Z2RFlag("mazeBiome",               "int",      Z2RTabs::Overworld,             array(24,25),array(24=>array(5),25=>array(0)));
            $this->dmBiome                 = new Z2RFlag("dmBiome",                 "int",      Z2RTabs::Overworld,             array(23,24),array(23=>array(3,4,5),24=>array(0)));
            $this->vanillaOriginal         = new Z2RFlag("vanillaOriginal",         "bool",     Z2RTabs::Overworld,             25,1);
            $this->shuffleHidden           = new Z2RFlag("shuffleHidden",           "bool",     Z2RTabs::Overworld,             25,2);
            $this->bootsWater              = new Z2RFlag("bootsWater",              "bool",     Z2RTabs::Overworld,             25,4);
            $this->bagusWoods              = new Z2RFlag("bagusWoods",              "bool",     Z2RTabs::Overworld,             26,0);

            //Palaces
            $this->shufflePalaceRooms      = new Z2RFlag("shufflePalaceRooms",      "intbool",  Z2RTabs::Palaces,               26,array(26=>array(1,5)),1);
            $this->startGems               = new Z2RFlag("startGems",               "int",      Z2RTabs::Palaces,               10,array(10=>array(2,3,4)));
            $this->requireTbird            = new Z2RFlag("requireTbird",            "bool",     Z2RTabs::Palaces,               8,5);
            $this->palacePalette           = new Z2RFlag("palacePalette",           "bool",     Z2RTabs::Palaces,               5,4);
            $this->upaBox                  = new Z2RFlag("upaBox",                  "bool",     Z2RTabs::Palaces,               8,3); //Start at palace on game over
            $this->shortenGP               = new Z2RFlag("shortenGP",               "bool",     Z2RTabs::Palaces,               8,4);
            $this->removeTbird             = new Z2RFlag("removeTbird",             "bool",     Z2RTabs::Palaces,               3,4);
            $this->bossItem                = new Z2RFlag("bossItem",                "bool",     Z2RTabs::Palaces,               25,3);
            $this->createPalaces           = new Z2RFlag("createPalaces",           "intbool",  Z2RTabs::Palaces,               26,array(26=>array(1,5)),2);
            $this->customRooms             = new Z2RFlag("customRooms",             "bool",     Z2RTabs::Palaces,               26,2);
            $this->blockersAnywhere        = new Z2RFlag("blockersAnywhere",        "bool",     Z2RTabs::Palaces,               26,3);
            $this->bossRoomConnect         = new Z2RFlag("bossRoomConnect",         "bool",     Z2RTabs::Palaces,               26,4);

            //Enemies
            $this->shuffleEnemyHP          = new Z2RFlag("shuffleEnemyHP",          "bool",     Z2RTabs::Enemies,               7,3);
            $this->shuffleEnemyStealExp    = new Z2RFlag("shuffleEnemyStealExp",    "bool",     Z2RTabs::Enemies,               9,3);
            $this->shuffleStealExpAmt      = new Z2RFlag("shuffleStealExpAmt",      "bool",     Z2RTabs::Enemies,               9,4);
            $this->shuffleSwordImmunity    = new Z2RFlag("shuffleSwordImmunity",    "bool",     Z2RTabs::Enemies,               10,0);
            $this->shuffleOverworldEnemies = new Z2RFlag("shuffleOverworldEnemies", "bool",     Z2RTabs::Enemies,               0,5);
            $this->shufflePalaceEnemies    = new Z2RFlag("shufflePalaceEnemies",    "bool",     Z2RTabs::Enemies,               7,5);
            $this->mixEnemies              = new Z2RFlag("mixEnemies",              "bool",     Z2RTabs::Enemies,               10,5);
            $this->shuffleDripper          = new Z2RFlag("shuffleDripper",          "bool",     Z2RTabs::Enemies,               7,1);
            $this->shuffleEnemyPalettes    = new Z2RFlag("shuffleEnemyPalettes",    "bool",     Z2RTabs::Enemies,               12,5);
            $this->expLevel                = new Z2RFlag("expLevel",                 "int",     Z2RTabs::Enemies,               20,array(20=>array(2,3,4)));

            //Levels
            $this->shuffleAllExp           = new Z2RFlag("shuffleAllExp",           "bool",     Z2RTabs::Levels,                7,4);
            $this->shuffleAtkExp           = new Z2RFlag("shuffleAtkExp",           "bool",     Z2RTabs::Levels,                8,0);
            $this->shuffleMagicExp         = new Z2RFlag("shuffleMagicExp",         "bool",     Z2RTabs::Levels,                8,2);
            $this->shuffleLifeExp          = new Z2RFlag("shuffleLifeExp",          "bool",     Z2RTabs::Levels,                8,1);
            $this->shuffleAtkEff           = new Z2RFlag("shuffleAtkEff",           "intbool",  Z2RTabs::Levels,                6,array(6=>array(2,3,4)),0);
            $this->shuffleMagEff           = new Z2RFlag("shuffleMagEff",           "intbool",  Z2RTabs::Levels,                9,array(9=>array(0,1,2)),0);
            $this->shuffleLifeEff          = new Z2RFlag("shuffleLifeEff",          "intbool",  Z2RTabs::Levels,                12,array(12=>array(0,1,2)),0);
            $this->shuffleLifeRefill       = new Z2RFlag("shuffleLifeRefill",       "bool",     Z2RTabs::Levels,                9,5);
            $this->shuffleSpellLocations   = new Z2RFlag("shuffleSpellLocations",   "bool",     Z2RTabs::Levels,                11,4);
            $this->disableMagicRecs        = new Z2RFlag("disableMagicRecs",        "bool",     Z2RTabs::Levels,                11,5);
            $this->ohkoEnemies             = new Z2RFlag("ohkoEnemies",             "intbool",  Z2RTabs::Levels,                6,array(6=>array(2,3,4)),4);
            $this->tankMode                = new Z2RFlag("tankMode",                "intbool",  Z2RTabs::Levels,                12,array(12=>array(0,1,2)),4);
            $this->ohkoLink                = new Z2RFlag("ohkoLink",                "intbool",  Z2RTabs::Levels,                12,array(12=>array(0,1,2)),1);
            $this->wizardMode              = new Z2RFlag("wizardMode",              "intbool",  Z2RTabs::Levels,                9,array(9=>array(0,1,2)),4);
            $this->highAtk                 = new Z2RFlag("highAtk",                 "intbool",  Z2RTabs::Levels,                6,array(6=>array(2,3,4)),3);
            $this->lowAtk                  = new Z2RFlag("lowAtk",                  "intbool",  Z2RTabs::Levels,                6,array(6=>array(2,3,4)),1);
            $this->highDef                 = new Z2RFlag("highDef",                 "intbool",  Z2RTabs::Levels,                12,array(12=>array(0,1,2)),3);
            $this->highMag                 = new Z2RFlag("highMag",                 "intbool",  Z2RTabs::Levels,                9,array(9=>array(0,1,2)),1);
            $this->lowMag                  = new Z2RFlag("lowMag",                  "intbool",  Z2RTabs::Levels,                9,array(9=>array(0,1,2)),3);
            $this->attackCap               = new Z2RFlag("attackCap",                "int",     Z2RTabs::Levels,                18,array(18=>array(1,2,3)));
            $this->magicCap                = new Z2RFlag("magicCap",                 "int",     Z2RTabs::Levels,                array(18,19),array(18=>array(4,5),19=>array(0)));
            $this->lifeCap                 = new Z2RFlag("lifeCap",                  "int",     Z2RTabs::Levels,                19,array(19=>array(1,2,3)));
            $this->scaleLevels             = new Z2RFlag("scaleLevels",             "bool",     Z2RTabs::Levels,                19,4);

            //TODO, Fix these locations
            $this->hideLocs                = new Z2RFlag("hideLocs",                "bool",     Z2RTabs::Overworld,             1,5);
            $this->saneCaves               = new Z2RFlag("saneCaves",               "bool",     Z2RTabs::Overworld,             3,5);
            $this->spellEnemy              = new Z2RFlag("spellEnemy",              "bool",     Z2RTabs::Spells,                25,5);

            //Items
            $this->shuffleOverworldItems   = new Z2RFlag("shuffleOverworldItems",   "bool",     Z2RTabs::Items,                 11,1);
            $this->shufflePalaceItems      = new Z2RFlag("shufflePalaceItems",      "bool",     Z2RTabs::Items,                 11,0);
            $this->mixOverworldPalaceItems = new Z2RFlag("mixOverworldPalaceItems", "bool",     Z2RTabs::Items,                 11,2);
            $this->shuffleSmallItems       = new Z2RFlag("shuffleSmallItems",       "bool",     Z2RTabs::Items,                 11,3);
            $this->extraKeys               = new Z2RFlag("extraKeys",               "bool",     Z2RTabs::Items,                 6,0);
            $this->kasutoJars              = new Z2RFlag("kasutoJars",              "bool",     Z2RTabs::Items,                 12,3);
            $this->pbagItemShuffle         = new Z2RFlag("pbagItemShuffle",         "bool",     Z2RTabs::Items,                 5,1);
            $this->removeSpellItems        = new Z2RFlag("removeSpellItems",        "bool",     Z2RTabs::Items,                 14,3);
            $this->shufflePbagXp           = new Z2RFlag("shufflePbagXp",           "bool",     Z2RTabs::Items,                 18,0);

            //Drops
            $this->pbagDrop                = new Z2RFlag("pbagDrop",                "bool",     Z2RTabs::Drops,                 5,0);
            $this->shuffleEnemyDrops       = new Z2RFlag("shuffleEnemyDrops",       "bool",     Z2RTabs::Drops,                 14,2);
            $this->smallbluejar            = new Z2RFlag("smallbluejar",            "bool",     Z2RTabs::Drops,                 14,4);
            $this->smallredjar             = new Z2RFlag("smallredjar",             "bool",     Z2RTabs::Drops,                 14,5);
            $this->small50                 = new Z2RFlag("small50",                 "bool",     Z2RTabs::Drops,                 15,0);
            $this->small100                = new Z2RFlag("small100",                "bool",     Z2RTabs::Drops,                 15,1);
            $this->small200                = new Z2RFlag("small200",                "bool",     Z2RTabs::Drops,                 15,2);
            $this->small500                = new Z2RFlag("small500",                "bool",     Z2RTabs::Drops,                 15,3);
            $this->small1up                = new Z2RFlag("small1up",                "bool",     Z2RTabs::Drops,                 15,4);
            $this->smallkey                = new Z2RFlag("smallkey",                "bool",     Z2RTabs::Drops,                 15,5);
            $this->largebluejar            = new Z2RFlag("largebluejar",            "bool",     Z2RTabs::Drops,                 16,0);
            $this->largeredjar             = new Z2RFlag("largeredjar",             "bool",     Z2RTabs::Drops,                 16,1);
            $this->large50                 = new Z2RFlag("large50",                 "bool",     Z2RTabs::Drops,                 16,2);
            $this->large100                = new Z2RFlag("large100",                "bool",     Z2RTabs::Drops,                 16,3);
            $this->large200                = new Z2RFlag("large200",                "bool",     Z2RTabs::Drops,                 16,4);
            $this->large500                = new Z2RFlag("large500",                "bool",     Z2RTabs::Drops,                 16,5);
            $this->large1up                = new Z2RFlag("large1up",                "bool",     Z2RTabs::Drops,                 17,0);
            $this->largekey                = new Z2RFlag("largekey",                "bool",     Z2RTabs::Drops,                 17,1);
            $this->standardizeDrops        = new Z2RFlag("standardizeDrops",        "bool",     Z2RTabs::Drops,                 17,4);
            $this->randoDrops              = new Z2RFlag("randoDrops",              "bool",     Z2RTabs::Drops,                 17,5);

            //Hints
            $this->spellItemHints          = new Z2RFlag("spellItemHints",          "bool",     Z2RTabs::Hints,                 17,3);
            $this->helpfulHints            = new Z2RFlag("helpfulHints",            "bool",     Z2RTabs::Hints,                 17,2);
            $this->townNameHints           = new Z2RFlag("townNameHints",           "bool",     Z2RTabs::Hints,                 19,5);

            //Misc.
            $this->disableBeep             = false;
            $this->jumpAlwaysOn            = new Z2RFlag("jumpAlwaysOn",            "bool",     Z2RTabs::Misc,                  10,1);
            $this->dashAlwaysOn            = new Z2RFlag("dashAlwaysOn",            "bool",     Z2RTabs::Misc,                  27,0);
            $this->fastCast                = false;    //Not in flags
            //$this->beamSprite              = new Z2RFlag("beamSprite",               "int",     Z2RTabs::Misc,                  );    //Not in flags
            $this->disableMusic            = false;
            //$this->charSprite              = new Z2RFlag("charSprite",               "int",     Z2RTabs::Misc,                  );    //Not in flags
            //$this->tunicColor              = new Z2RFlag("tunicColor",               "int",     Z2RTabs::Misc,                  );    //Not in flags
            //$this->shieldColor             = new Z2RFlag("shieldColor",              "int",     Z2RTabs::Misc,                  );    //Not in flags
            $this->upAC1                   = false;
            $this->removeFlashing          = true;
        }
}

class Z2RBitArray {
    public const GLYPHS = "ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz1234567890!@#$";
    private PseudoBitArray $BitArray;
    private String $Glyph;
    
    public function __construct(String|Array $GlyphOrArray="A") {
        if(gettype($GlyphOrArray) == "string") {
            $this->Glyph = $GlyphOrArray;
            $this->BitArray = $this->glypthToArray($this->Glyph);
            $this->BitArray->reverseArray();
        } else {
            $this->BitArray = $GlyphOrArray;
            $this->Glyph = $this->arrayToGlyph($this->BitArray);
        }
    }

    public function getBit($bit):int {
        return $this->BitArray->getBit($bit);
    }

    public function setBit($bit,$value) {
        $this->BitArray->setBit($bit, $value);
        $this->Glyph = $this->arrayToGlyph($this->BitArray);
    }

    public function setInt(int $int) {
        $this->BitArray->setInt($int);
        $this->Glyph = $this->arrayToGlyph($this->BitArray);
    }

    public function setGlyph($Glyph) {
        $this->Glyph = $Glyph;
        $this->BitArray = $this->glypthToArray($this->Glyph);
    }

    public function asArray() {
        return $this->BitArray;
    }

    public function asGlyph() {
        return $this->Glyph;
    }

    public function asInt() {
        return $this->BitArray->getInt();
    }

    private static function glypthToArray($Glyph) {
        $charPos = Z2RBitArray::glypthToInt($Glyph);
        $pba = new PseudoBitArray();
        $pba->setInt($charPos);
        return $pba;
    }

    private static function glypthToInt($Glyph) {
        $charPos = strpos(Z2RBitArray::GLYPHS,$Glyph);
        return $charPos;
    }

    private static function intToGlyph($int) {
        return Z2RBitArray::GLYPHS[$int];
    }

    private static function arrayToGlyph($BitArray) {
        return Z2RBitArray::intToGlyph($BitArray->getInt());
    }
}

class Z2RFlag {
    public String $Name;
    public String $Type;
    public int $TabId;

    //These can be a single int, or an array of int depending on what the flag is
    public int|array $ArrayNum;     
    public int|array $BitNum;
    
    //Everything is stored internally as this
    public PseudoBitArray $internalValue;
    private int $compareValue;
    private array $bitmap;

    public function __construct($name,$type=null,$tabId=null,$arrayNum=null,$bitNum=null,$compareVal=null) {
        $this->Name = $name;
        $this->TabId = $tabId !== null ? $tabId : -1;
        $this->Type = $type !== null ? $type : "";
        $this->ArrayNum = $arrayNum !== null ? $arrayNum : -1;
        $this->BitNum = $bitNum !== null ? $bitNum : -1;
        if(gettype($this->BitNum) == "array") {
            $length=0;
            $this->bitmap = array();
            foreach($this->BitNum as $key=>$entries) {
                if(gettype($entries) == "array") {
                    foreach($entries as $entry) {
                        //echo "Adding $key:$entry to bitmap at $length...\r\n";
                        $this->bitmap[$length] = $key.":".$entry;
                        $length ++;
                    }
                }
                else {
                    $this->bitmap[$length] = $entries;
                    $length++;
                }
            }
            //echo "Making PBA with length $length for {$this->Name}...\r\n";
            $this->internalValue = new PseudoBitArray($length);
        }
        else
            $this->internalValue = new PseudoBitArray();
        $this->compareValue = $compareVal !== null ? $compareVal : -1;
    }

    public function matchesArrayAndBit($arrayNum,$bitNum):bool {
        if(gettype($this->ArrayNum) == "integer" && gettype($this->BitNum) == "integer")
            return ( $this->ArrayNum == $arrayNum && $this->BitNum == $bitNum );
        
        //var_export(gettype($this->ArrayNum));
        //var_export(gettype($this->BitNum));
        $arrayMatch = false;
        $bitMatch = false;

        if(gettype($this->ArrayNum) == "array") {
            if(array_search($arrayNum,$this->ArrayNum) !== false)
                $arrayMatch = true;
        } else {
            $arrayMatch = $this->ArrayNum == $arrayNum;
        }

        if(gettype($this->BitNum) == "array") {
            //var_export($this->BitNum);
            if(array_key_exists($arrayNum,$this->BitNum)) {
                //echo "\$this->BitNum for $this->Name contains a key named $arrayNum\r\n";
                if(gettype($this->BitNum[$arrayNum]) == "array") {
                    if(array_search($bitNum,$this->BitNum[$arrayNum]) !== false) {
                        $bitMatch = true;
                        //echo "\$this->BitNum[$arrayNum] for $this->Name contains $bitNum!\r\n";
                    } else {
                        //echo "\$this->BitNum[$arrayNum] for $this->Name does not contain $bitNum!\r\n";
                        //var_export($this->BitNum);
                    }
                } else {
                    $bitMatch = $this->BitNum[$arrayNum] == $bitNum;
                }
            }
        } else {
            $bitMatch = $this->BitNum == $bitNum;
        }
        
        return ($arrayMatch && $bitMatch);
    }

    public function setBit($arrayNum,$bitNum,$bit) {
        return $this->internalValue->setBit($this->extBitToInternalBit($arrayNum,$bitNum),$bit);
    }

    public function setValue($value) {
        if(gettype($this->ArrayNum) == "integer" && gettype($this->BitNum) == "integer")
                return $this->internalValue->setBit($this->BitNum,(int)$value);

        return $this->internalValue->setInt((int)$value);
    }

    public function getBit($arrayNum,$bitNum) {
        return $this->internalValue->getBit($this->extBitToInternalBit($arrayNum,$bitNum));
    }

    public function getValue() {
        if($this->Type == "intbool") {
            return (int)($this->internalValue->getInt() == $this->compareValue);
        }
        if(gettype($this->ArrayNum) == "integer" && gettype($this->BitNum) == "integer") {
            return $this->internalValue->getBit($this->BitNum);
        }
        return $this->internalValue->getInt();
    }

    private function extBitToInternalBit($arrayNum,$bitNum) {
        if(isset($this->bitmap)) {
            //var_export($this->bitmap);
            foreach($this->bitmap as $key=>$map) {
                $rawKey = explode(":",$map);
                //echo "CMP array({$arrayNum}) bit({$bitNum}) to $key: ($map)\r\n";
                
                if($arrayNum == $rawKey[0] && $bitNum == $rawKey[1]) {
                    //echo "Matched to $map of $key, returning $key...\r\n";
                    return $key;
                }
            }
        }

        return $bitNum;
    }
}

class Z2RTabs {
    const StartConfiguration = 0;
    const Overworld = 1;
    const Palaces = 2;
    const Levels = 3;
    const Spells = 4;
    const Enemies = 5;
    const Items = 6;
    const Drops = 7;
    const Hints = 8;
    const Misc = 9;
}

//TODO Convert to using this instead of hard-coded strings in places
class Z2RFlagEnums {
    const StartHeartContainers = Array(
        0 => 1,
        1 => 2,
        2 => 3,
        3 => 4,
        4 => 5,
        5 => 6,
        6 => 7,
        7 => 8,
        8 => "Random",
    );
    
    const MaxHeartContainers = Z2RFlagEnums::StartHeartContainers;

    const StartingTech = Array(
        0 => "None",
        1 => "Downstab",
        2 => "Upstab",
        3 => "Both",
        4 => "Random",
    );

    const StartingLvl = Array(
        0 => 1,
        1 => 2,
        2 => 3,
        3 => 4,
        4 => 5,
        5 => 6,
        6 => 7,
        7 => 8
    );

    const OverworldEncounterRate = Array(
        0 => "Normal",
        1 => "50%",
        2 => "None"
    );

    const HiddenPalace = Array(
        0 => "Off",
        1 => "On",
        2 => "Random"
    );

    const HiddenKasuto = Z2RFlagEnums::HiddenPalace;

    const ContinentConnections = Array(
        0 => "Normal",
        1 => "R+B Border Shuffle",
        2 => "Transportation Shuffle",
        3 => "Anything Goes"
    );

    const WestContinentBiome = Array(
        0 => "Vanilla",
        1 => "Vanilla (shuffled)",
        2 => "Vanilla-Like",
        3 => "Islands",
        4 => "Canyon",
        5 => "Caldera",
        6 => "Mountainous",
        7 => "Random (no Vanilla)",
        8 => "Random (with Vanilla)"
    );

    const DeathMountainBiome = Z2RFlagEnums::WestContinentBiome;

    const EastContinentBiome = Array(
        0 => "Vanilla",
        1 => "Vanilla (shuffled)",
        2 => "Vanilla-Like",
        3 => "Islands",
        4 => "Canyon",
        5 => "Volcano",
        6 => "Mountainous",
        7 => "Random (no Vanilla)",
        8 => "Random (with Vanilla)"
    );

    const MazeIslandBiome = Array(
        0 => "Vanilla",
        1 => "Vanilla (shuffled)",
        2 => "Vanilla-Like",
        3 => "Random (with Vanilla)"
    );

    const PalaceStyle = Array(
        0 => "Vanilla",
        1 => "Shuffled",
        2 => "Reconstructed"
    );

    const PalacesToComplete = Array(
        0 => 0,
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => "Random"
    );

    const AttackLevelCap = Array(
        0 => 8,
        1 => 7,
        2 => 6,
        3 => 5,
        4 => 4,
        5 => 3,
        6 => 2,
        7 => 1
    );

    const MagicLevelCap = Z2RFlagEnums::AttackLevelCap;
    const LifeLevelCap = Z2RFlagEnums::AttackLevelCap;

    const AttackEffectiveness = Array(
        0 => "Random",
        1 => "Low Attack",
        2 => "Vanilla",
        3 => "High Attack",
        4 => "OHKO Enemies"
    );

    const MagicEffectiveness = Array(
        0 => "Random",
        1 => "High Spell Cost",
        2 => "Vanilla",
        3 => "Low Spell Cost",
        4 => "Free Spells"
    );

    const LifeEffectiveness = Array(
        0 => "Random",
        1 => "OHKO Link",
        2 => "Vanilla",
        3 => "High Defense",
        4 => "Invincible"
    );

    const EnemyExperienceDrops = Array(
        0 => "Vanilla",
        1 => "None",
        2 => "Low",
        3 => "Average",
        4 => "High"
    );

    public static function ValueToKey(String $enum, $value) {
        return array_search($value,constant($enum));
    }

    public static function PropToValue(Z2RFlag $flag) {
        switch($flag->Name) {
            case "shufflePalaceRooms":
            case "createPalaces":
                return Z2RFlagEnums::PalaceStyle[$flag->getValue()];
            case "shuffleAtkEff":
            case "ohkoEnemies":
            case "highAtk":
            case "lowAtk":
                return Z2RFlagEnums::AttackEffectiveness[$flag->getValue()];
            default:
                return null;
        }
    }
}

?>