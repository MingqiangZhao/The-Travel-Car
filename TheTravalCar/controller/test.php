<?php
session_start();
require_once '../model/model_car_parked.php';

$parkId = 0;
$carId = 1;
$userId = 1;
//ModelCarParked::union($userId, $parkId, $carId);
echo $_SESSION['userId'];