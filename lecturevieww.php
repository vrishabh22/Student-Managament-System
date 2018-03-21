<?php
session_start(); 
include("header.php"); 
include("conection.php");

$result = mysqli_query($con,"SELECT * FROM lectures
WHERE lecid='$_SESSION[userid]'");
 while($row1 = mysqli_fetch_array($result))
  {
    //if(isset(var))
	  $lecid = $row1['lecid'];
	$pass =	  $row1['password']; 	
	$couseid = 	  $row1['courseid']; 	
	$lecname =	  $row1['lecname']; 	
	$address = 	  $row1['address']; 	
	$contno =	  $row1['contactno'];
  }
  $result12 = mysqli_query($con,"SELECT * FROM course
WHERE courseid 	='$couseid'");
 while($row2 = mysqli_fetch_array($result12))
  {
	  $cbane =	  $row2['coursename'];
  }
?>
<section id="page">
<header id="pageheader" class="normalheader">
<h2 class="sitedescription">
</h2>
</header>

<section id="contents">

<article class="post">
  <header class="postheader">
  <h2>Lecture Profile</h2>
  </header>
  <section class="entry">
  <font size="3">
  <form action="" method="post" class="form">
   <table width="501" height="228" border="1">
     <tr>
       <td width="198" height="34"><strong>&nbsp; Lecture ID :</strong></td>
       <td width="287">&nbsp; <?php echo $lecid ;?></td>
     </tr>
     <tr>
       <td height="42"><strong>&nbsp;  Name :</strong></td>
       <td>&nbsp;<?php echo $lecname ;?></td>
     </tr>
     <tr>
       <td height="64"><strong>&nbsp; Address : </strong></td>
       <td>&nbsp; <?php echo $address ;?></td>
     </tr>
     <tr>
       <td height="39"><strong>&nbsp; Contact No. : </strong></td>
       <td>&nbsp; <?php echo $contno;?></td>
     </tr>
     <tr>
       <td height="35"><strong>&nbsp; Course :</strong></td>
       <td>&nbsp; <?php echo $cbane ;?></td>
     </tr>
   </table>
     </font>
   <p class="textfield">&nbsp;</p>
<div class="clear"></div>
</form>
  </section>
</article>

<article class="post">
  <header class="postheader"></header>
  <section class="entry">
    <form action="" method="post" class="form">
<div class="clear"></div>
</form>
<div class="clear"></div>
</section>
</article>



</section>


<?php 
if(isset($_SESSION["type"]) && $_SESSION["type"]=="admin")
	{
	include("adminmenu.php");
	}
	else
	{	
	include("lecturemenu.php");
	}

include("footer.php"); ?>