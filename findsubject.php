<?php
include("conection.php");

$semester=$_REQUEST['semester'];

$query="select subid,subname from subject where courseid=$semester";
$result=mysqli_query($con,$query);

?>
<select name="select3">
<option>Select Subject</option>
<? while($row=mysqli_fetch_array($result)) { ?>
<option value><?=$row['city']?></option>
<? } ?>
</select>
