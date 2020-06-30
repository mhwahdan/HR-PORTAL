<?php
$bankid = $_GET["index"];
$type = $_GET["employmenttype"];
$title = $_GET["jobtitle"];
$profession = $_GET["profession"];
$function = $_GET["function"];
$degree = $_GET["degree"];
$experience = $_GET["experience"];
$education = explode(";",$_GET["education"]);
$description = $_GET["jobdescription"];
$skills = explode(";",$_GET["skills"]);
$languages = explode(";",$_GET["langs"]);
$courses = explode(";",$_GET["courses"]);
$edu_w = $_GET["edu_weight"];
$c_w = $_GET["courses_weight"];
$s_w = $_GET["skills_weight"];
$l_w = $_GET["languages_weight"];

include 'conn.php';

$sql = "SELECT * FROM banks WHERE id = '$bankid'";
if($result = $conn->query($sql))
{
  $row = $result->fetch_assoc();
  $id = $row["id"];
  $sql = "INSERT INTO hiring_requests (bank_id, employment_type, job_title, profession, function,edu_weight,courses_weight,skills_weight,lang_weight, experience,description,time_post)
  VALUES ('$id', '$type', '$title', '$profession', '$function','$edu_w','$c_w','$s_w','$l_w', '$experience','$description',NOW());";
  if($result = $conn->query($sql))
  {
    $sql = "SELECT * FROM hiring_requests WHERE bank_id = '$id' AND employment_type = '$type' AND job_title = '$title' AND function = '$function' AND description = '$description'";
    if($result = $conn->query($sql))
      $row = $result->fetch_assoc();
      else {
        die("Connection failed: " . $conn->error);
      }
    $id = $row["id"];
    $count = count($skills)-1;
    for ($i=0; $i < $count; $i++) {
    $p = explode(",",$skills[$i]);
    $sql = "INSERT INTO skills_req (request_id,name,credit)
    VALUES ('$id', '$p[0]', '$p[1]');";
    if(!$conn->query($sql))
        echo $conn->error;
  }
  $count = count($courses)-1;
  for ($i=0; $i < $count; $i++) {
  $p = explode(",",$courses[$i]);
  $sql = "INSERT INTO courses_req (request_id,name,credit)
  VALUES ('$id', '$p[0]', '$p[1]');";
  if(!$conn->query($sql))
      echo $conn->error;
}
$count = count($languages)-1;
for ($i=0; $i < $count; $i++) {
$p = explode(",",$languages[$i]);
$sql = "INSERT INTO languages_req (request_id,name,credit)
VALUES ('$id', '$p[0]', '$p[1]');";
if(!$conn->query($sql))
    echo $conn->error;
}

$count = count($education)-1;
echo $count;
for ($i=0; $i < $count; $i++) {
$p = explode(",",$education[$i]);
$sql = "INSERT INTO college_req (request_id,college_name,c_points,field,excellent,verygood,good,pass,honor,degree)
VALUES ('$id', '$p[0]', '$p[1]', '$p[2]', '$p[3]', '$p[4]', '$p[5]', '$p[6]', '$p[7]','$p[8]');";

if(!$conn->query($sql))
    echo $conn->error;
}
  echo "the job has been posted successfully";
}
else
  die("Connection failed: " . $conn->error);
}
else
echo "server error";
?>
