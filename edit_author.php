<?php

header("Access-Control-Allow-Methods: GET");
header("Content-Type:application/json");
$response = [];
if ($_SERVER["REQUEST_METHOD"] == "PUT" || $_SERVER["REQUEST_METHOD"] == "PATCH") {

    $input = file_get_contents('php://input'); // returns string

    parse_str($input, $_UPDATE);

    $id = $_UPDATE["id"];
    $name = $_UPDATE["name"];
    $bio = $_UPDATE["bio"];
    $birthdate = $_UPDATE["birthdate"];

    include("connection.php");
    $connection=new Connection();
    $connection->connect();

    $connection->updateAuthor($id,$name,$bio,$birthdate);    
    $response["result"]="Success";

} else {
    $response["result"] = "Error Only Get Allow";
    
}


echo json_encode($response);

?>