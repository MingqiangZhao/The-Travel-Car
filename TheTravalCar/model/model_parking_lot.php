<?php

require_once 'SModel.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ModelParkingLot{
    private $parkId,$code,$label,$adress,$rest_places,$price_park;
    public function __construct($parkId=NULL,$code=NULL,$label=NULL,$adress=NULL,$rest_places=NULL,$price_park=NULL) {
        if(!is_null($parkId)){
            $this->parkId = $parkId;
            $this->code = $code;
            $this->label = $label;
            $this->adress = $adress;
            $this->rest_places = $rest_places;
            $this->price_park = $price_park;
        }
    }
    
    //getter
    public function getParkId(){
        return $this->parkId;
    }
    
    public function getCode(){
        return $this->code;
    }
    
    public function getLabel(){
        return $this->label;
    }
    
    public function getAdress(){
        return $this->adress;
    }
    
    public function getRest_places(){
        return $this->rest_places;
    }
    
    public function getPrice_park(){
        return $this->price_park;
    }
    
    //setter
    public function setParkId($parkId){
        $this->parkId = $parkId;
    }

    public function setCode($code){
        $this->code = $code;
    }
    
    public function setLabel($label){
        $this->label = $label;
    }
    
    public function setAdress($adress){
        $this->adress = $adress;
    }
    
    public function setRest_places($rest_places){    
        $this->rest_places = $rest_places;
    }
    
    public function setPrice_park($price_park){
        $this->price_park = $price_park;
    }
    
    public static function add_parking_lot($parkId,$code,$label,$adress,$rest_places,$price_park){
        try {
            $database = SModel::getInstance();
            $query = "INSERT INTO parking_lot(parkId,code,label,adress,rest_places,price_park) VALUE (:parkId,:code,:label,:adress,:rest_places,:price_park)";
            $statement = $database->prepare($query);           
            $statement->execute([
                'parkId' => $parkId,
                'code' => $code,
                'label' => $label,
                'adress' => $adress,
                'rest_places' => $rest_places,
                'price_park' => $price_park
               
            ]);
            return TRUE;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function updateInformation_restplaces($rest_places,$parkId){
        try{
            $database = SModel::getInstance();
            $query = "update parking_lot set rest_places = :rest_places where parkId=:parkId ";
            
            $statement = $database->prepare($query);
            $statement->execute([
                ':rest_places' => $rest_places,
                ':parkId' => $parkId
            ]);
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function updateInformation_price_park($price_park){
        try{
            $database = SModel::getInstance();
            $query = "update parking_lot set price_park = :price_park ";
            
            $statement = $database->prepare($query);
            $statement->execute([
                ':price_park' => $price_park
            ]);
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function idNumber(){
        try {
            $database = SModel::getInstance();
            $query = "SELECT max(parkId) FROM parking_lot";
            $statement = $database->prepare($query);
            $statement->execute();
            $idNumber = $statement->fetch();
            return $idNumber[0]+1;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function search_parking_lot($code){
        try {
            $database = SModel::getInstance();
            $query = "SELECT * FROM parking_lot,airport WHERE airport.code=:code AND parking_lot.code = airport.code AND rest_places>0";
            $statement = $database->prepare($query);
            $statement->execute([
                ':code' => $code
            ]);
            $results = $statement->fetchAll();
            return $results;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function parking_lot_info($parkId){
        try {
            $database = SModel::getInstance();
            $query = "SELECT * FROM parking_lot,airport WHERE parkId=:parkId AND parking_lot.code = airport.code AND rest_places>0";
            $statement = $database->prepare($query);
            $statement->execute([
                ':parkId' => $parkId
            ]);
            $results = $statement->fetch();
            return $results;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function parking_lot_list(){
        try{
            $database = SModel::getInstance();
            //echo $userId;
            
            $query = "SELECT * FROM parking_lot ";
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
    
    public static function delete_parking_lot($parkId){
        try {
            $database = SModel::getInstance();
            $query = "DELETE FROM parking_lot WHERE parkId=:parkId ";
            $statement = $database->prepare($query);
            $statement->execute([
                ':parkId' => $parkId
            ]);    
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    
}
