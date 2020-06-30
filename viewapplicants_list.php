<?php
$index = $_GET["q"];
include 'conn.php';
$sql = "SELECT * FROM application WHERE request_id = '$index'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
  $id = $row["employee_id"];
  $sql = "SELECT * FROM employees WHERE id = '$id'";
  $result1 = $conn->query($sql);
  $row1 = $result1->fetch_assoc();
  $edu = $row["edu_qualify"]*100;
  $num = $row["total_qualify"]*100;
  $course = $row["courses_qualify"]*100;
  $skills = $row["skills_qualify"]*100;
  $languages = $row["language_qualify"]*100;
  $cmd = "accept('".$row1["email"]."',".$index.");";
  echo '<div class="row">';
  echo '<div class="col-4">';
  echo '<img class="mypp" src="pp/'.$row1["email"].'" alt="no profile picture provided" style="border-radius:50%;width:100%;height:100%;"></img>';
  echo "</div>";
  echo '<div class="col-8">';
    echo '<h5><a target="_blank" href="profile.php?email='.$row1["email"].'">'.$row1["name"].'</a><br>'.$row1["profession"].'<br>'.$row1["experience"].' years of experience.</h5><button type="button" onclick="'.$cmd.'" class="btn btn-outline-info btn-lg">Contact</button>
</div></div>
    <div class="progress" style="margin:2%;height:2%;">
      <div class="progress-bar" role="progressbar" style="width: '.$edu.'%;" aria-valuenow="'.$edu.'" aria-valuemin="0" aria-valuemax="100">education : '.$edu.'%</div>
    </div>
    <div class="progress" style="margin:2%;height:2%;">
      <div class="progress-bar" role="progressbar" style="width: '.$course.'%;" aria-valuenow="'.$course.'" aria-valuemin="0" aria-valuemax="100">courses : '.$course.'%</div>
    </div>
    <div class="progress" style="margin:2%;height:2%;">
      <div class="progress-bar" role="progressbar" style="width: '.$skills.'%;" aria-valuenow="'.$skills.'" aria-valuemin="0" aria-valuemax="100">skills : '.$skills.'%</div>
    </div>
    <div class="progress" style="margin:2%;height:2%;">
      <div class="progress-bar" role="progressbar" style="width: '.$languages.'%;" aria-valuenow="'.$languages.'" aria-valuemin="0" aria-valuemax="100">languages : '.$languages.'%</div>
    </div>
    <div class="progress" style="margin:2%;height:2%;">
      <div class="progress-bar" role="progressbar" style="width: '.$num.'%;" aria-valuenow="'.$num.'" aria-valuemin="0" aria-valuemax="100">overall : '.$num.'%</div>
    </div>
    <div class="dropdown-divider" style="margin:2%;"></div>
';
}
 ?>
