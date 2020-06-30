<?php
$id = $_POST["loginid"];
$password = sha1($_POST["loginpassword"]);
//connect to data base
include 'conn.php';

//check if email already exists
$sql = "SELECT * FROM banks WHERE id = '$id' AND password = '$password'";
$result = $conn->query($sql);
if($result->num_rows != 1)
{
  $conn->close();
  die("incorrect id or password");
}
else {
  $row = $result->fetch_assoc();
  echo $row["id"];
  }



 ?>
