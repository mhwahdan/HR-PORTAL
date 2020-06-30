<?php
$index = $_GET["p"];
$jobid = $_GET["q"];
$points = 0;
$divide = 0;
$edu_qualify = 0;
$skill_qualify = 0;
$course_qualify = 0;
$lang_qualify = 0;
include 'conn.php';

$sql = "SELECT * FROM employees WHERE name = '$index'";
if($result = $conn->query($sql))
{
  $row = $result->fetch_assoc();
  $id = $row["id"];
}
$sql = "SELECT * FROM education WHERE education_id = '$id'";

if($result = $conn->query($sql))
while ($row = $result->fetch_assoc()) {
  $name = $row["college_name"];
  $degree = $row["degree"];
  $grade = $row["grade"];
  $honor = $row["honor"];
  $field = $row["field_of_study"];
  $sql = "SELECT * FROM college_req WHERE request_id = '$jobid' AND college_name = '$name' AND field = '$field' AND degree = '$degree'";
  if($result1 = $conn->query($sql))
while ($row1 = $result1->fetch_assoc()) {
  $points = $points + $row1["c_points"]/100;
  if($honor == 1);
      $points = $points + $row1["honor"]/100;
  if($grade == "excellent")
        $points = $points + $row1["excellent"]/100;
  elseif ($grade == "verygood")
    $points = $points + $row1["verygood"]/100;
  elseif ($grade == "good")
    $points = $points + $row1["good"]/100;
  elseif ($grade == "pass")
    $points = $points + $row1["pass"]/100;
}
if(mysqli_num_rows($result1) != 0)
  $edu_qualify = $points / mysqli_num_rows($result1);
}
$sql = "SELECT * FROM skills WHERE skill_id = '$id'";
if($result = $conn->query($sql))
while ($row = $result->fetch_assoc()) {
  $name = $row["name"];
  $weight = $row["weight"];
  $sql = "SELECT * FROM skill_req WHERE request_id = '$jobid' AND name = '$name'";
  if($result1 = $conn->query($sql))
  while ($row1 = $result1->fetch_assoc()) {
    $skill_qualify = $skill_qualify + $weight * $row1["credit"]/100;
}
if(mysqli_num_rows($result1) != 0)
  $skill_qualify = $skill_qualify / mysqli_num_rows($result1);
}
$sql = "SELECT * FROM languages WHERE language_id = '$id'";
if($result = $conn->query($sql))
while ($row = $result->fetch_assoc()) {
  $name = $row["name"];
  $weight = $row["weight"];
  $sql = "SELECT * FROM languages_req WHERE request_id = '$jobid' AND name = '$name'";
  if($result1 = $conn->query($sql))
  while ($row1 = $result1->fetch_assoc()){
    $skill_qualify = $skill_qualify + $weight * $row1["credit"]/100;
}
if(mysqli_num_rows($result1) != 0)
  $skill_qualify = $skill_qualify / mysqli_num_rows($result1);
}
$sql = "SELECT * FROM courses WHERE course_id = '$id'";
if($result = $conn->query($sql))
while ($row = $result->fetch_assoc()) {
  $name = $row["name"];
  $sql = "SELECT * FROM courses_req WHERE request_id = '$jobid' AND name = '$name'";
  if($result1 = $conn->query($sql))
  while ($row1 = $result1->fetch_assoc()) {
    $course_qualify = $course_qualify + $row1["credit"]/100;
}
if(mysqli_num_rows($result1) != 0)
  $skill_qualify = $skill_qualify / mysqli_num_rows($result1);
}
$sql = "SELECT * FROM hiring_requests WHERE id = '$jobid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total = $edu_qualify * $row["edu_weight"] + $course_qualify * $row["courses_weight"] + $skill_qualify * $row["skills_weight"] + $lang_qualify * $row["lang_weight"];
$total = $total / 400;
$sql = "INSERT INTO application (request_id,employee_id,edu_qualify,courses_qualify	,skills_qualify,language_qualify,total_qualify)
VALUES ('$jobid','$id','$edu_qualify','$course_qualify','$skill_qualify','$lang_qualify','$total')";
$result = $conn->query($sql);
?>
