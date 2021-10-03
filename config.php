<?php

$smtpUsername = ' '; #SMTP Username
$smtpPassword = ' '; #SMTP Password
$emailFrom = ' '; #Set from Email Address
$emailFromName = ''; #Set from Address Name
$smtpHost = 'smtp.gmail.com'; #SMTP HOST - Currently Set to Gmail
$smtpPort = 587; #SMTP Port

class Database {
    
    private $db_host = '127.0.0.1';
    private $db_name = 'magicLogin';
    private $db_username = 'root';
    private $db_password = '';

    public function dbConnection(){
        
        try {
            $connect = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,$this->db_username,$this->db_password);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connect;
        }
        catch (PDOException $e){
            echo "Connection error ".$e->getMessage(); 
            exit;
        }
        
        
    }
}
