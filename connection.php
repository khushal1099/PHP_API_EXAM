<?php

 class Connection{
    public $host="localhost";
    public $pass="";
    public $username="root";
    public $dbname="Library_Management_System";
    public $conn;

    function connect(){
        $c=mysqli_connect($this->host,$this->username,$this->pass,$this->dbname);

        if($c){
            $this->conn=$c;
        }else{
            echo "Error";
        }
    }

    function insertAuthor($id,$name,$bio,$birthdate){
        $this->connect();
    
        $q= "INSERT INTO `authors`(`id`, `name`, `bio`, `birthdate`) VALUES ('$id','$name','$bio','$birthdate')";
        $res=mysqli_query($this->conn,$q);
        echo $res;
    }

    function updateAuthor($id,$name,$bio,$birthdate){
        $this->connect();
        $q= "UPDATE `authors` SET `id`='$id',`name`='$name',`bio`='$bio',`birthdate`='$birthdate' WHERE id=$id";
        
        $res=mysqli_query($this->conn,$q);
        echo $res;
    }


    function deleteAuthor($id){
        $this->connect();
    
        $q= "delete from `authors` where id=$id";
    
        $res=mysqli_query($this->conn,$q);
        return $res;
        
    }

    function getAuthorData($id){
        $this->connect();
        $q="select * from `authors` where id=$id";
        $res=mysqli_query($this->conn,$q);
        return $res;
    }

    function getAuthorDataByid($id){
        $this->connect();
        $q="select * from `authors` where id=$id";
       
        $res=mysqli_query($this->conn,$q);
        return $res;
    }

    function getData(){
        $this->connect();

        $q= "SELECT * From `authors`";
    
        $res=mysqli_query($this->conn,$q);
        return $res;
    }

 }

?>