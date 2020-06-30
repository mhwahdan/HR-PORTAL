<?php
$id = $_POST["index"];
include 'conn.php';

$sql = "SELECT * FROM employees WHERE email = '$id'";
if($result = $conn->query($sql))
  {
    $row = $result->fetch_assoc();
$id = $row["id"];
  }

    $sql = "SELECT * FROM experience WHERE experience_id = '$id'";

    $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $id1 = $row["id"];

    echo '        <div class="card" style="margin-left:25%;margin-right:25%;margin-top:2%;">
              <div class="card-header">
                '.$row["type_of_employment"].'
              </div>
              <div class="card-body">
                <blockquote class="blockquote mb-0">
                  <h2>'.$row["institution_name"].'</h2>
                  <h4>'.$row["job_title"].'</h4>
                  <label>'.$row["job_description"].'</label><br>
                  <h5 style="margin-top:1%;">Projects & accomplishments</h5>
                  <ul class="list-group list-group-flush">';
                  $sql = "SELECT * FROM projects WHERE project_id = '$id1'";
                  $result1 = $conn->query($sql);
                  if ($result1->num_rows > 0)
                      while($row1 = $result1->fetch_assoc()) {
    echo '                <li class="list-group-item">
                      <h6>-'.$row1["name"].'</h6>
                      <h7>'.$row1["project_description"].'</h7>
                    </li>';
                  }
    echo '              </ul>
                </blockquote>
              </div>
            </div>';
          }
} else {
  echo "0 results";
}




 ?>
