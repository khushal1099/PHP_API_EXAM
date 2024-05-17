<?php

header("Access-Control-Allow-Methods: GET");
header("Content-Type:application/json");
$response = [];
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {

    $input = file_get_contents('php://input'); // returns string

    parse_str($input, $_DELETE);

    $id = $_DELETE['id'];

    include("connection.php");
    $connection=new Connection();
    $connection->connect();

    $res=$connection->deleteAuthor($id);    
    $response["result"]="Success";

} else {
    $response["result"] = "Error Only Get Allow";
}


echo json_encode($response);

?>