<?php
$index = $_POST["index"];

include 'conn.php';
$sql = "SELECT * FROM hiring_requests WHERE bank_id = '$index'";
$result = $conn->query($sql);
echo '<div class="card-columns">';
while ($row = $result->fetch_assoc()) {
  echo '<div class="card" style="margin:3%;">
  <h5 class="card-header"><a onclick="loadjob('.$row["id"].')" data-toggle="modal" data-target="#applicationlist" href="#">'.$row["employment_type"].' '.$row["job_title"].'<a></h5>
    <div class="card-body">
      <p class="card-text">'.$row["description"].'</p>
    </div>
  </div>';
}
echo "</div>'";
 ?>
