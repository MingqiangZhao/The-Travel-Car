<?php

require_once 'SModel.php';

class ModelAirport{
    public static function getAirportId($code){
        try {
            $database = SModel::getInstance();
            $query = "SELECT airportId FROM airport WHERE code=:code";
            $statement = $database->prepare($query);
            $statement->execute([
                ':code' => $code
            ]);
            $idNumber = $statement->fetch();
            return $idNumber[0];           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function add_airport($airportId,$code,$name,$country){
        try {
            $database = SModel::getInstance();
            $query = "INSERT INTO airport(airportId,code,name,country) VALUE (:airportId,:code,:name,:country)";
            $statement = $database->prepare($query);               
            $statement->execute([
                ':airportId' => $airportId,
                ':code' => $code,
                ':name' => $name,
                ':country' => $country
            ]);
            
            return TRUE;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
     public static function airportList(){
        try{
            $database = SModel::getInstance();
            //echo $userId;
            
            $query = "SELECT * FROM airport  ";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            //print_r($results);
            
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function idNumber(){
        try {
            $database = SModel::getInstance();
            $query = "SELECT max(airportId) FROM airport";
            $statement = $database->prepare($query);
            $statement->execute();
            $idNumber = $statement->fetch();
            return $idNumber[0]+1;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function delete_airport($airportId){
        try {
            $database = SModel::getInstance();
            $query = "DELETE FROM airport WHERE airportId=:airportId ";
            $statement = $database->prepare($query);
            $statement->execute([
                ':airportId' => $airportId
            ]);    
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
     
}
