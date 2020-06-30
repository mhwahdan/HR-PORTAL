<?php
$id = $_GET["email"];
include 'conn.php';
$sql = "SELECT * FROM employees WHERE email = '$id'";
if($result = $conn->query($sql))
  {
    $row = $result->fetch_assoc();
$uid = $row["id"];
  }
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
<script>
//load user information from session
  <?php echo 'var email = "'.$_GET["email"].'";';?>
  function apply(str)
  {
    var xmlhttp = new XMLHttpRequest();
 xmlhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
     alert(this.responseText);
   }
 };
 xmlhttp.open("GET", "apply.php?q=" + str + "&p=" + name, true);
 xmlhttp.send();
  }
  function texts(){
  var textareas = document.getElementsByTagName('textarea');
  var count = textareas.length;
  for(var i=0;i<count;i++){
  textareas[i].onkeydown = function(e){
      if(e.keyCode==9 || e.which==9){
          e.preventDefault();
          var s = this.selectionStart;
          this.value = this.value.substring(0,this.selectionStart) + "\t" + this.value.substring(this.selectionEnd);
          this.selectionEnd = s+1;
      }
  }
  }
}

function nl2br(str){
str = str.replace(/(?:\r\n|\r|\n)/g, '<br>');
return str.replace(/\t/g, '<t>');

}
function br2nl(str){
  str = str.replace(/<br>/g,'\n');
return str.replace(/<t>/g,'\t');
}
</script>
    <meta charset="utf-8">
    <title>Central bank of egypt portal</title>
  </head>
  <body>
          <div id="portfolio" style="min-height:100vh;" role="tabpanel" class="tab-pane fade show active">
            <div class="row bg-dark" style="min-height:100vh;">
              <div class="col-3 border-right">
                <div class="container">
                  <label style="width:100%;height:100%;margin:5%;" for="mypp"><img class="mypp" style="border-radius:50%;width:100%;height:100%;margin:auto;" alt=""></label>
                </div>
                <div class="overflow-auto">
                  <ul class="nav nav-pills container flex-column nav-fill" style="margin:auto;">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#work-history">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#education">education</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#skills">skills & courses</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-9 tab-content">
                <div id="Home" style="text-align:center;color:white" role="tabpanel" class="tab-pane fade show active overflow-auto">
                  <?php
                  $sql = "SELECT * FROM employees WHERE email = '$id'";
                  if($result = $conn->query($sql))
                    {
                      $row = $result->fetch_assoc();
                      $name = $row["name"];
                      $profession = $row["profession"];
                      $about = $row["about"];
                    }
                  echo '<img class="mypp" style="width:25%;height:25%;margin:5%;border-radius:50%;" src="pp/'.$id.'" alt="please upload your profile picture"></img>
                  <h3 id="name">'.$name.'</h3>
                  <h4 id="profession" style="margin-top:2%;">'.$profession.'</h4>
                  <h2 id="about" style="margin-top:3%;">About</h2>
                  <p style="margin-top:2%;">'.$about.'</p>';
                   ?>
                </div>
                <div id="work-history" role="tabpanel" class="tab-pane fade">
                  <div id="historycarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div id="experience_id" class="carousel-item active">
        <?php
            $sql = "SELECT * FROM experience WHERE experience_id = '$uid'";

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
      </div>
    </div>
    <a class="carousel-control-prev" href="#historycarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#historycarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
  <div id="education" role="tabpanel" class="tab-pane fade">
  <div id="educationcarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div id ="education_id" class="carousel-item active">
        <?php
            $sql = "SELECT * FROM education WHERE education_id = '$uid'";

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
                            echo '<h7> graduated withhonor degree</h7>';
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

      </div>
    </div>
    <a class="carousel-control-prev" href="#educationcarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#educationcarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
                </div>
                <div id="skills" role="tabpanel" class="tab-pane fade">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div id="courses_id" class="carousel-item active">
                        <?php
                            $sql = "SELECT * FROM courses WHERE course_id = '$uid'";

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

                      </div>
                      <div class="carousel-item">
                        <div class="row">
                          <div id="skills_id" class="col-6 border-right">
                            <?php
                                $sql = "SELECT * FROM skills WHERE skill_id = '$uid'";

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

                            </div>
                          <div id="languages_id" class="col-6">
                            <?php
                                $sql = "SELECT * FROM languages WHERE language_id = '$uid'";

                                $result = $conn->query($sql);

                            if ($result->num_rows > 0)
                              // output data of each row
                              while($row = $result->fetch_assoc()) {
                                $level = $row["weight"]*100;
                                echo '                        <div class="card" style="margin-left:5%;margin-right:25%;margin-top:2%;">
                                                              <div class="card-body">
                                                                <h5>'.$row["name"].'</h5>
                                                                <div class="progress-bar" role="progressbar" style="width: '.$level.'%;" aria-valuenow="'.$level.'" aria-valuemin="0" aria-valuemax="100">'.$level.'%</div>
                                                              </div>
                                                            </div>';
                              }
                              ?>

                          </div>
                      </div>
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
            </div>
          </div>
        </div>
      </div>

<script>
$("input.index").attr("value",email);
try {
  $("img.mypp").attr("src", "pp/"+email);
}
catch(err) {
alert(err.message);
}
</script>
  </body>
</html>
