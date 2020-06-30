<?php
$index = $_POST["index"];
include 'conn.php';

$sql = "SELECT * FROM employees WHERE email = '$index'";
if($result = $conn->query($sql))
{
  $row = $result->fetch_assoc();
  $id = $row["id"];
  $profession =  $row["profession"];
  $experience = $row["experience"];
  $sql = "SELECT * FROM hiring_requests WHERE profession = '$profession' AND experience <= '$experience'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    $requestid = $row["id"];
    $sql = "SELECT * FROM application WHERE employee_id = '$id' AND request_id = '$requestid'";
    $flag=mysqli_num_rows($conn->query($sql));
    if($flag == 0)
    {
    $sql = "SELECT * FROM banks WHERE id = '$id'";
    $result1 = $conn->query($sql);
    $row1 = $result1->fetch_assoc();
    $bn = $row1["name"];
    echo '<div class="card text-center" style="width:60%;margin:auto;margin-top:2%;">
  <div class="card-header">
  '.$bn.'
  </div>
  <div class="card-body">
    <h5 class="card-title">'.$row["job_title"].'</h5>
    <p class="card-text">Job function: '.$row["function"].'<br>Experience required: '.$row["experience"].' years</p>
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              job description
            </button>
          </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
          '.$row["description"].'
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              education required
            </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">';
    $sql = "SELECT * FROM college_req WHERE request_id = '$requestid'";
    $result1 = $conn->query($sql);
    while ($row1 = $result1->fetch_assoc()) {
      echo '<h6>-college name: '.$row1["college_name"].'<br>-field: '.$row1['field'].'<br>-degree: '.$row1['degree'].'</h6><div class="dropdown-divider"></div>';
    }
          echo '</div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              other requirements
            </button>
          </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body row">
<div class="col-4">
<div class="alert alert-primary" role="alert">courses required</div>';
$sql = "SELECT * FROM courses_req WHERE request_id = '$requestid'";
$result1 = $conn->query($sql);
while ($row1 = $result1->fetch_assoc()) {
  echo '<h6>-'.$row1["name"].'<div class="dropdown-divider"></div>';
}
echo '</div>
<div class="col-4 border-right border-left border-primary">
<div class="alert alert-primary" role="alert">skills required</div>';
$sql = "SELECT * FROM skills_req WHERE request_id = '$requestid'";
$result1 = $conn->query($sql);
while ($row1 = $result1->fetch_assoc()) {
  echo '<h6>-'.$row1["name"].'<div class="dropdown-divider"></div>';
}
echo '</div>
<div class="col-4">
<div class="alert alert-primary" role="alert">languages required</div>';
$sql = "SELECT * FROM languages_req WHERE request_id = '$requestid'";
$result1 = $conn->query($sql);
while ($row1 = $result1->fetch_assoc()) {
  echo '<h6>-'.$row1["name"].'<div class="dropdown-divider"></div>';
}
echo '</div>
          </div>
        </div>
      </div>
    </div>
    <button style="margin-top:1%;" onclick="apply('.$row["id"].');" class="btn btn-primary">Apply for a job</button>
  </div>
  <div class="card-footer text-muted">
    '.$row["time_post"].'
  </div>
</div>';
  }
}
}
?>
