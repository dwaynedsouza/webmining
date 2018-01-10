<?php session_start();

$link=mysql_connect("localhost","jobscope","riddhi")or die("can not connect");
mysql_select_db("jobscope",$link) or die("can not select database");

$q="select * from jobs where j_active=1 order by j_id desc ";
$res=mysql_query($q,$link) or die ("can not select database");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
include("includes/head.inc.php");
?>
</head>
<body>
<div id="logo">
	<?php
	include("includes/logo.inc.php");
	?>
	</div>
<div id="header-wrapper">
	<div id="header">
	<div id="menu">
		<?php
		include("includes/menu.inc.php");
		?>
		</div>
		<!-- end #menu -->
		
		<!-- end #search -->
	</div>
</div>
<!-- end #header -->
<!-- end #header-wrapper -->

		<div id="search">
		<?php
		
		include("includes/search.inc.php");
		?>
		</div>


<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<hr />
			<!-- end #logo -->
			<div id="content">
				<div class="post">
					
					<h2 class="title"><center><b>YOUR ONLINE PORTAL</b></center></a></h2>
					
					<p class="meta"></p>
					<div class="entry">
						
					</div>
				</div>
			<div id="s_results">

<?php
$s_category=$_POST["s_category"];
$s_exp=$_POST["s_exp"];
$s_location=$_POST["s_location"];


if($s_category==''&& $s_exp==''&&  $s_location=='') 
{
echo " <b><center>You have not specified a search criteria</center>";
 

exit;
}
$con=mysqli_connect("localhost","jobscope","riddhi","jobscope");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


if($s_category<>'' && $s_exp<>''&& $s_location<>'')
{


$result = mysqli_query($con,"SELECT j_id,j_title,j_date,j_salary FROM jobs Where keywords LIKE '%$s_category%' AND j_experience=$s_exp AND j_city LIKE '%$s_location%'");
}
elseif($s_category<>'' && $s_exp<>''&& $s_location=='')
		$result = mysqli_query($con,"SELECT j_id,j_title,j_date,j_salary FROM jobs Where keywords LIKE '%$s_category%' AND j_experience=$s_exp ");

elseif($s_location<>'' && $s_exp<>'' && $s_category=='')	
		$result = mysqli_query($con,"SELECT j_id,j_title,j_date,j_salary FROM jobs Where j_city LIKE '%$s_location%' AND j_experience=$s_exp ");
	elseif($s_location<>'' && $s_category<>'' && $s_exp=='')
			$result = mysqli_query($con,"SELECT j_id,j_title,j_date,j_salary FROM jobs Where keywords LIKE '%$s_category%' AND j_city LIKE '%$s_location%'");
elseif($s_location<>'' && $s_category=='' && $s_exp=='')
			$result = mysqli_query($con,"SELECT j_id,j_title,j_date,j_salary FROM jobs Where  j_city LIKE'%$s_location%' ");
elseif($s_location=='' && $s_category<>'' && $s_exp=='')
			$result = mysqli_query($con,"SELECT j_id,j_title,j_date,j_salary FROM jobs Where keywords LIKE '%$s_category%' ");
elseif($s_location=='' && $s_category=='' && $s_exp<>'')
			$result = mysqli_query($con,"SELECT j_id,j_title,j_date,j_salary FROM jobs Where j_experience=$s_exp");
	

 
 


//echo $result;
//print_r($_REQUEST);
if (mysqli_num_rows($result) > 0)
{

echo "
<center>
<div class=CSSTableGenerator style=width:600px;height:150px>;
<table border=1 >
<center><h3>YOUR SEARCH RESULTS </h3></center>
<tr>
<td >           Job Id   </td>
<td >Job Title </td>
<td >Job Created </td>
<td >Job Salary</td>
<td >Know More </td>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
 
echo "<td >" . $row['j_id'] . "</td>";
echo "<td >" . $row['j_title'] . "</td>";
echo "<td >" . $row['j_date'] . "</td>";
echo "<td >" . $row['j_salary'] . "</td>";
echo '<td > <li><a href="job_details.php?id='.$row['j_id'].'">'.$row['j_title'].'</a></li> </td>';
  echo "</tr>";
  }
echo "</table></div></center> ";
}
else
	echo("Your Search Did not match any results.Try Again");

mysqli_close($con);
?>
			</div>
				
			</div>
			<!-- end #content -->
			<div id="sidebar">
			<?php
		include("includes/sidebar.inc.php");
		?>	
			</div>
			<!-- end #sidebar -->
			<div style="clear: both;">&nbsp;</div>
		</div>
	</div>
</div>
<!-- end #page -->
<div id="footer-bgcontent">
	<div id="footer">
		<?php
		include("includes/footer.inc.php");
		?>	
	</div>
</div>
<!-- end #footer -->
</body>
</html>
