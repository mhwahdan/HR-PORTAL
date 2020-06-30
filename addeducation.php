<?php
$index = $_GET["index"];
$degree = $_GET["degree"];
$college = $_GET["collegename"];
$location = $_GET["location"];
$grade = $_GET["grade"];
$honor = $_GET["honor"];
$field = $_GET["field"];
$start = $_GET["startdate"];
$end = $_GET["graduationdate"];
$description = $_GET["educationdescription"];
$arr = explode(";",$_GET["activities"]);
$count = count($arr)-1;
include 'conn.php';
$sql = "SELECT * FROM employees WHERE email = '$index'";
if($result = $conn->query($sql))
{
  $row = $result->fetch_assoc();
  $id = $row["id"];
  $sql = "INSERT INTO education (education_id, degree, college_name, college_location, grade, field_of_study, start, _end, description,honor)
  VALUES ('$id', '$degree', '$college', '$location', '$grade', '$field', '$start', '$end', '$description','$honor');";
  if($result = $conn->query($sql))
  {
    $sql = "SELECT * FROM education WHERE education_id = '$id' AND degree = '$degree' AND college_name = '$college' AND college_location = '$location' AND grade = '$grade' AND start = '$start' AND _end = '$end' AND description = '$description'";
    if($result = $conn->query($sql))
      $row = $result->fetch_assoc();
      else {
        die("Connection failed: " . $conn->error);
      }
    $id = $row["id"];
    for ($i=0; $i < count($arr)-1; $i++) {
    $p = explode(",",$arr[$i]);
    $sql = "INSERT INTO activities (activity_id, activity_name, description)
    VALUES ('$id', '$p[0]', '$p[1]');";
    if(!$conn->query($sql))
        echo $conn->error;
  }
  echo "profile updated successfully";
}
else
  die("Connection failed: " . $conn->error);
}
else
echo "server error";
?>
