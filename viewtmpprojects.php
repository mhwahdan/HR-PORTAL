<?php
echo '<h4 style="text-align:center;">Your projects</h4>';
$arr = explode(";",$_GET["q"]);
for ($i=0; $i < count($arr)-1; $i++) {
$p = explode(",",$arr[$i]);
echo '<div class="alert alert-info" style="margin-top:1%;margin-left:15%;margin-right:15%;" role="alert">';
echo "<h4>".$p[0]."<h4>";
echo "<h6>".$p[1]."<h6>";
echo "</div>";
}
?>
