<script>
    function submit_form()
        {
                     dml=document.forms['form1'];
				
                // get the number of elements from the document
                       len = dml.elements.length;
                     for( i=0 ; i<len ; i++)
                        {                         
							 //  j=0;
							    //check the textbox with the elements name
                                if (dml.elements[i].name=='attclass[]')
                                {
									
										j=i+1;
			k =(dml.elements[i].value * 100) / dml.elements["totclass"].value;
			//alert(k);
									if(k > 100)
									{
										alert("Attended class is greater than total class...");
										dml.elements[i].value="0";
										j=i+1;
								dml.elements[j].value = "0";
						dml.elements[i].focus();
									}
									else
									{
									//alert(i);
									//alert(dml.elements[i].value);
								dml.elements[j].value = k.toFixed(2);
									}
                                }
						
                        }
               
               
                return true;
                       
        }

</script>
<?php
session_start();
include("conection.php");

  //$listvals=$_POST['mylist'];
  // $n=count($listvals);
if(isset($_POST['stuid']))
  $stuid=$_POST['stuid'];
if(isset($_POST['attclass']))
    $attclass =$_POST['attclass'];
  if(isset($_POST['percentage']))
	$percent =$_POST['percentage'];
if(isset($_POST['comment']))
	$comment =$_POST['comment'];
//echo  $_POST["totstdnt"];
if(isset($_POST["btnupdte"]))
	{
		mysqli_query($con,"UPDATE attendance SET totalclasses = '$_POST[totclass]',
attendedclasses = '$attclass[$i],'percentage='$percent[$i]',comment='$comment[$i]' WHERE attid ='$_POST[attid]'");
	}
	
if(isset($_POST['button2']))
	{
    if(isset($_POST['totstdnt']))
  for($i=0;$i<=$_POST["totstdnt"];$i++)
  {
	  mysqli_query($con,"DELETE FROM attendance WHERE subid = '$_POST[subid]'");
     //echo "Item".$stuid[$i]."<br>\n";
	 $sql="INSERT INTO attendance (studid,subid,totalclasses,attendedclasses,percentage,comment)
VALUES
('$stuid[$i]','$_POST[subid]','$_POST[totclass]','$attclass[$i]','$percent[$i]','$comment[$i]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysql_error());
  }
	 
   }
	}
if(isset($_GET['slid']))
{
$rescourse1 = mysqli_query($con,"SELECT * FROM attendance where attid ='$_GET[slid]'");
while($rowED = mysqli_fetch_array($rescourse1))
  {
$attid = $rowED[attid];
$studid =$rowED[studid];
$subid = $rowED[subid];
$totalclasses = $rowED[totalclasses];
 $attendedclasses = $rowED[attendedclasses];
$percentage =  $rowED[percentage];
$comment = $rowED[comment];
  }	
  
}
if(isset($_POST['course']))
$rescourse = mysqli_query($con,"SELECT * FROM course where courseid='$_POST[course]'");
if(isset($rescourse))
while($row1 = mysqli_fetch_array($rescourse))
  {
	$courseid =   $row1["courseid"];
	$coursename =   $row1["coursename"];
  }
  if(isset($_POST['subject']))
  $resclass = mysqli_query($con,"SELECT * FROM subject where subid='$_POST[subject]'");
if(isset($resclass))
while($row2 = mysqli_fetch_array($resclass))
  {
	$subid =   $row2["subid"];
	$subname =   $row2["subname"];
  }
  
  if(isset($_POST['semester']) && isset($_POST['course']))  
    $restotst = mysqli_query($con,"SELECT * FROM studentdetails 
 where courseid='$_POST[course]' AND semester ='$_POST[semester]'");
  if(isset($restotst))
$tstudent = mysqli_num_rows($restotst);

 
 
if(isset($_GET['slid']))
{

  $restotstrec = mysqli_query($con,"SELECT * FROM studentdetails 
 where studid ='$studid'");


}
	else
	{
		 if(isset($_POST['semester']) && isset($_POST['course']))  
     $restotstrec = mysqli_query($con,"SELECT * FROM studentdetails 
 where courseid='$_POST[course]' AND semester ='$_POST[semester]'");
	
?>

<table width="964" border="1">
  <tr>
    <td>Course : <?php if(isset($coursename))echo $coursename; ?></td>
    <td>Total Classes: <?php if(isset($_POST["totalclass"]))echo $_POST["totalclass"]; ?></td>
  </tr>
  <tr>
    <td>Semester: <?php if(isset($_POST["semester"]))echo $_POST["semester"]; ?>'th Semester</td>
    <td>Total Students : <?php if(isset($tstudent))echo $tstudent; ?> </td>
  </tr>
  <tr>
    <td>Subject: <?php if(isset($subname))echo $subname; ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php

	}
	?>
<table width="963" border="1">
<form id="form1" name="form1" method="post" action="">
  <tr align="center">
    <td colspan="5" align="center">&nbsp;<?php 
	if(isset($_POST['button2']))
	{
	echo "<b>Record inserted Successfully...</b>"; 
	}
	?> </td>
    </tr>
  <tr align="center">
    <td width="159"><strong>Roll no</strong></td>
    <td width="262"><strong>Name</strong></td>
    <td width="116"><strong>Classes attended</strong></td>
    <td width="118"><strong>Percentage</strong></td>
    <td width="311"><strong>Comment</strong></td>
  </tr>
  <input name="subid" type="hidden" size="10" value="<?php echo $_POST[subject]; ?>"/>
  	<input name="subid" type="hidden" size="10" value="<?php echo $_POST[subject]; ?>"/>
    	
  
        <input name="attid" type="hidden" size="10" value="<?php echo $_GET[slid]; ?>"/>
 <?php
   if(isset($restotst))
 while($rowa = mysqli_fetch_array($restotstrec))
  {
  ?>
  <input name="stuid[]" type="hidden" size="10" value="<?php echo $rowa[studid]; ?>"/>
  <tr align="center">
    <td height="39" align="left">&nbsp;<?php echo $rowa['studid']; ?></td>
    <td align="left">&nbsp;
		<?php echo $rowa['studfname']. " ". $rowa['studlname'] ; ?></td>
    <td>
      <label for="textfield"></label>
      <input name="attclass[]" type="text" id="attclass[]" size="10" onchange="javascript:return submit_form();" value="<?php
      if(isset($_GET['slid']))
{
	echo $attendedclasses;
}
else
{
	echo "0";
}
?>"/>
</td>
    <td>
      <label for="textfield2"></label>
      <input name="percentage[]" type="text" id="percentage[]" size="10" readonly  value="<?php
      if(isset($_GET['slid']))
{
	echo $percentage;
}
else
{
	echo "0";
}
?>"/>
</td>
    <td>
      <label for="textarea"></label>
      <textarea name="comment[]" id="comment[]" cols="40" rows="1" ><?php
      if(isset($_GET['slid']))
{
	echo $comment;
}
else
{
	echo "0";
}
?></textarea>
</td>
  </tr>
  <?php
  }
  ?>
     
      <tr align="right">
    <td height="39" colspan="5">
    <?php
      if(isset($_GET['slid']))
{
	
	?> 
    <input name="totclass" type="hidden" size="10" value="<?php echo $totalclasses; ?>"/>
   <input type="submit" name="btnupdte" id="button2" value="Update Records"/>  
    <?php 
}
else
{
	?>
    <input name="totclass" type="hidden" size="10" value="<?php echo $_POST[totalclass]; ?>"/>
	  <input type="submit" name="button2" id="button2" value="Insert Records"/>  
      <?php
}
?>
      
       
      <input type="submit" name="reset" id="reset" value="Reset" /></td>
    </tr>
  
  </form>
</table>
<a href='attendanceview.php'><< Back </a>
<p>&nbsp;</p>