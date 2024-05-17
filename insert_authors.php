<?php

header("Access-Control-Allow-Methods: POST");
header("Content-Type:application/json");

include ("connection.php");

$con = new Connection();
$con->connect();


$res = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $bio = $_POST["bio"];
    $birthdate = $_POST["birthdate"];

    $errorMessage = "";

    if ($name == null) {
        $errorMessage = $errorMessage . " name,";
    }
    if ($bio == null) {
        $errorMessage = $errorMessage . " bio,";
    
    if ($birthdate == null) {
        $errorMessage = $errorMessage . " birthdate,";
    }

    if ($name != null && $bio != null && $birthdate != null ) {
        $con = new Connection();
        $con->connect();
        $con->insertAuthor($name, $bio, $birthdate);

        $res["data"] = "Successfully added";
        $usersData = [];
        $sRec = $con->getAuthorDataByid($id);
        while ($s = mysqli_fetch_assoc($sRec)) {
            array_push($usersData, $s);
        }
        // $user=$gsbd;
        $res["result"] = true;

        $user["name"] = $name;
        $user["bio"] = $bio;
        $user["birthdate"] = $birthdate;
        $res["user"] = $usersData;
    } else {
        $res["result"] = false;
        $res["message"] = $errorMessage . " parameter is missing";
    }

    }
} else {
    $res["data"] = "Allow only Post";
}

echo json_encode($res);

?>