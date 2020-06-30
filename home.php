<?php
$id = $_POST["index"];
include 'conn.php';

$sql = "SELECT * FROM employees WHERE email = '$id'";
if($result = $conn->query($sql))
  {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $profession = $row["profession"];
    $about = $row["about"];
  }
echo '<label style="width:25%;height:25%;margin:5%;" for="mypp"><img class="mypp" src="pp/'.$id.'" alt="please upload your profile picture" style="border-radius:50%;width:100%;height:100%;"></img></label>
<button type="button" id="home_button" style="width:50%;margin:auto;" onclick="updatehome();" class="btn btn-primary btn-lg btn-block">Update Profile</button>
<h3 contenteditable="true" id="name" style="margin-top:5%;">'.$name.'</h3>
<h4 contenteditable="true" id="profession" style="margin-top:2%;">'.$profession.'</h4>
<h2 contenteditable="true" id="about" style="margin-top:3%;">About</h2>
<p contenteditable="true" style="margin-top:2%;">'.$about.'</p>';
 ?>
