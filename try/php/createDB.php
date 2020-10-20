<?php

class CreateDb {
    public $servername;
    public $username;
    public $pass;
    public $dbname;
    public $tablename;
    public $con;

    //class constructor
    public function __construct(
        $dbname = "newDB",
        $tablename = "Productdb",
        $servername = "localhost",
        $username = "root",
        $pass = ""
    )
     {
        //initialize all the argument
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->username = $username;
        $this->pass = $pass;

        //create connection
        $this->con = mysqli_connect($servername, $username, $pass);

        //check the connection
        if (!$this->con){
            die("Connection failed : " .mysqli_connect_error());
        }

        //create the query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        //execute the query
        if(mysqli_query($this->con, $sql)){
            $this->con = mysqli_connect($servername, $username, $pass, $dbname);

            //create the table with sql
            $sql = "CREATE TABLE IF NOT EXISTS $tablename
                    (id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    product_name VARCHAR(25) NOT NULL,
                    product_price FLOAT,
                    product_image VARCHAR(100));
                    ";

                //execute the table
                if(!mysqli_query($this->con, $sql)){
                    echo "Error creating table: " .mysqli_error($this->con);
                }

        } else {
            return false;
        }
     }
    
     //to get data from the table and display it on the UI
     public function getdata() {
         $sql = "SELECT * FROM $this->tablename";

         $result = mysqli_query($this->con, $sql); //$result have the product information

         if(mysqli_num_rows($result) > 0){
             return $result;
         }
     }
}

?>