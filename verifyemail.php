<?php
$token = $_GET["token"];
include 'conn.php';

$sql = "UPDATE employees set status = 1 where token = '$token'";
if ($conn->query($sql)) {
header("Location: index.html");
 }
 ?>
