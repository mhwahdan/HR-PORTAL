<?php
$id = $_POST["index"];
include 'conn.php';

$sql = "SELECT * FROM employees WHERE email = '$id'";
if($result = $conn->query($sql))
  {
    $row = $result->fetch_assoc();
$id = $row["id"];
  }

    $sql = "SELECT * FROM education WHERE education_id = '$id'";

    $result = $conn->query($sql);

if ($result->num_rows > 0)
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $id1 = $row["id"];
    echo '<div class="card" style="margin-top:5%;margin-left:20%;margin-right:20%;">
              <div class="card-header">
                '.$row["degree"].'
              </div>
              <div class="card-body">
                <blockquote class="blockquote mb-0">
                  <h2>college: '.$row["college_name"].'</h2>
                  <h7>location: '.$row["college_location"].'</h7><br>
                  <h7>field of study: '.$row["field_of_study"].'</h7><br>
                  <h7>GPA: '.$row["grade"].'</h7>';
                  if($row["honor"])
                    echo '<h7> graduated with honor degree</h7>';
        echo '          <p>'.$row["description"].'</p>
                  <h7>start date: '.$row["start"].'</h7><br>
                  <h7>graduation date: '.$row["_end"].'</h7>
                  <h5 style="margin-top:1%;">Extra circullar activities</h5>
                  <ul class="list-group list-group-flush">';
                  $sql = "SELECT * FROM activities WHERE activity_id = '$id1'";
                  $result1 = $conn->query($sql);
                  if ($result1->num_rows > 0)
                      while($row1 = $result1->fetch_assoc()) {
        echo'            <li class="list-group-item">
                      <h6>-'.$row1["activity_name"].'</h6>
                      <p>A'.$row1["description"].'</p>
                    </li>';
                  }
      echo'            </ul>
                </blockquote>
              </div>
            </div>';
          }





 ?>
