<?php

//import config file
include ("Config.php");

class Connection{


    private $conn;

    /**
        * this function used to create database, tables
        * @return mysqli
        */
    public function Connect(){

        //connect to database
        $this->conn = new mysqli(SERVERNAME, USER, PASSWORD);
		
		if(!$this->conn->connect_error){
			//create database
			$createDb = "CREATE DATABASE IF NOT EXISTS Phonebook";
			if(mysqli_query($this->conn, $createDb) == TRUE){
				mysqli_select_db($this->conn, "Phonebook");
				$contactTable = "CREATE TABLE IF NOT EXISTS CONTACT(
								Contact_id INT(25) AUTO_INCREMENT PRIMARY KEY,
								Fname VARCHAR(50) NOT NULL,Mname VARCHAR(50),Lname VARCHAR(50)									
								)";
				$addressTable = "CREATE TABLE IF NOT EXISTS ADDRESS(
								Address_id INT(25) AUTO_INCREMENT PRIMARY KEY,
								Contact_id INT(25),
								FOREIGN KEY (Contact_id) REFERENCES CONTACT(Contact_id),
								Address_Type VARCHAR(10),Address VARCHAR(50) NOT NULL,City VARCHAR(50),
								State VARCHAR(50),Zip VARCHAR(50)
								)";
                $workTable = "CREATE TABLE IF NOT EXISTS WORK(
								Work_id INT(25) AUTO_INCREMENT PRIMARY KEY,
								Contact_id INT(25),
								FOREIGN KEY (Contact_id) REFERENCES CONTACT(Contact_id),
								Address_Type VARCHAR(10),Address VARCHAR(50) NOT NULL,City VARCHAR(50),
								State VARCHAR(50),Zip VARCHAR(50)
								)";
				$phoneTable = "CREATE TABLE IF NOT EXISTS PHONE(
								Phone_id INT(25) AUTO_INCREMENT PRIMARY KEY,
								Contact_id INT(25),
								FOREIGN KEY (Contact_id) REFERENCES CONTACT(Contact_id),
								Phone_Type VARCHAR(10),Area_code Int(3),Cell_Phone VARCHAR(15),
								Home_Phone VARCHAR(15),Work_Phone VARCHAR(15)					
								)";
				$dateTable = "CREATE TABLE IF NOT EXISTS DATE(
								Date_id Int(25) AUTO_INCREMENT PRIMARY KEY,
								Contact_id INT(25),
								FOREIGN KEY (Contact_id) REFERENCES CONTACT(Contact_id),
								Date_Type VARCHAR(10),Date VARCHAR(50) NOT NULL			
								)";
								
				//query to create tables
				if(mysqli_query($this->conn, $contactTable) && mysqli_query($this->conn, $addressTable) && mysqli_query($this->conn, $phoneTable) && mysqli_query($this->conn, $dateTable) && mysqli_query($this->conn, $workTable)){
					//success
					//echo "success";
				}
			}
		}else{
            die("connection failed -> " .$this->conn->connect_error);
        }
        return $this->conn;
    }


}

?>