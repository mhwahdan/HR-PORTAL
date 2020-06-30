<?php
include 'conn.php';
$skill = $_GET["skill"];
$type = $_GET["type"];
$num = $_GET["num"];
$email = $_GET["email"];
$mark = 0;
$sql = "SELECT * FROM employees WHERE email = '$email'";
if($result = $conn->query($sql))
  {
    $row = $result->fetch_assoc();
$id = $row["id"];
  }
$sql = "SELECT * FROM quizes WHERE name = '$skill'";
if($result = $conn->query($sql))
  {
    $row = $result->fetch_assoc();
$quizid = $row["id"];
  }
  $sql = "SELECT * FROM questions WHERE quiz_id = '$quizid'";
  if($result = $conn->query($sql))
      while($row = $result->fetch_assoc())
      {
        for ($i=1; $i < $num ; $i++) {
          $answer = $_GET["question".$i.""];
        if($row["answer1"] == $answer)
            $mark = $mark + $row["points1"];
            if($row["answer2"] == $answer)
                $mark = $mark + $row["points2"];
                if($row["answer3"] == $answer)
                    $mark = $mark + $row["points3"];
                    if($row["answer4"] == $answer)
                        $mark = $mark + $row["points4"];
                          }
      }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CBOE portal</title>
    <script>
    <?php echo 'alert("You scored '.$mark.' out of 100");' ?>
    </script>
  </head>
  <body>
  </body>
</html
<?php
$mark = $mark / 100;
if($type == "skill")
  $sql = "INSERT INTO `skills`(`skill_id`, `name`, `weight`) VALUES ('$id','$skill','$mark')";
if($type == "language")
$sql = "INSERT INTO `languages`(`language_id`, `name`, `weight`) VALUES ('$id','$skill','$mark')";
echo $sql;
$result = $conn->query($sql);
header("Location: main.html", true, 301);
 ?>
