<?php
namespace App\Core;
use PDO;
abstract class AbstractUser {
protected $name;
protected $email;
protected $password;
public function __construct($name, $email, $password) {
$this->name = $name;
$this->email = $email;
$this->password = password_hash($password, PASSWORD_DEFAULT); //Hashing password
$this->saveToDatabase();
}
public function getName() {
return $this->name;
}
public function getEmail() {
return $this->email;
}

private function saveToDatabase(){
  $adress="localhost";
	$user= "root";
	$pass= "";
	$database="2skirius_db";
  $conn = new PDO("mysql:host=$adress;dbname=$database", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $email=$this->email;
	$name=$this->name;
	$password=$this->password;
	//print ($email." ");
	$sql="INSERT INTO users (email, name, password) VALUES ('".$email."','".$name."','".$password."')";
  $conn->exec($sql);
}

// Force child classes to implement userRole()
abstract public function userRole();
}
?>