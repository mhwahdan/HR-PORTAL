<?php
$index = $_GET["index"];
$type = $_GET["employmenttype"];
$name = $_GET["institutionname"];
$location = $_GET["location"];
$title = $_GET["jobtitle"];
$description = $_GET["jobdescription"];
$arr = explode(";",$_GET["projects"]);
$count = count($arr)-1;
include 'conn.php';

  $sql = "SELECT * FROM employees WHERE email = '$index'";
if($result = $conn->query($sql))
{
  $row = $result->fetch_assoc();
  $id = $row["id"];
  $sql = "INSERT INTO experience (experience_id, type_of_employment, institution_name, location, job_title, job_description)
  VALUES ('$id', '$type', '$name', '$location', '$title', '$description');";
  if($result = $conn->query($sql))
  {
    $sql = "SELECT * FROM experience WHERE experience_id = '$id' AND type_of_employment = '$type' AND institution_name = '$name' AND location = '$location' AND job_title = '$title' AND job_description = '$description'";
    if($result = $conn->query($sql))
      $row = $result->fetch_assoc();
      else {
        die("Connection failed: " . $conn->error);
      }
    $id = $row["id"];
    for ($i=0; $i < count($arr)-1; $i++) {
    $p = explode(",",$arr[$i]);
    $sql = "INSERT INTO projects (project_id, name, project_description)
    VALUES ('$id', '$p[0]', '$p[1]');";
    $conn->query($sql);
  }
  echo "profile updated successfully";
}
else
  die("Connection failed: " . $conn->error);
}
else
echo "server error";
?>
