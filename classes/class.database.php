<?php
/*
 * File: class.database.php
 * File Created: Monday, 9th January 2023 8:03:33 pm
 * Author: hiimcody1
 * 
 * Last Modified: Monday, 9th January 2023 9:56:38 pm
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
            if(Config::Debug)
                die("Database Connection Error <pre>" . var_export($connectionString) . "<br />" . var_export($e,true) . "</pre>");
            else
                die("Database Connection Error");
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
            if(Config::Debug)
                die("Error retrieving Flagsets <pre>" .  var_export($this->databaseHandle->errorInfo(),true) . "</pre>");
            else
                die("Error retrieving Flagsets");
        }

    }

    public function storeSeed(Z2RSeed $seed) {

    }
}