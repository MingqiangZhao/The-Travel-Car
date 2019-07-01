<?php

require_once 'SModel.php';

class ModelCar{
    private $carId,$carName,$userId,$seats,$doors,$cost_rent;
    public function __construct($carId=NULL,$carName=NULL,$userId=NULL,$seats=NULL,$doors=NULL,$cost_rent=NULL) {
        if(!is_null($carId)){
            $this->carId = $carId;
            $this->carName = $carName;
            $this->userId = $userId;
            $this->seats = $seats;
            $this->doors = $doors;
            $this->cost_rent = $cost_rent;
        }
    }
    
    //setter
    public function setCarId($carId){
        $this->carId = $carId;
    }
    
    public function setCarName($carName){
        $this->carName = $carName;
    }
    
    public function setUserId($userId){
        $this->userId = $userId;
    }
    
    public function setSeats($seats){
        $this->seats = $seats;
    }
    
    public function setDoors($doors){
        $this->doors = $doors;
    }
    
    public function setCost_rent($cost_rent){
        $this->cost_rent = $cost_rent;
    }
    
    //getter
    
    public function getCarId(){
        return $this->carId;
    }
    
    public function getCarName(){
        return $this->carName;
    }
    
    public function getUserId(){
        return $this->userId;
    }
    
    public function getSeats(){
        return $this->seats;
    }
    
    public function getDoors(){
        return $this->doors;
    }
    
    public function getCost_rent(){
        return $this->cost_rent;
    }
    
    public static function car_inscription($carId,$carName,$userId,$seats,$doors,$cost_rent,$default_car){
        try {
            $database = SModel::getInstance();
            $query = "INSERT INTO car(carId,carName,userId,seats,doors,cost_rent,default_car) VALUE (:carId,:carName,:userId,:seats,:doors,:cost_rent,:default_car)";
            $statement = $database->prepare($query);               
            $statement->execute([
                ':carId' => $carId,
                ':carName'=> $carName,
                ':userId'=> $userId,
                ':seats'=> $seats,
                ':doors'=> $doors,
                ':cost_rent'=> $cost_rent,
                ':default_car' => $default_car
            ]);
            
            return TRUE;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function idNumber(){
        try {
            $database = SModel::getInstance();
            $query = "SELECT max(carId) FROM car";
            $statement = $database->prepare($query);
            $statement->execute();
            $idNumber = $statement->fetch();
            return $idNumber[0]+1;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function hasCar_Check($userId){
        try{
            $database = SModel::getInstance();
            //echo $userId;
            
            $query = "SELECT * FROM car WHERE userId = :userId And default_car=true";
            $statement = $database->prepare($query);
            $statement->execute([
                ':userId' => $userId
            ]);
            $results = $statement->fetch();
            //print_r($results);
            
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function updateInformation($name,$value,$carId){
        try{
            $database = SModel::getInstance();
            
            switch ($name){
                case "carName":
                    $query = "update car set carName = :value where carId =:carId ";
                    break;
                case "seats": 
                    $query = "update car set seats = :value where carId = :carId ";
                    break;
                case "doors":
                    $query = "update car set doors = :value where carId = :carId ";
                    break;
                case "cost_rent":     
                    $query = "update car set cost_rent = :value where carId = :carId ";
                    break;
                
            }
               
            $statement = $database->prepare($query);
            $statement->execute([
                ':value' => $value,
                'carId' => $carId
            ]);
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function updateDefaultCar($carId,$userId){
        try{
            $database = SModel::getInstance();
            //echo $userId;
            
            $query = "update car set default_car = 0 where userId=:userId;"
                    . "update car set default_car = 1 where carId=:carId";
            $statement = $database->prepare($query);
            $statement->execute([
                ':userId' => $userId,
                ':carId' => $carId
            ]);
            return TRUE;
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function userCar($userId){
        try{
            $database = SModel::getInstance();
            //echo $userId;
            
            $query = "SELECT * FROM car WHERE userId = :userId ";
            $statement = $database->prepare($query);
            $statement->execute([
                ':userId' => $userId
            ]);
            $results = $statement->fetchAll();
            //print_r($results);
            
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function carList(){
        try{
            $database = SModel::getInstance();
            //echo $userId;
            
            $query = "SELECT * FROM car  ";
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
    
    
}
