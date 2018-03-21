<?php
session_start();
include("header.php");
include("conection.php");
include("modal.php");
//$result="";
if(isset($_SESSION["userid"]))
{
	$result="";
	if(isset($_GET['first'])) 
	{
	}
	else
	{
		$_GET['first'] =0;
	$_GET['last'] = 10;
	}

	if(isset($_POST["button"]))
	{
		$resultac = mysqli_query($con,"SELECT * FROM examination");
	echo	isset($resultac)?mysqli_num_rows($resultac):"null";
	}
	else
	{
	$result = mysqli_query($con,"SELECT * FROM examination LIMIT $_GET[first] , $_GET[last]");
	}
$result1 = mysqli_query($con,"SELECT * FROM course LIMIT $_GET[first] , $_GET[last]");
$result2 = mysqli_query($con,"SELECT * FROM subject LIMIT $_GET[first] , $_GET[last]");
?>


<script>
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
	}
	
	function getCity(strURL) {		
		
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('subdiv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>

<section id="page">
<header id="pageheader" class="normalheader">
<h2 class="sitedescription">
 </h2>
</header>

<section id="contents">

<article class="post">
  <header class="postheader">
  <h2>Examination Details</h2>
  <p>&nbsp;</p>
   <?php include("selectcss.php"); ?>
  </header>
  <section class="entry">
     <p>
       <?php 
if(isset($resultac) && mysqli_num_rows($resultac) >= 1)
{
	?>
     </p>
     <table width="533" border="1">
       <tr>
    <td width="57">ExamID</td>
    <td width="66">StudentID</td>
    <td width="64">SubjectID</td>
    <td width="60">CourseID</td>
    <td width="54">Internal Type</td>
    <td width="63">Max Marks</td>
    <td width="56">Scored</td>
    <td width="61">Result</td>
    <td width="62"><strong>Action</strong></td>
  </tr>
      <?php
	 $i =$_GET['first']+1;
  while($row = mysqli_fetch_array($resultac))
  {
  echo "<tr>";
  echo "<td>&nbsp;"  . $i . "</td>";
    	  echo "<td>&nbsp;" . $row['studid'] . "</td>";
	   echo "<td>&nbsp;" . $row['subid'] . "</td>";
	   echo "<td>&nbsp;" . $row['courseid'] . "</td>";
	     echo "<td>&nbsp;" . $row['internaltype'] . "</td>";  
		 echo "<td>&nbsp;" . $row['maxmarks'] . "</td>";
		 echo "<td>&nbsp;" . $row['scored'] . "</td>";
		 echo "<td>&nbsp;" . $row['result'] . "</td>";
	   	  	   	   echo "<td>&nbsp;<a href='viewrecords.php?slid=$row[examid]&view=examination'><img  src='images/view.png' width='32' height='32' /></a> <a href='examupdate.php?exid=$row[examid]'> <img src='images/edit.png' width='32' height='32' /></a> . </td>";
  echo "</tr>&nbsp;";
  $i++;
  }
  $first=$_GET['first']-10;
$last= $_GET['last']- 10;
?>

 <tr>
          <td><?php 
	if($first <0)
	{ 
	} 
	else 
	{ ?><a href="examview.php?first=<?php echo $first; ?>&last=<?php echo $last; ?>">
    
    <?php 
	}
	?><img src="images/previous.png" alt="" width="32" height="32" /></td>
          <td><a href="exam.php" ><img src="images/add.png" alt="" width="32" height="32" /></a></td>
           <?php 
$first=$_GET['first']+10;
$last = $_GET['last']+ 10;
?>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><?php 
	if($first > mysqli_num_rows($result))
	{ 
	} 
	else 
	{ ?>
    <a href="examview.php?first=<?php echo $first; ?>&last=<?php echo $last; ?>">
    <?php
	}
	?><img src="images/next.png" alt="" width="32" height="32" /></td>
        </tr>
  
</table>
     <p>
       <?php
}
else
{
	echo "<h2>No Records Found...</h2>";
}
?>
     </p>
     <?php
     if(isset($_SESSION["type"]) && $_SESSION["type"]=="admin")
	{
		?>
     <p><a href="examview.php?first=<?php echo $first; ?>&amp;last=<?php echo $last; ?>"><a href="exam.php" ><strong>Add Examination Records</strong></a></p>
 <?php
	}
	?>
  </section>
</article>


</section>


<p>
  <?php 
}
else
{
		header("Location: admin.php");
}
if(isset($_SESSION["type"]) && $_SESSION["type"]=="admin")
	{
	include("adminmenu.php");
	}
	else
	{	
	include("lecturemenu.php");
	}

include("footer.php"); ?>
</p>
<p><a href="examview.php?first=<?php echo $first; ?>&amp;last=<?php echo $last; ?>"></a></p>
