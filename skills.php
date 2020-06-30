<?php
$id = $_POST["index"];
include 'conn.php';

$sql = "SELECT * FROM employees WHERE email = '$id'";
if($result = $conn->query($sql))
  {
    $row = $result->fetch_assoc();
$id = $row["id"];
  }

    $sql = "SELECT * FROM skills WHERE skill_id = '$id'";

    $result = $conn->query($sql);

if ($result->num_rows > 0)
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $level = $row["weight"]*100;
    echo '                        <div class="card" style="margin-left:25%;margin-right:10%;margin-top:2%;">
                                  <div class="card-body">
                                    <h5>'.$row["name"].'</h5>
                                    <div class="progress-bar" role="progressbar" style="width: '.$level.'%;" aria-valuenow="'.$level.'" aria-valuemin="0" aria-valuemax="100">'.$level.'%</div>
                                  </div>
                                </div>';
  }
  ?>
