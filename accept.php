<?php
// include libraries for php mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
include 'conn.php';
$email = $_GET["q"];
$jobid = $_GET["p"];
$sql = "SELECT * FROM employees WHERE email = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name = $row["name"];
$sql = "SELECT * FROM hiring_requests WHERE id = '$jobid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$bankid = $row["bank_id"];
$jobdescription = $row["description"];
$title = $row["job_title"];
$sql = "SELECT * FROM banks WHERE id = '$bankid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$bankname = $row["name"];
$contact = $row["contact"];
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
$mail->Subject = "the job you applied for a job as a ".$title." at ".$bankname."";
$msg = '<h5>Congratulations MR.'.$name.'</h5><p>your application for a job as a '.$title.' at '.$bankname.' has been accepted<br>the job description was:-<br>'.$jobdescription.'<br>Please contact the bank throught '.$contact.'</p>';
$mail->Body = $msg;
if($mail->send())
echo "An email has been sent successfully to MR.$name in order to contact you for further details or scheduling an interview";
?>
