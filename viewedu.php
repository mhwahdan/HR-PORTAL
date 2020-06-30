<?php
$arr = explode(";",$_GET["q"]);
for ($i=0; $i < count($arr)-1; $i++) {
$p = explode(",",$arr[$i]);
echo '<div class="alert alert-info" style="margin-top:1%;margin-left:15%;margin-right:15%;" role="alert">';
echo "<h4>".$p[0]."<h4>";
echo "<h5>field of study : ".$p[2]."<h6>";
echo "<h6>college credit points : ".$p[1]."<h6>";
echo "<h6>excellent grade credit points : ".$p[3]."<h6>";
echo "<h6>verygood grade credit points : ".$p[4]."<h6>";
echo "<h6>good grade credit points : ".$p[5]."<h6>";
echo "<h6>pass grade credit points : ".$p[6]."<h6>";
echo "<h6>honor degree credit points : ".$p[7]."<h6>";
echo "</div>";
}
?>
