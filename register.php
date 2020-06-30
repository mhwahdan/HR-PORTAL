<?php
// include libraries for php mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//user data
$name = $_POST["register-name"];
$email = $_POST['register-email'];
$gender = $_POST['register-gender'];
$city = $_POST['register-city'];
$state = $_POST['register-state'];
$password = sha1($_POST['register-password']);
$confirm = sha1($_POST['register-confirm']);
$profession = $_POST['register-profession'];
$mobile  = $_POST['register-mobile'];
$experience = $_POST['experience'];
//form validiation

//check if the 2 passwords mtach
if($password != $confirm)
{
  $conn->close();
  die("passwords dont match");
}
//connect to data base
include 'conn.php';

//check if email already exists
$sql = "SELECT * FROM employees WHERE email = '$email'";
$result = $conn->query($sql);
if($result->num_rows != 0)
{
  die($email." is already used by another user");
}
//generate a random token
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';
for ($i = 0; $i < 20; $i++) {
  $index = rand(0, strlen($characters) - 1);
  $randomString .= $characters[$index];
}
$randomString = sha1($randomString);

//insert unactivated user into SQL Database

  $sql = "INSERT INTO employees (name, email, gender, mobile, profession, city, region, password, token,experience)
  VALUES ('$name', '$email', '$gender', '$mobile', '$profession', '$city', '$state', '$password', '$randomString','$experience')";
  if ($conn->query($sql)) {
    // if insertion is successfull send a verification link to user email
          $mail = new PHPMailer();
          $mail->isSMTP();
          $mail->SMTPAuth = 'true';
          $mail->SMTPSecure = 'ssl';
          $mail->Host = 'smtp.gmail.com';
          $mail->Port = '465';
          $mail->isHTML();
          $mail->Username = 'cboe.portal@gmail.com';
          $mail->Password = 'B@kl@weez1211';
          $mail->setFrom('no-reply@cboe.portal.com');
          $mail->addAddress($email);
          $mail->Subject = "Please verify email!";
          $mail->Body = "
<label>please click on the following link to activate your CBOE portal account :-<br></label>
<a style='text-align:center'>http://localhost:8000/verifyemail.php?token=".$randomString."<a>";
          if ($mail->send())
              echo "A verification link has been sent to ".$email." please click on it to activate your account ";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
