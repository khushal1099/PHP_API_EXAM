<?php

include ("connection.php");

$connection = new Connection();
$connection->connect();
$res = $connection->getData();

if (isset($_REQUEST["btn-delete"])) {
  $id = $_GET["id"];
  $connection->deleteAuthor($id);
  header("Location: add_author.php");
}

$author = null; // corrected variable name
if (isset($_REQUEST["btn-edit"])) {
  $id = $_GET["id"];
  $studentRes = $connection->getAuthorData($id);
  $author = mysqli_fetch_array($studentRes); // corrected variable name
}

if (isset($_REQUEST["btn_add"])) {
  $name = $_POST["name"];
  $bio = $_POST["bio"];
  $birthdate = $_POST["birthdate"];
//   echo $studentRecord==null? "Add  123 ":"Update ";
  $connection->insertAuthor($name, $bio, $birthdate); // corrected variable name
  header("Location: add_author.php");
} 

if (isset($_REQUEST["btn_update_record"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $bio = $_POST["bio"];
    $birthdate = $_POST["birthdate"];
  $connection->updateAuthor($id,$name, $bio, $birthdate); // corrected variable name
  header("Location: add_author.php");
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
    <form method="POST" action=""> <!-- Corrected form action -->
      <input type="hidden" name="id" value="<?php  echo $author["id"] ?? '' ?>" class="form-control"><br />
      Name : <input type="text" name="name" value="<?php  echo $author["name"] ?? '' ?>" class="form-control"><br />
      Bio : <input type="text" name="bio" value="<?php  echo $author["bio"] ?? '' ?>" class="form-control"><br /> <!-- Corrected variable name -->
      BirthDate : <input type="date" name="birthdate" value="<?php  echo $author["birthdate"] ?? '' ?>" class="form-control"><br /> <!-- Corrected variable name -->
      <input type="submit" value="<?php echo $author==null ? "Add":"Update"  ?>" name="<?php echo $author==null? "btn_add":"btn_update_record"  ?>" class="btn btn-primary">
    </form>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Bio</th>
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
