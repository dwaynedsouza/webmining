<?php session_start();


$pgid=$_GET['id'];

if(isset($_SESSION['employee'])){ 
    header("Location: job_details1.php?id=$pgid");
}

	$link=mysql_connect("localhost","jobscope","riddhi") or die("cant connect");
	mysql_select_db("jobscope",$link) or die("cant select db");

		
	$q = "select * from jobs where j_id =".$_GET['id'];
	
	$res = mysql_query($q,$link) or die("Wrong Query");
	
	$row = mysql_fetch_assoc($res);


mysql_query("UPDATE jobs SET j_views=j_views+1  WHERE j_id =".$_GET['id']);

$j_id =$_GET['id'];
if(isset($_SESSION['eeid']))
{
	$sempid=$_SESSION['eeid']; 
 




echo mysql_query("INSERT INTO searches(j_id,ee_id) VALUES ('$j_id','$sempid')") or die(mysql_error());
}		
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
					
					<h2 class="title"><center><?php echo $row['j_title']; ?></center></a></h2>
					<p class="meta"></p>
					<div class="entry">
						<table width="100%" border="0">
							
						<?php
						
						echo '
								<tr><td><b>Salary:</b></td><td>'.$row['j_salary'].'</td></tr>
								<tr><td><b>Hours:</b></td><td>'.$row['j_hours'].'</td></tr>
								<tr><td><b>Experience:</b></td><td>'.$row['j_experience'].'</td></tr>
								<tr><td><b>City:</b></td><td>'.$row['j_city'].'</td></tr>
								<tr><td><b>Description:</b></td><td>'.$row['j_discription'].'</tr>		
								<tr><td><b>Qualifications:</b></td><td>'.$row['j_qualifications'].'</tr>
								<tr><td><b>Keywords:</b></td><td>'.$row['keywords'].'</tr>
								';
						
						?>
						<br>
						<br>
					
		<?php
	
				if(isset($_SESSION['status']) && $_SESSION['cat']=="employee")
				{
					echo'<tr><td colspan="2"><center><a href="process_apply.php?jid='.$row['j_id'].'"> Apply </center></td></tr></a>';
				}
	
		?>
								
							
					
						</table>
					
					
						
					</div>
				</div>
				
			</div>
			<!-- end #content -->
			<div id="sidebar">
			<?php
		include("includes/sidebar1.inc.php");
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
