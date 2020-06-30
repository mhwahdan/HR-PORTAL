<?php
$name = $_POST["email"];
if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $location = 'pp/' . $name;
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
}
echo $name;
?>
