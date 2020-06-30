<?php
//get user information
$email = $_POST["loginemail"];
$password = sha1($_POST["loginpassword"]);

//connect to data base
include 'conn.php';

//check if email already exists
$sql = "SELECT * FROM employees WHERE email = '$email' AND password = '$password' AND status = 1 ";
$result = $conn->query($sql);
if($result->num_rows != 1)
{
  $conn->close();
  die("incorrect user name or password");
}
else {
  $row = $result->fetch_assoc();
  echo $row["name"].";".$row["email"].";".$row["profession"].";".$row["mobile"].";".$row["gender"].";".$row["city"].";".$row["region"];
  }
 ?>
