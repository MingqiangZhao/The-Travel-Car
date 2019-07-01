<?php
require_once 'SModel.php';

class ModelOrderRenting{
    private $orderId,$ownerId,$clientId,$parkId,$carId,$date,$departure_date,$return_date,$days,$price;
    public function __construct($orderId=NULL,$ownerId=NULL,$clientId=NULL,$parkId=NULL,$carId=NULL,$date=NULL,$departure_date=NULL,$return_date=NULL,$price=NULL) {
        if(!is_null($orderId)){
            $this->orderId = $orderId;
            $this->ownerId = $ownerId;
            $this->clientId = $clientId;
            $this->parkId = $parkId;
            $this->carId = $carId;
            $this->date = $date;
            $this->departure_date = $departure_date;
            $this->return_date = $return_date;
            $this->price = $price;
        }
    }
    
    //getter
    public function getOrderId(){
        return $this->orderId;
    }
    
    public function getOwnerId(){
        return $this->ownerId;
    }
    
    public function getClientId(){
        return $this->clientId;
    }

    public function getParkId(){
        return $this->parkId;
    }
    
    public function getCarId(){
        return $this->carId;
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
   
    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
    }
    
    public function setClientId($clientId){
        $this->clientId = $clientId;
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
    
     public static function add_a_order($orderId,$ownerId,$clientId,$parkId,$carId,$date,$departure_date,$return_date,$price){
        try {
            $database = SModel::getInstance();
            $query = "INSERT INTO order_renting(orderId,ownerId,clientId,parkId,carId,date,departure_date,return_date,price)"
                    . " VALUE (:orderId,:ownerId,:clientId,:parkId,:carId,:date,:departure_date,:return_date,:price)";
            $statement = $database->prepare($query);           
            $statement->execute([
                ':orderId' => $orderId,
                ':ownerId' => $ownerId,
                ':clientId' => $clientId,
                ':parkId' => $parkId,               
                ':carId' => $carId,
                ':date' => $date,
                ':departure_date' => $departure_date,
                ':return_date' => $return_date,
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
            $query = "SELECT max(orderId) FROM order_renting";
            $statement = $database->prepare($query);
            $statement->execute();
            $idNumber = $statement->fetch();
            return $idNumber[0]+1;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function listClientOrder($clientId){
        try {
            $database = SModel::getInstance();
            $query = "SELECT * FROM order_renting,parking_lot,airport,user,car WHERE airport.code = parking_lot.code AND "
                    . "parking_lot.parkId = order_renting.parkId AND order_renting.clientId = :clientId AND user.userId=ownerId AND "
                    . "user.userId=car.userId AND car.carId=order_renting.carId";
            $statement = $database->prepare($query);
            $statement->execute([
                ':clientId' => $clientId
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
            $query = "DELETE FROM order_renting WHERE orderId=:orderId";
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
    
    public static function order_renting_list(){
        try {
            $database = SModel::getInstance();
            $query = "SELECT * FROM order_renting,parking_lot,airport,user,car WHERE airport.code = parking_lot.code AND "
                    . "parking_lot.parkId = order_renting.parkId AND user.userId=ownerId AND "
                    . "user.userId=car.userId";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            return $results;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
}

