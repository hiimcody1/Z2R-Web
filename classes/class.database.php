<?php
/*
 * File: class.database.php
 * File Created: Monday, 9th January 2023 8:03:33 pm
 * Author: hiimcody1
 * 
 * Last Modified: Monday, 23rd January 2023 7:48:46 pm
 * Modified By: hiimcody1
 * 
 * License: MIT License https://opensource.org/licenses/MIT
 */

class Database {
    private PDO $databaseHandle;

    public function __construct() {
        try {
            $connectionString = Config::DBType . ":host=" . Config::DBAddress . ";port=" . Config::DBPort . ";dbname=" . Config::DBName;
            $this->databaseHandle = new PDO($connectionString, Config::DBUser, Config::DBPass);
            $this->databaseHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e) {
            Util::FatalError("Database Connection Error" , array($connectionString,$e));
        }
    }

    public function fetchFlagsets() {
        $stmt = $this->databaseHandle->prepare("SELECT * FROM flagsets WHERE `logic` = :logic ORDER BY `name`");
        $stmt->execute(array(
            "logic" => Config::Z2RVersion
        ));

        if($stmt) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } else {
            Util::FatalError("Error retrieving Flagsets", array($this->databaseHandle->errorInfo()));
        }
    }

    public function fetchFlagsetByName($name) {
        $stmt = $this->databaseHandle->prepare("SELECT * FROM flagsets WHERE `name` LIKE :name ORDER BY `name` LIMIT 1");
        $stmt->execute(array(
            "name" => $name
        ));

        if($stmt) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results[0];
        } else {
            Util::FatalError("Error retrieving Flagsets", array($this->databaseHandle->errorInfo()));
        }
    }

    public function fetchFlagsetById($id) {
        $stmt = $this->databaseHandle->prepare("SELECT * FROM flagsets WHERE `id` = :id LIMIT 1");
        $stmt->execute(array(
            "id" => $id
        ));

        if($stmt) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results[0];
        } else {
            Util::FatalError("Error retrieving Flagsets", array($this->databaseHandle->errorInfo()));
        }
    }

    public function storeSeed(Z2RSeed $seed) {
        $stmt = $this->databaseHandle->prepare("INSERT INTO seeds (hash, seed, build, logic, flags, meta, patch) VALUES (:hash, :seed, :build, :logic, :flags, :meta, :patch);");
            $stmt->bindParam(":hash", $seed->hash);
            $stmt->bindParam(":seed", $seed->seed);
            $stmt->bindParam(":build", $seed->build);
            $stmt->bindParam(":logic", $seed->logic);
            $stmt->bindParam(":flags", $seed->flags);
            $stmt->bindParam(":meta", $seed->meta);
            $stmt->bindParam(":patch", $seed->patch, PDO::PARAM_LOB);
        $stmt->execute();

        if(!$stmt)
            Util::FatalError("Error storing seed!", array($seed,$stmt,$this->databaseHandle->errorInfo()));
    }

    public function fetchSeed(string $hash):Z2RSeed|bool {
        $stmt = $this->databaseHandle->prepare("SELECT * FROM seeds WHERE `hash` = :hash LIMIT 1");
        $stmt->execute(array(
            "hash" => $hash
        ));
        
        if($stmt) {
            try {
                $seed = $stmt->fetchObject("Z2RSeed");
                return $seed;
            } catch(Exception $e) {
                Util::FatalError("Error when retrieving hash!",array($stmt,$seed,$e,array("hash"=>$hash)));
            }
        } else {
            Util::FatalError("Error when retrieving hash!",array($this->databaseHandle->errorInfo()));
        }
    }
}