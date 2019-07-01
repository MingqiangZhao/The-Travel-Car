<?php

require_once 'SModel.php';

class ModelOrderParking{
    private $orderId,$userId,$parkId,$carId,$days,$date,$price;
    public function __construct($orderId=NULL,$userId=NULL,$parkId=NULL,$carId=NULL,$days=NULL,$date=NULL,$price=NULL) {
        if(!is_null($orderId)){
            $this->orderId = $orderId;
            $this->userId = $userId;
            $this->parkId = $parkId;
            $this->carId = $carId;
            $this->days = $days;
            $this->date = $date;
            $this->price = $price;
        }
    }
    
    //getter
    public function getOrderId(){
        return $this->orderId;
    }
    
    public function getUserId(){
        return $this->userId;
    }
    
    public function getParkId(){
        return $this->parkId;
    }
    
    public function getCarId(){
        return $this->carId;
    }
    
    public function getDays(){
        return $this->days;
    }
    
    public function getDate(){
        return $this->date;
    }


    public function getPrice(){
        return $this->price;
    }
    
    //setter
    public function setOrderId($orderId){
        $this->orderId = $orderId;
    }
    
    public function setUserId($userId){
        $this->userId = $userId;
    }
    
    public function setParkId($parkId){
        $this->parkId = $parkId;
    }
    
    public function setCarId($carId){
        $this->carId = $carId;
    }
    
    public function setDays($days){
        $this->days = $days;
    }
    
    public function setDate($date){
        $this->date = $date;
    }


    public function setPrice($price){
        $this->price = $price;
    }
    
    public static function add_a_order($orderId,$userId,$parkId,$carId,$date,$begin,$end,$price){
        try {
            $database = SModel::getInstance();
            $query = "INSERT INTO order_parking(orderId,userId,parkId,carId,date,begin,end,price) VALUE (:orderId,:userId,:parkId,:carId,:date,:begin,:end,:price)";
            $statement = $database->prepare($query);           
            $statement->execute([
                ':orderId' => $orderId,
                ':userId' => $userId,
                ':parkId' => $parkId,
                ':carId' => $carId,
                ':date' => $date,
                ':begin' => $begin,
                ':end' => $end,
                ':price' => $price
               
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
            $query = "SELECT max(orderId) FROM order_parking";
            $statement = $database->prepare($query);
            $statement->execute();
            $idNumber = $statement->fetch();
            return $idNumber[0]+1;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function listUserOrder($userId){
        try {
            $database = SModel::getInstance();
            $query = "SELECT * FROM order_parking,parking_lot,airport WHERE airport.code = parking_lot.code AND "
                    . "parking_lot.parkId = order_parking.parkId AND order_parking.userId = :userId";
            $statement = $database->prepare($query);
            $statement->execute([
                ':userId' => $userId
            ]);
            $results = $statement->fetchAll();
            return $results;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function deleteUserOrder($orderId){
        try {
            $database = SModel::getInstance();
            $query = "DELETE FROM order_parking WHERE orderId=:orderId";
            $statement = $database->prepare($query);
            $statement->execute([
                ':orderId' => $orderId
            ]);
            return true;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function order_parking_list(){
        try {
            $database = SModel::getInstance();
            $query = "SELECT * FROM order_parking,parking_lot,airport WHERE airport.code = parking_lot.code AND "
                    . "parking_lot.parkId = order_parking.parkId ";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            return $results;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function car_parking_user($userId,$carId){
        try {
            $database = SModel::getInstance();
            $query = "SELECT * FROM order_parking WHERE userId=:userId AND carId=:carId";
            $statement = $database->prepare($query);
            $statement->execute([
                ':userId' => $userId,
                ':carId' => $carId
            ]);
            $results = $statement->fetchAll();
            return $results;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
}
