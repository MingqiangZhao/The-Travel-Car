<?php
//连接数据库
require_once 'SModel.php';

class ModelUser {
    private $userId,$username,$password,$name,$gender,$nationality,$wallet,$tag_isAdmin;

    // pas possible d'avoir 2 constructeurs
    public function __construct($userId=NULL,$username=NULL, $password=NULL,$name=NULL,$gender=NULL,$nationality=NULL,
            $wallet=NULL, $tag_isAdmin=NULL){
        // valeurs nulles si pas de passage de parametres
        if (!is_null($userId)) {
            $this->userId=$userId;
            $this->username=$username;
            $this->password=$password;
            $this->name=$name;
            $this->gender=$gender;
            $this->nationality=$nationality;      
            $this->wallet=$wallet;
            $this->tag_isAdmin=$tag_isAdmin;
            
        }
    }
    
    //gettter
    function setName($name){
        $this->name = $name;
    }
    
    function setUsername($username){
        $this->username = $username;
    }
    
    function setPassword($password){
        $this->password = $password;
    }
    
    function setTag_isAdmin($tag_isAdmin){
        $this->tag_isAdmin = $tag_isAdmin;
    }
    
    function setNationality($nationality){
        $this->nationality = $nationality;
    }
    
    function setUserId($userId){
        $this->userId = $userId;
    }
    
    function setWallet($wallet){
        $this->wallet = $wallet;
    }
    
    function setGender($gender){
        $this->gender = $gender;
    }
    
    //getter
    
    function getName(){
        return $this->name;
    }
    
    function getUsername(){
        return $this->username;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    function getTag_isAdmin(){
        return $this->tag_isAdmin;
    }
    
    function getNationality(){
        return $this->nationality;
    }
    
    function getUserId(){
        return $this->userId;
    }
    
    function getWallet(){
        return $this->wallet;
    }
    
    function getGender(){
        return $this->gender;
    }
    
    public function __toString() {
        return $this->userId;
    }
    
    public static function loginCheck($username,$password){
        try {
                $database = SModel::getInstance();
                $query ="SELECT username,password FROM user WHERE username = :username ";
                $statement = $database->prepare($query);
                $statement->execute(array(
                    ':username' => $username,
                 ));
                $results = $statement->fetch();

                if($password == $results['password']){
                    $isPasswordCorrect = true;
                }else{
                    $isPasswordCorrect = false;
                }

                if(!$results){
                    echo "Erreur dans la communication des données avec la DataBase";
                }else{
                    
                    return $isPasswordCorrect;
                }
                
                $statement->closeCursor();
                
                
            }catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function adminCheck($username,$password){
        try {
                $database = SModel::getInstance();
                $query ="SELECT is_Admin FROM user WHERE username = :username And password=:password";
                $statement = $database->prepare($query);
                $statement->execute(array(
                    ':username' => $username,
                    ':password' => $password
                 ));
                $results = $statement->fetch();
                return $results[0];
                
            }catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function inscription($userId,$username,$password,$name,$gender,$nationality,$wallet){
         try {
            $database = SModel::getInstance();
            $query = "INSERT INTO user(userId,username,password,name,gender,nationality,wallet) VALUE (:userId,:username,:password,:name,:gender,:nationality,:wallet)";
            $statement = $database->prepare($query);           
            $statement->execute([
                ':userId'=>$userId,
                ':username'=>$username,
                ':password'=>$password,
                ':name'=>$name,
                ':gender'=>$gender,
                ':nationality'=>$nationality,
                ':wallet'=>$wallet
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
            $query = "SELECT max(userId) FROM user";
            $statement = $database->prepare($query);
            $statement->execute();
            $idNumber = $statement->fetch();
            return $idNumber[0]+1;           
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function personalInfo($username,$password){
        try {
            $database = SModel::getInstance();
            $query = "SELECT * FROM user WHERE username = :username and password = :password";
            $statement = $database->prepare($query);
            $statement->execute([
                ':username' => $username,
                ':password' => $password
            ]);
            $results = $statement->fetch();
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function updateInformation($name,$value,$username,$password){
        try{
            $database = SModel::getInstance();
            
            switch ($name){
                case "name":
                    $query = "update user set name = :value where username = :username and password = :password ";
                    break;
                case "username": 
                    $query = "update user set username = :value where username = :username and password = :password ";
                    break;
                case "password":
                    $query = "update user set password = :value where username = :username and password = :password ";
                    break;
                case "gender":     
                    $query = "update user set gender = :value where username = :username and password = :password ";
                    break;
                case "nationality":
                    $query = "update user set nationality = :value where username = :username and password = :password ";
                    break;
                    
            }
            
            //$query = "update user set name = :value where username = :username and password = :password ";
               
            $statement = $database->prepare($query);
            $statement->execute([
                ':value' => $value,
                ':username'=> $username,
                ':password'=> $password
            ]);
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function updateWallet($price,$userId){
        try {
            $database = SModel::getInstance();
            $query = "update user set wallet = wallet+:price where userId = :userId ";
            $statement = $database->prepare($query);
            $statement->execute([
                ':price' => $price,
                ':userId' =>$userId
            ]);
            return true;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return FALSE;
        }
    }
    
    public static function userList(){
        try{
            $database = SModel::getInstance();
            //echo $userId;
            
            $query = "SELECT * FROM user ";
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
    
    public static function usernameList(){
        try{
            $database = SModel::getInstance();
            //echo $userId;
            
            $query = "SELECT username FROM user ";
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
    
