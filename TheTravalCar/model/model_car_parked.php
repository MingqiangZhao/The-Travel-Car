<?php

require_once 'SModel.php';

class ModelCarParked{
    private $parkId,$carId,$userId,$free_time_begin,$free_time_end,$car_parked_id;
    
    public function __construct( $parkId=NULL,$carId=NULL,$userId=NULL,$free_time_begin=NULL,$free_time_end=NULL,$car_parked_id) {
        if(is_null($parkId)&& is_null($carId)){
            $this->parkId = $parkId;
            $this->carId = $carId;
            $this->userId = $userId;
            $this->free_time_begin = $free_time_begin;
            $this->free_time_end = $free_time_end;
            $this->car_parked_id = $car_parked_id;
        }
    }
    
    //setter
    public function setParkId($parkId){
        $this->parkId = $parkId;
    }
    
    public function setCarId($carId){
        $this->carId = $carId;
    }
    
    public function setUserId($userId){
        $this->userId = $userId;
    }
    
    public function setFree_time_begin($free_time_begin){
        $this->free_time_begin = $free_time_begin;
    }
    
    public function setFree_time_end($free_time_end){
        $this->free_time_end = $free_time_end;
    }
    
    public function setCar_parked_id($car_parked_id){
        $this->car_parked_id = $car_parked_id;
    }


    //getter
    public function getParId(){
        return $this->parkId;
    }
    
    public function getCarId(){
        return $this->carId;
    }
    
    public function getUserId(){
        return $this->userId;
    }
    
    public function getFree_time_begin(){
        return $this->free_time_begin;
    }
    
    public function getFree_time_end(){
        return $this->free_time_end;
    }
    
    public function getCar_parked_id(){
        return $this->car_parked_id;
    }


    public static function add_parking_car($parkId,$carId,$userId,$free_time_begin,$free_time_end,$car_parked_id){
        try {
            $database = SModel::getInstance();
            $query = "INSERT INTO car_parked(parkId,carId,userId,free_time_begin,free_time_end,car_parked_id) VALUE (:parkId,:carId,:userId,:free_time_begin,:free_time_end,:car_parked_id)";
            $statement = $database->prepare($query);           
            $statement->execute([
                ':parkId' => $parkId,
                ':carId' => $carId,
                ':userId' => $userId,
                ':free_time_begin' => $free_time_begin,
                ':free_time_end' => $free_time_end,
                ':car_parked_id' => $car_parked_id
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
            $query = "SELECT max(car_parked_id) FROM car_parked";
            $statement = $database->prepare($query);
            $statement->execute();
            $idNumber = $statement->fetch();
            return $idNumber[0]+1;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function delete_parking_car($parkId,$carId){
         try {
            $database = SModel::getInstance();
            $query = "DELETE FROM car_parked WHERE parkId = :parkId AND carId= :carId";
            $statement = $database->prepare($query);           
            $statement->execute([
                ':parkId' => $parkId,
                ':carId' => $carId
            ]);
            return TRUE;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function delete_redundancy(){
        try {
            $database = SModel::getInstance();
            $query = "DELETE FROM car_parked WHERE free_time_begin=free_time_end";
            $statement = $database->prepare($query);           
            $statement->execute();
            
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function delete_renting($car_parked_id){
        try {
            $database = SModel::getInstance();
            $query = "DELETE FROM car_parked WHERE car_parked_id=:car_parked_id";
            $statement = $database->prepare($query);           
            $statement->execute([
                ':car_parked_id' => $car_parked_id
            ]);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }

    public static function updateInformation($free_time_begin,$free_time_end){
        try {
            $database = SModel::getInstance();
            $query = "UPDATE car_parked SET free_time_begin = :free_time_begin AND free_time_end= :free_time_end";
            $statement = $database->prepare($query);           
            $statement->execute([
                ':free_time_begin' => $free_time_begin,
                ':free_time_end' => $free_time_end
            ]);
            return TRUE;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function search_rent_car($code,$departure,$return,$userId){
         try {
            $database = SModel::getInstance();
            $query = "SELECT * FROM car_parked,parking_lot,airport,car WHERE airport.code=:code AND parking_lot.code = airport.code AND car_parked.parkId=parking_lot.parkId AND car.carId=car_parked.carId AND"
                    . " car_parked.userId <> :userId AND free_time_begin<= :departure AND free_time_end>=:return ";
            $statement = $database->prepare($query);
            $statement->execute([
                ':code' => $code,
                ':userId' => $userId,
                ':departure' => $departure,
                ':return' => $return
            ]);
            $results = $statement->fetchAll();
            return $results;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function car_parked_info($car_parked_id){
        try {
            $database = SModel::getInstance();
            $query ="SELECT * FROM car_parked,parking_lot,airport,car WHERE parking_lot.code = airport.code AND car_parked.parkId=parking_lot.parkId AND car.carId=car_parked.carId AND "
                    . "car_parked.car_parked_id = :car_parked_id";
            $statement = $database->prepare($query);
            $statement->execute([
                ':car_parked_id' => $car_parked_id
            ]);
            $results = $statement->fetch();
            return $results;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }

    public static function union($userId,$parkId,$carId){
        try {
            $database = SModel::getInstance();
            $query = "SELECT c1.free_time_begin,c2.free_time_end,c1.car_parked_id as id1,c2.car_parked_id as id2 FROM car_parked as c1 ,car_parked as c2 "
                    . "WHERE c1.free_time_end=c2.free_time_begin AND (c1.parkId=:parkId AND c1.carId=:carId AND c1.userId=:userId"
                    . " AND c2.parkId= c1.parkId AND c2.carId=c1.carId AND c2.userId=c1.userId" 
                    . ");";
            $statement = $database->prepare($query);
            $statement->execute([
                ':userId' => $userId,
                ':parkId'=> $parkId,
                 ':carId' => $carId,
            ]);
            $results = $statement->fetch();
           return $results;
       
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        }
    }
    
    public static function car_parked_list(){
        try{
            $database = SModel::getInstance();
            //echo $userId;
            
            $query = "SELECT * FROM car_parked ";
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

