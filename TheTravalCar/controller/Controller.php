<?php
require_once '../model/model_user.php';
require_once '../model/model_car.php';
require_once '../model/model_parking_lot.php';
require_once '../model/model_car_parked.php';
require_once '../model/model_order_parking.php';
require_once '../model/model_order_renting.php';
require_once '../model/model_airport.php';

class Controller {
    public static function loginCheck(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        //echo $username;
        $results = ModelUser::loginCheck($username,$password);
        if($results){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $is_AdMin = ModelUser::adminCheck($username, $password);
            //echo $is_AdMin;
            if($is_AdMin==1){
                header('location:../view/view_manager.php');
                exit();
            }
        }
        else {
            echo 'Mauvais identifiant ou mot de passe !';
            header('Refresh:2,url=../view/view_login.php');
        }
        if ($is_AdMin==0){
            header("location: ../view/view_home.php");
            exit();
        }
        
        
    }
    
    public static function inscription(){
        $userId = ModelUser::idNumber();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $usernameList = ModelUser::usernameList();
        foreach ($usernameList as $element){
            if($username==$element['username']){
                echo '<script>alert("This username has already existed !")</script>';
                header('Refresh:1,url=../view/view_sign_up.php');
                exit();
            }
        }
        $results = ModelUser::inscription ($userId,$username,$password,$_POST['name']
                ,$_POST['gender'],$_POST['nationality'],$_POST['wallet']);
        if($results){
            require '../view/view_home.php';
        }
    }
    
    public static function logout(){
        $_SESSION = array();
        session_destroy();
        header("location: ../view/view_home.php");
    }
    
    public static function personalInfo(){
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $results = ModelUser::personalInfo($username,$password);
        //print_r($results);
        if(!$results['is_Admin']){
            $_SESSION['userId'] = $results['userId'];
            $_SESSION['username'] = $results['username'];
            $_SESSION['password'] = $results['password'];
            $_SESSION['name'] = $results['name'];
            $_SESSION['gender'] = $results['gender'];
            $_SESSION['nationality'] = $results['nationality'];
            $_SESSION['wallet'] = $results['wallet'];
        } else {
            header("location:../view/view_login.php");
        }
    }
    
    public static function userHome(){
        Controller::personalInfo();
        header("location: ../view/view_myaccount.php");
    }
    
    public static function userInfo(){
        Controller::personalInfo();
        header("location: ../view/view_personalInfo.php");
    }
    
    public static function userUpdateInformation(){
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $name = (string)$_POST['name'];
        $value = $_POST['value'];
        
        $results=ModelUser::updateInformation($name, $value,$username,$password);
        if($results){
            if($name=="username"){
                $_SESSION['username']=$value;
            }else if($name=="password"){
                $_SESSION['password']=$value;
            }
        }
        Controller::userInfo();
    }
    
    public static function userCar(){
         Controller::personalInfo();
         header("location: ../view/view_carInfo.php");
    }
    
    public static function add_a_car(){
        Controller::personalInfo();
        $carId = ModelCar::idNumber();
        $userId = $_SESSION['userId'];
        $carName = $_POST['carName'];
        $seats = $_POST['seats'];
        $doors = $_POST['doors'];
        $cost_rent = $_POST['cost_rent'];
        $default_car = 1;
        ModelCar::car_inscription($carId, $carName, $userId, $seats, $doors, $cost_rent, $default_car);
        Controller::carInfo();
    }
    
    public static function add_new_car(){
        Controller::personalInfo();
        $carId = ModelCar::idNumber();
        $userId = $_SESSION['userId'];
        $carName = $_POST['carName'];
        $seats = $_POST['seats'];
        $doors = $_POST['doors'];
        $cost_rent = $_POST['cost_rent'];
        $default_car = 0;
        ModelCar::car_inscription($carId, $carName, $userId, $seats, $doors, $cost_rent, $default_car);
        header("location:../view/view_carInfo.php");

    }
    
    public static function getCarInfo(){
        Controller::personalInfo();
        $userId = $_SESSION['userId'];
        $results = ModelCar::hasCar_Check($userId);
        //print_r($results);
        if($results){
            $_SESSION['carId'] = $results['carId'];
            $_SESSION['carName'] = $results['carName'];
            $_SESSION['seats'] = $results['seats'];
            $_SESSION['doors'] = $results['doors'];
            $_SESSION['cost_rent'] = $results['cost_rent'];
            //print_r($results);
            //require 'view_carInfo.php';
        }else{
            echo '<script>alert("You have to add a car ")</script>';
            header("location:../view/view_car_inscription.php");
        }
    }
    
    public static function carInfo(){
        echo 'TEST';
        Controller::getCarInfo();
        require '../view/view_carInfo.php';
    }

    public static function carUpdateInformation(){
        Controller::personalInfo();
        $name = (string)$_POST['name'];
        $value = $_POST['value'];
        $carId = $_SESSION['carId'];
        $results= ModelCar::updateInformation($name, $value,$carId);
        if($results){
            Controller::carInfo();
        }
    }
    public static function setDefaultCar(){
        Controller::personalInfo();
        $userId = $_SESSION['userId'];
        $results = ModelCar::userCar($userId);
        require '../view/view_change_default_car.php';
    }
    
    public static function updateDefaultCar(){
        Controller::personalInfo();
        $userId = $_SESSION['userId'];
        $carId = $_POST['carId'];
        $results = ModelCar::updateDefaultCar($carId, $userId);
        if($results){
            Controller::carInfo();
        }
    }


    //parking 
    public static function parking(){
        Controller::personalInfo();
        Controller::getCarInfo();
        $parkId = $_SESSION['parkId'];
        $carId = $_SESSION['carId'];
        $userId = $_SESSION['userId'];
        $free_time_begin = $_SESSION['free_time_begin'];
        $free_time_end = $_SESSION['free_time_end'];
        $car_parked_id = ModelCarParked::idNumber();
        ModelCarParked::add_parking_car($parkId, $carId, $userId, $free_time_begin, $free_time_end,$car_parked_id);
        //header("location: view_home.php");
    }
    
    public static function search_parking_lot(){
        Controller::personalInfo();
        Controller::getCarInfo();
        
        $userId = $_SESSION['userId'];
        $carId = $_SESSION['carId'];
        $code = $_POST['code'];      
        
        $free_time_begin = $_POST['free_time_begin'];
        $free_time_end = $_POST['free_time_end'];
        $_SESSION['free_time_begin'] = $free_time_begin;
        $_SESSION['free_time_end'] = $free_time_end;
        //echo 'TEST';
        if(strcmp($_POST['free_time_begin'],$_POST['free_time_end'])==-1&&strcmp($free_time_begin,date('Y-m-d'))>=0){
            
            $results = ModelOrderParking::car_parking_user($userId, $carId);
            //print_r($results);
            if($results){
                foreach ($results as $element){
                    $lower = $element['begin'];
                    $higher = $element['end'];
                    if((strcmp($lower,$free_time_end)==1||strcmp($free_time_begin,$higher)==1)){
                        //echo "TEST";
                        $results=ModelParkingLot::search_parking_lot($code);

                        //print_r($_SESSION);
                        //print_r($results);
                        require '../view/view_result_park.php';
                    }else{
                        echo '<script>alert("You has already parked your car during this period")</script>';
                        header('Refresh:1,url=../view/view_park.php');
                        exit();
                    }
                }
            }else{
                $results=ModelParkingLot::search_parking_lot($code);
                //echo 'TEST';
                //print_r($results);
                require '../view/view_result_park.php';
            }
            
        }else{
            echo '<script>alert("Date input error ! ")</script>';
            echo "<script type='text/javascript'>history.go(-1)</script>";
        }
    }
    
    public static function confirm_order_park(){
        Controller::personalInfo();
        Controller::getCarInfo();
        $dateBegin = $_SESSION['free_time_begin'];
        $dateEnd = $_SESSION['free_time_end'];
        /*echo $dateBegin;
        echo'<br>';
        echo $dateEnd;
        echo '<br>';*/
        $datetime1 = new DateTime($dateBegin);
        $datetime2 = new DateTime($dateEnd);
        $interval = $datetime1->diff($datetime2)->format('%a');
        //echo $interval;
        
        $_SESSION['days'] = $interval;
        
        $parkId = $_POST['parkId'];
        $_SESSION['parkId'] = $parkId;
        
        $results = ModelParkingLot::parking_lot_info($parkId);
        
        require '../view/view_confirm_order_park.php';
    }

    
    public static function add_order_park(){
        Controller::personalInfo();
        Controller::getCarInfo();
        
        Controller::parking();
        
        $orderId = ModelOrderParking::idNumber();
        $userId = $_SESSION['userId'];
        $parkId = $_SESSION['parkId'];
        $carId = $_SESSION['carId'];
        $date = $_POST['date'];
        $begin = $_POST['begin'];
        $end = $_POST['end'];
        $price = $_POST['price'];
        $wallet = $_SESSION['wallet']-$price;
        
        if($wallet>=0){
            ModelOrderParking::add_a_order($orderId, $userId, $parkId, $carId, $date, $begin, $end, $price);
            if($_POST['rest_places']!=0){
                $rest_places = $_POST['rest_places']-1;
            }else{
                $rest_places = 0;
            }

            ModelParkingLot::updateInformation_restplaces($rest_places, $parkId);
            ModelUser::updateWallet(-$price, $userId);
            header("location:../view/view_park.php");
        }else{
            echo '<script>alert("Your balance is insufficient,please recharge ! ")</script>';
            header('Refresh:1,url=../view/view_park.php');
        }
        
    }
    
    public static function myOrderList(){
        Controller::personalInfo();
        //Controller::getCarInfo();
        $userId = $_SESSION['userId'];
        $results_park = ModelOrderParking::listUserOrder($userId);
        $results_rent = ModelOrderRenting::listClientOrder($userId);
        require '../view/view_my_order.php';
        
    }
    
    public static function cancelMyOrder_park(){
        Controller::personalInfo();
        Controller::getCarInfo();
        $orderId = $_POST['orderId'];
        $price = $_POST['price'];
        $wallet = $_SESSION['wallet']+$price/2;
        $userId = $_SESSION['userId'];
        $carId = $_SESSION['carId'];
        $parkId = $_POST['parkId'];
        $rest_places = $_POST['rest_places']+1;
        ModelUser::updateWallet($price/2, $userId);
        //echo "TEST";
        //echo "<br>";
        ModelOrderParking::deleteUserOrder($orderId);
        //ModelOrderRenting::deleteOrder();
        ModelCarParked::delete_parking_car($parkId, $carId);
        ModelParkingLot::updateInformation_restplaces($rest_places, $parkId);
        Controller::myOrderList();
        
    }
    
    
    
    public static function search_rent_car(){
        Controller::personalInfo();
        //Controller::getCarInfo();
        
        $userId = $_SESSION['userId'];
        $code = $_POST['code'];
        $departure = $_POST['departure'];
        $return = $_POST['return'];
        
        if(strcmp($departure,$return)==-1){
            $_SESSION['departure'] = $departure;
            $_SESSION['return'] = $return;
            $results= ModelCarParked::search_rent_car($code,$departure,$return,$userId);
           // print_r($results);
            //echo $departure;
            //echo $return;
            require '../view/view_result_rent.php';
        }else{
            echo '<script>alert("Beginning time must before ending time! ")</script>';
            echo "<script type='text/javascript'>history.go(-1)</script>";
        }
        
    }
    
    public static function confirm_order_rent(){
        Controller::personalInfo();
        Controller::getCarInfo();
        $carId = $_SESSION['carId'];
        $dateBegin = $_SESSION['departure'];
        $dateEnd = $_SESSION['return'];
        /*echo $dateBegin;
        echo'<br>';
        echo $dateEnd;
        echo '<br>';*/
        $datetime1 = new DateTime($dateBegin);
        $datetime2 = new DateTime($dateEnd);
        $interval = $datetime1->diff($datetime2)->format('%a');
        //echo $interval;
        
        $_SESSION['days'] = $interval;
        
        $car_parked_id = $_POST['car_parked_id'];
        $_SESSION['car_parked_id'] = $car_parked_id;
        
        $results = ModelCarParked::car_parked_info($car_parked_id);
        require '../view/view_confirm_order_rent.php';
    }
    
    public static function add_order_rent(){
        Controller::personalInfo();
        Controller::getCarInfo();
        
        
        $orderId = ModelOrderRenting::idNumber();
        $ownerId = $_POST['ownerId'];
        $clientId = $_SESSION['userId'];
        $parkId = $_POST['parkId'];
        $carId = $_POST['carId'];
        $date = $_POST['date'];
        $price = $_POST['price'];
        $wallet = $_SESSION['wallet']-$price;
        
        $free_time_begin = $_POST['free_time_begin'];
        $free_time_end = $_POST['free_time_end'];
        
        $departure = $_SESSION['departure'];
        $return = $_SESSION['return'];
        $userId = $ownerId;
       
        echo $carId;
        if($wallet>=0){
               if((!strcmp($free_time_begin,$departure)&&!strcmp($free_time_end,$return))){
                    //echo 'TEST';
                    ModelOrderRenting::add_a_order($orderId, $ownerId, $clientId, $parkId, $carId, $date, $departure, $return, $price);
                    //echo 'TEST';

                    $car_parked_id = ModelCarParked::idNumber();
                    ModelCarParked::add_parking_car($parkId, $carId, $userId, $free_time_begin, $departure, $car_parked_id);

                    $car_parked_id = ModelCarParked::idNumber();
                    ModelCarParked::add_parking_car($parkId, $carId, $userId, $return, $free_time_end, $car_parked_id);

                    ModelCarParked::delete_redundancy();

                    $car_parked_id = $_SESSION['car_parked_id'];
                    ModelCarParked::delete_renting($car_parked_id);
                    
                }else{
                    //parking lot update rest places
                    ModelOrderRenting::add_a_order($orderId, $ownerId, $clientId, $parkId, $carId, $date, $departure, $return, $price);
                    //echo 'TEST';

                    $car_parked_id = ModelCarParked::idNumber();
                    ModelCarParked::add_parking_car($parkId, $carId, $userId, $free_time_begin, $departure, $car_parked_id);

                    $car_parked_id = ModelCarParked::idNumber();
                    ModelCarParked::add_parking_car($parkId, $carId, $userId, $return, $free_time_end, $car_parked_id);

                    ModelCarParked::delete_redundancy();

                    $car_parked_id = $_SESSION['car_parked_id'];
                    ModelCarParked::delete_renting($car_parked_id);
                }
                ModelUser::updateWallet(-$price, $clientId);
                ModelUser::updateWallet($price, $ownerId);
                header("location:../view/view_rent.php");
        }else{
            echo '<script>alert("Your balance is insufficient,please recharge ! ")</script>';
            header('Refresh:1,url=../view/view_park.php');
        }
        
    }
    
    public static function cancelMyOrder_rent(){
        Controller::personalInfo();
        Controller::getCarInfo();
        $orderId = $_POST['orderId'];
        $price = $_POST['price'];
        $wallet = $_SESSION['wallet']+$price/2;
        
        $userId = $_SESSION['userId'];
        $ownerId = $_POST['ownerId'];
        $carId = $_POST['carId'];
       
        $parkId = $_POST['parkId'];
        $departue_date = $_POST['departure_date'];
        $return_date = $_POST['return_date'];
        ModelUser::updateWallet($price/2, $userId);
        //echo "TEST";
        //echo "<br>";
        ModelOrderRenting::deleteUserOrder($orderId);
        
        echo $carId;
        $car_parked_id = ModelCarParked::idNumber();
        ModelCarParked::add_parking_car($parkId, $carId, $ownerId, $departue_date, $return_date, $car_parked_id);
        
        //echo $userId;
        //echo $ownerId;
        //echo $carId;
        //echo $parkId;
        $results = ModelCarParked::union($ownerId, $parkId, $carId);
        //print_r($results);
        while($results){
            ModelCarParked::delete_renting($results['id1']);
            ModelCarParked::delete_renting($results['id2']);
            $car_parked_id = ModelCarParked::idNumber();
            ModelCarParked::add_parking_car($parkId, $carId, $ownerId, $results['free_time_begin'], $results['free_time_end'], $car_parked_id);
            $results = ModelCarParked::union($ownerId, $parkId, $carId);
        }
        
        Controller::myOrderList();
        
    }
    
    public static function userPayments(){
        Controller::personalInfo();
        header("location:../view/view_payments.php");
    }
    
    public static function recharge(){
        Controller::personalInfo();
        $userId = $_SESSION['userId'];
        $money = $_POST['money'];
        if($money>0){
            ModelUser::updateWallet($money, $userId);
            //echo '<script>alert("You have logged in ")</script>';
            Controller::userPayments();
        }else{
            echo '<script>alert("Input error ! The recharge amount must be more than 0 ")</script>';
            header('Refresh:1,url=../view/view_payments.php');
        }
        
    }
    
    //administrater
    
    public static function userList(){
        $userList = ModelUser::userList();
        //print_r($userList);
        require '../view/view_userList.php';
    }
    
    public static function carList(){
        $carList = ModelCar::carList();
        //print_r($carList);
        require '../view/view_carList.php';
    }

    public static function car_parked_list(){
        $car_parked_list = ModelCarParked::car_parked_list();
        //print_r($car_parked_list);
        require '../view/view_carParkedList.php';
    }

    public static function allOrderList(){
        $order_parking_list = ModelOrderParking::order_parking_list();
        $order_renting_list = ModelOrderRenting::order_renting_list();
        require '../view/view_orderList.php';
    }
    
    public static function operationAirport(){
        $airportList = ModelAirport::airportList();
        require '../view/view_airportList.php';
    }
    
    public static function operationParkingLot(){
        $parking_lot_list = ModelParkingLot::parking_lot_list();
        require '../view/view_parkingLotList.php';
    }
    
    public static function delete_parking_lot(){
        $parkId = $_POST['parkId'];
        //echo $parkId;
        ModelParkingLot::delete_parking_lot($parkId);
        Controller::operationParkingLot();
    }
    
    public static function add_parking_lot(){
        $parkId = ModelParkingLot::idNumber();
        $code = $_POST['code'];
        $label = $_POST['label'];
        $adress = $_POST['adress'];
        $rest_places = $_POST['rest_places'];
        $price_park = $_POST['price_park'];
        ModelParkingLot::add_parking_lot($parkId, $code, $label, $adress, $rest_places, $price_park);
        Controller::operationParkingLot();
        
    }
    
     public static function delete_airport(){
        $airportId = $_POST['airportId'];
        //echo $parkId;
        ModelAirport::delete_airport($airportId);
        Controller::operationAirport();
    }
    
    public static function add_airport(){
        $airportId = ModelAirport::idNumber();
        $code = $_POST['code'];
        $name = $_POST['name'];
        $country = $_POST['country'];
        //echo 'TEST';
        ModelAirport::add_airport($airportId, $code, $name, $country);
        Controller::operationAirport();
        
    }
     
}

