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
					
					<h2 class="title"><center><b>OUR TOP RECRUITERS</b></center></a></h2>
					
					
					<div class="entry">
						
					</div>
				</div>
			<div id="s_results">
			
			 <a href="http://www.tcs.com/Pages/default.aspx" target="_blank"> 
			 <img  src="tata.png" height="110" width="200" /></a>
			 <a href="http://careers.larsentoubro.com/Client/index.aspx" target="_blank"> 
			 <img  src="lnt.png" height="110" width="200" /></a> 
			 <a href="https://airtel.taleo.net/careersection/airtel_externalcareersection/default.ftl" target="_blank">
			 <img src="airtel.png" height="110" width="200"/></a> 
			 <a href="http://careers.adityabirla.com/jobs" target="_blank">
			 <img src="abg.png" height="110" width="200"/></a> 
			 <a href="https://www.allianz.com/en/careers" target="_blank">
			 <img src="allianz.png" height="110" width="200"/></a> 
			 <a href="https://jobopenings.infosys.com/" target="_blank">
			 <img src="infosys.png" height="110" width="200"/></a> 
			 <a href="https://www.amazon.jobs/" target="_blank">
			 <img src="amazon.png" height="110" width="200"/></a> 
			 <a href="http://www.ibm.com/in-en/" target="_blank">
			 <img src="ibm.png" height="110" width="200"/></a> 
			 <a href="https://www.accenture.com/in-en/careers.aspx" target="_blank">
			 <img src="accenture.png" height="110" width="200"/></a>  
			
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
