<?php
namespace App\Core;

abstract class AbstractUser {
    protected $databaseFile;
    protected $name;
    protected $email;
    protected $password;
    
    public function __construct($name, $email, $password) {
        $this->databaseFile = fopen("databaseFile.txt", "a"); 
        
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT); // Hashing password
        
        $userData = sprintf(
            "Name: %s, Email: %s, Password: %s\n",
            $this->name,
            $this->email,
            $this->password
        );
        
        fwrite($this->databaseFile, $userData);
        fclose($this->databaseFile);
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    // Force child classes to implement userRole()
    abstract public function userRole();
}
?>