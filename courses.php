<?php
$id = $_POST["index"];
include 'conn.php';

$sql = "SELECT * FROM employees WHERE email = '$id'";
if($result = $conn->query($sql))
  {
    $row = $result->fetch_assoc();
$id = $row["id"];
  }

    $sql = "SELECT * FROM courses WHERE course_id = '$id'";

    $result = $conn->query($sql);

if ($result->num_rows > 0)
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '                        <div class="card" style="margin-left:10%;margin-right:10%;margin-top:2%;">
                              <div class="card-body">
                                <h5>'.$row["name"].'</h5><br>
                                <h6>'.$row["description"].'</h6>
                              </div>
                            </div>';
  }
  ?>
