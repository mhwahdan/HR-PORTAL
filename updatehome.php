<?php
$name = $_GET["q"];
$profession = $_GET["q"];
$about = $_GET["r"];
$email = $_GET["i"];
include 'conn.php';

$sql = "UPDATE employees set name = '$name',profession = '$profession',about = '$about' where email = '$email'";
if($result = $conn->query($sql))
echo "Your profile has been updated";
else
echo "server error";
  $conn->close();
 ?>
