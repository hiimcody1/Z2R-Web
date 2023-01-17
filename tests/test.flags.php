<?php
/*
 * File: test.flags.php
 * File Created: Saturday, 14th January 2023 7:27:42 pm
 * Author: hiimcody1
 * 
 * Last Modified: Monday, 16th January 2023 11:16:03 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */

require("./classes/class.Z2RFlags.php");
if(isset($_POST['flagset'])) {
    $testFlagset = new Z2RFlags($_POST['flagset']);
    $testFlagset->dumpProps();
    $testFlagset->SaveFlags();
} else {
    echo "<form method=\"POST\"><input type=\"text\" name=\"flagset\"><input type=\"submit\" name=\"test\" value=\"Parse Flagset\" /></form>";
    $beginnerFlagset = 'jhEhMROm7DZ$MHRBTNBhBAh0PSmA';
    $beginnerFlags = new Z2RFlags($beginnerFlagset);
    $beginnerFlags->dumpProps();
    $beginnerFlags->SaveFlags();
}
die();
//Start Configuration Tab
    //Starting Items
    $beginnerFlags->shuffleItems->setValue(false);
    $beginnerFlags->startCandle->setValue(true);
    $beginnerFlags->startGlove->setValue(false);
    $beginnerFlags->startRaft->setValue(false);
    $beginnerFlags->startBoots->setValue(false);
    $beginnerFlags->startFlute->setValue(false);
    $beginnerFlags->startCross->setValue(false);
    $beginnerFlags->startHammer->setValue(false);
    $beginnerFlags->startKey->setValue(false);

    //Starting Spells
    $beginnerFlags->shuffleSpells->setValue(false);
    $beginnerFlags->startShield->setValue(false);
    $beginnerFlags->startJump->setValue(false);
    $beginnerFlags->startLife->setValue(true);
    $beginnerFlags->startFairy->setValue(false);
    $beginnerFlags->startFire->setValue(false);
    $beginnerFlags->startReflect->setValue(false);
    $beginnerFlags->startSpell->setValue(false);
    $beginnerFlags->startThunder->setValue(false);

    //Starting Heart Containers
    $beginnerFlags->startHearts->setValue(4);

    //Max Heart Containers
    $beginnerFlags->maxHearts->setValue(8);

    //Starting Techs
    $beginnerFlags->startTech->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::StartingTech","Downstab"));

    //Starting levels
    $beginnerFlags->shuffleLives->setValue(false);
    $beginnerFlags->startAtk->setValue(1);
    $beginnerFlags->startMag->setValue(1);
    $beginnerFlags->startLifeLvl->setValue(1);

//Overworld
    //Palace Settings
    $beginnerFlags->swapPalaceCont->setValue(false);
    $beginnerFlags->p7shuffle->setValue(false);

    //Encounter Settings
    $beginnerFlags->shuffleEncounters->setValue(false);
        $beginnerFlags->allowPathEnemies->setValue(false); //Can only be defined based on shuffleEncounters being "On"
    $beginnerFlags->encounterRate->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::OverworldEncounterRate","50%"));
    
    //Hidden Locations
    
    $beginnerFlags->hiddenPalace->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::HiddenPalace","Off"));
    $beginnerFlags->hiddenKasuto->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::HiddenKasuto","Off"));
        $beginnerFlags->shuffleHidden->setValue(false);    //Can only be defined based on one of above 2 being "On" TODO:Implement linked options

    //Location Settings
    $beginnerFlags->hideLocs->setValue(true);
    $beginnerFlags->saneCaves->setValue(true);
    $beginnerFlags->boulderBlockConnections->setValue(false);
    $beginnerFlags->bootsWater->setValue(true);
    $beginnerFlags->bagusWoods->setValue(false);
    $beginnerFlags->continentConnections->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::ContinentConnections","Normal"));

    //Biome Settings
    $beginnerFlags->westBiome->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::WestContinentBiome","Random (no Vanilla)"));
    $beginnerFlags->dmBiome->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::DeathMountainBiome","Random (no Vanilla)"));
    $beginnerFlags->eastBiome->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::EastContinentBiome","Random (no Vanilla)"));
    $beginnerFlags->mazeBiome->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::MazeIslandBiome","Vanilla-Like"));
        $beginnerFlags->vanillaOriginal->setValue(false);  //Can only be true if mazeBiome is NOT "Vanilla-Like"

//Palaces
    $beginnerFlags->shufflePalaceRooms->setValue(false);
        //These are all part of a combo box that changes multiple things
        //If Box Value is NOT Reconstructed, these are forced to false
        $beginnerFlags->customRooms->setValue(false);
        $beginnerFlags->blockersAnywhere->setValue(false);
        $beginnerFlags->bossRoomConnect->setValue(false);

        //If Box Value is Reconstructed, these can be changed
        $beginnerFlags->customRooms->setValue(false);
        $beginnerFlags->blockersAnywhere->setValue(false);
        $beginnerFlags->bossRoomConnect->setValue(false);

        //If Box Value is NOT Vanilla, these things can be changed
        $beginnerFlags->shortenGP->setValue(false);
        $beginnerFlags->requireTbird->setValue(false);

    $beginnerFlags->customRooms->setValue(true);
    $beginnerFlags->blockersAnywhere->setValue(false);
    $beginnerFlags->bossRoomConnect->setValue(false);

    $beginnerFlags->shortenGP->setValue(true);
    $beginnerFlags->requireTbird->setValue(true);
    $beginnerFlags->removeTbird->setValue(false);

    $beginnerFlags->startGems->setValue(6);

    $beginnerFlags->upaBox->setValue(true);
    $beginnerFlags->palacePalette->setValue(true);
    $beginnerFlags->bossItem->setValue(false);

//Levels
    //XP Shuffle
    $beginnerFlags->shuffleAllExp->setValue(false);
        $beginnerFlags->shuffleAtkExp->setValue(false);
        $beginnerFlags->shuffleMagicExp->setValue(false);
        $beginnerFlags->shuffleLifeExp->setValue(false);
    
    //Level Caps
    $beginnerFlags->attackCap->setValue(8);
    $beginnerFlags->magicCap->setValue(8);
    $beginnerFlags->lifeCap->setValue(8);

    $beginnerFlags->scaleLevels->setValue(false);

    //Effectiveness
    $beginnerFlags->shuffleAtkEff->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::AttackEffectiveness","High Attack"));
    $beginnerFlags->shuffleMagEff->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::MagicEffectiveness","Low Spell Cost"));
    $beginnerFlags->shuffleLifeEff->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::LifeEffectiveness","High Defense"));

//Spells
    $beginnerFlags->shuffleLifeRefill->setValue(false);
    $beginnerFlags->shuffleSpellLocations->setValue(true);
    $beginnerFlags->disableMagicRecs->setValue(true);
    $beginnerFlags->combineFire->setValue(false);
    $beginnerFlags->spellEnemy->setValue(false);

    //Replace Fire with Dash Box will set:
    $beginnerFlags->dashSpell->setValue(true);
        $beginnerFlags->combineFire->setValue(false);
        $beginnerFlags->dashAlwaysOn->setValue(false);

//Enemies
    $beginnerFlags->shuffleOverworldEnemies->setValue(true);
    $beginnerFlags->shufflePalaceEnemies->setValue(true);
    $beginnerFlags->shuffleDripper->setValue(false);
    $beginnerFlags->mixEnemies->setValue(false);

    $beginnerFlags->shuffleEnemyHP->setValue(false);
    $beginnerFlags->shuffleEnemyStealExp->setValue(false);
    $beginnerFlags->shuffleStealExpAmt->setValue(false);
    $beginnerFlags->shuffleSwordImmunity->setValue(false);
    $beginnerFlags->expLevel->setValue(Z2RFlagEnums::ValueToKey("Z2RFlagEnums::EnemyExperienceDrops","Vanilla"));

//Items
    $beginnerFlags->shufflePalaceItems->setValue(true);
    $beginnerFlags->shuffleOverworldItems->setValue(true);
    $beginnerFlags->mixOverworldPalaceItems->setValue(true);
    $beginnerFlags->pbagItemShuffle->setValue(false);
    $beginnerFlags->shuffleSmallItems->setValue(true);
    $beginnerFlags->extraKeys->setValue(true);
    $beginnerFlags->kasutoJars->setValue(true);
    $beginnerFlags->removeSpellItems->setValue(false);
    $beginnerFlags->shufflePbagXp->setValue(true);

//Drops
    $beginnerFlags->pbagDrop->setValue(false);
    $beginnerFlags->randoDrops->setValue(false);
    $beginnerFlags->standardizeDrops->setValue(false);

    //Small Enemy Pool
    $beginnerFlags->smallbluejar->setValue(true);
    $beginnerFlags->smallredjar->setValue(false);
    $beginnerFlags->small50->setValue(true);
    $beginnerFlags->small100->setValue(false);
    $beginnerFlags->small200->setValue(false);
    $beginnerFlags->small500->setValue(false);
    $beginnerFlags->small1up->setValue(false);
    $beginnerFlags->smallkey->setValue(false);

    //Large Enemy Pool
    $beginnerFlags->largebluejar->setValue(false);
    $beginnerFlags->largeredjar->setValue(true);
    $beginnerFlags->large50->setValue(false);
    $beginnerFlags->large100->setValue(false);
    $beginnerFlags->large200->setValue(true);
    $beginnerFlags->large500->setValue(false);
    $beginnerFlags->large1up->setValue(false);
    $beginnerFlags->largekey->setValue(false);

//Hints
    $beginnerFlags->helpfulHints->setValue(true);
    $beginnerFlags->spellItemHints->setValue(true);
    $beginnerFlags->townNameHints->setValue(true);
    $beginnerFlags->community->setValue(false);

//Misc
    $beginnerFlags->disableBeep = false;
    $beginnerFlags->disableMusic = false;
    $beginnerFlags->jumpAlwaysOn->setValue(false);
    $beginnerFlags->dashAlwaysOn->setValue(false);
    $beginnerFlags->fastCast = false;
    $beginnerFlags->shuffleEnemyPalettes->setValue(false);
    $beginnerFlags->permanentBeam->setValue(false);
    $beginnerFlags->upAC1 = false;
    $beginnerFlags->removeFlashing = true;


//var_export($beginnerFlags);
//$beginnerFlags->ParseFlags();

//$parsedBeginnerFlags = new Z2RFlags($beginnerFlagset); 
//$parsedBeginnerFlags->ParseFlags();

//var_export($parsedBeginnerFlags->startHearts);

//echo "\r\n";
//echo "Start Hearts: " . $parsedBeginnerFlags->startHearts->getValue() . "||" . var_export($parsedBeginnerFlags->startHearts->internalValue,true) . "\r\n";
//echo "Max Hearts: " . $parsedBeginnerFlags->maxHearts->getValue() . "||" . var_export($parsedBeginnerFlags->maxHearts->internalValue,true) . "\r\n";
//var_export(Z2RFlagEnums::StartHeartContainers);
//var_export(Z2RFlagEnums::MaxHeartContainers);

?>