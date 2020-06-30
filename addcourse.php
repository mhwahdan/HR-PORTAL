<?php
$id = $_GET["index"];
$name = $_GET["coursename"];
$description = $_GET["coursedescription"];
include 'conn.php';
$sql = "SELECT * FROM employees WHERE email = '$id'";
if($result = $conn->query($sql))
{
  $row = $result->fetch_assoc();
  $id = $row["id"];
}
$sql = "INSERT INTO courses (course_id, name, description)
VALUES ('$id', '$name', '$description')";
if($result = $conn->query($sql))
  echo "course added succesfully ";
  else
  echo "course addition failed ";

 ?>
