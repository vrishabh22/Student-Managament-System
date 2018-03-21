<?php
$con = mysqli_connect("localhost","root","","studentinfo");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

mysqli_select_db($con,"studentinfo");
?>
