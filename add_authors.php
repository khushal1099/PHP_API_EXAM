<?php

header ("Access-Control-Allow-Methods: POST");
header("Content-Type:application/json");
include ("connection.php");

$connection = new Connection();
$connection->connect();
$res = $connection->getData();

if (isset($_REQUEST["btn-delete"])) {
  $id = $_GET["id"];
  $connection->deleteAuthor($id);
  header("Location: add_authors.php");
}

$studentRecord = null; // corrected variable name
if (isset($_REQUEST["btn-edit"])) {
  $id = $_GET["id"];
  $studentRes = $connection->getAuthorData($id);
  $studentRecord = mysqli_fetch_array($studentRes); // corrected variable name
}

if (isset($_REQUEST["btn_add"])) {
  $id = $_GET["id"];
  $name = $_GET["name"];
  $bio = $_GET["bio"];
  $birthdate = $_GET["birthdate"];
  echo $studentRecord==null? "Add  123 ":"Update ";
  $connection->insertAuthor($id,$name, $bio, $birthdate); // corrected variable name
  header("Location: add_authors.php");
} 

if (isset($_REQUEST["btn_update_record"])) {
    $id = $_GET["id"];
    $name = $_GET["name"];
    $bio = $_GET["bio"];
    $birthdate = $_GET["birthdate"];
  $connection->updateAuthor($id,$name, $bio, $birthdate); // corrected variable name
  header("Location: add_authors.php");
} 

?>

<html>

<head>
  <title>Author Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h1>Student Record</h1>
    <p>please Enter All the detail.</p>
    <form method="POST" action="authors.php"> <!-- Corrected form action -->
      <input type="hidden" name="s_id" value="<?php  echo $studentRecord["id"] ?? '' ?>" class="form-control"><br />
      Name : <input type="text" name="name" value="<?php  echo $studentRecord["name"] ?? '' ?>" class="form-control"><br />
      Bio : <input type="text" name="bio" value="<?php  echo $studentRecord["bio"] ?? '' ?>" class="form-control"><br /> <!-- Corrected variable name -->
      BirthDate : <input type="date" name="birthdate" value="<?php  echo $studentRecord["birthdate"] ?? '' ?>" class="form-control"><br /> <!-- Corrected variable name -->
      <input type="submit" value="<?php echo $studentRecord==null ? "Add":"Update"  ?>" name="<?php echo $studentRecord==null? "btn_add":"btn_update_record"  ?>" class="btn btn-primary">
      <button type="submit" name="btn_add_new" class="btn btn-danger">Base class</button>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Bio Name</th>
          <th scope="col">Birthdate</th>
        </tr>
      </thead>
      <tbody>
        <?PHP while ($data = mysqli_fetch_assoc($res)) {

          echo '<tr>
          <form method="GET" action="">
                <th scope="row">' . $data["id"] . '</th>
                <td>' . $data["name"] . '</td>
                <td>' . $data["bio"] . '</td>
                <td>' . $data["birthdate"] . '</td>
                <td><input type="hidden" name="id" value=' . $data["id"] . ' class="form-control"><br /></td>
                <td><button type="submit" name="btn-edit" class="btn">Edit</button></td>
                <td><button type="submit" name="btn-delete" class="btn btn-danger">Delete</button></td>
                </form>
              </tr>';

        } ?>


      </tbody>
    </table>

  </div>
</body>

</html>
