<?php
$index = $_GET["q"];
$skill = $_GET["p"];
include 'conn.php';
$sql = "SELECT * FROM quizes WHERE name = '$skill'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$quizid = $row["id"];
$type = $row["type"];
$time  = $row["time_t"];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Central bank of egypt portal</title>

  </head>
  <body>
    <div class="container" style="margin-top:5%;">
      <form method="get" id="quizform" action="calculateresult.php">
        <?php
        $i = 1;
        echo '<input type="text" value="'.$type.'" hidden name="type"><input type="text" value="'.$index.'" hidden name="email"><input type="text" value="'.$skill.'" hidden name="skill">';
        $sql = "SELECT * FROM questions WHERE quiz_id = '$quizid'";
        $result = $conn->query($sql);
        if($result)
        while($row = $result->fetch_assoc())
        {
          echo '  <div class="form-group">
    <h5>'.$i.') '.$row["question"].'</h5>
  </div>';
        if($row["answer1"] != NULL)
          echo '<div class="form-check">
  <input class="form-check-input" type="radio" name="question'.$i.'" value="'.$row["answer1"].'" checked>
  <label class="form-check-label">
    1) '.$row["answer1"].'.
  </label>
</div>';
if($row["answer2"] != NULL)
  echo '<div class="form-check">
<input class="form-check-input" type="radio" name="question'.$i.'" value="'.$row["answer2"].'">
<label class="form-check-label">
2) '.$row["answer2"].'.
</label>
</div>';        if($row["answer3"] != NULL)
          echo '<div class="form-check">
  <input class="form-check-input" type="radio" name="question'.$i.'" value="'.$row["answer3"].'">
  <label class="form-check-label">
    3) '.$row["answer3"].'.
  </label>
</div>';        if($row["answer4"] != NULL)
          echo '<div class="form-check">
  <input class="form-check-input" type="radio" name="question'.$i.'" value="'.$row["answer4"].'">
  <label class="form-check-label">
    4) '.$row["answer4"].'.
  </label>
</div>
<div class="dropdown-divider" style="margin:2%;"></div>';
$i++;
        }
        echo '<input type="number" value="'.$i.'" hidden name="num">';
        ?>
        <button type="submit" style="margin:5%;" class="btn btn-lg btn-block btn-outline-success">Submit your answers and receive your quiz results</button>
      </form>
    </div>
    <script>
    <?php echo 'alert("This quiz will test your ability in '.$skill.'\nThe quiz time time is '.$time.' minutes starting from the moment this popup closes\nPlease be aware that the default answer of all the questions is set to the first choice so if you left a question without answering it the first selection will be submitted.");';
    $time  = $time * 60000;
    echo'setTimeout(function(){ document.getElementById("quizform").submit(); }, '.$time.');';?>
    </script>
  </body>
</html>
