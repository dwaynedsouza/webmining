<?php session_start();


	
				if(!isset($_SESSION['employer']))
				{
					header('Location: index.php');
    exit;
				}
	
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Flowerily 
Description: A two-column, fixed-width design for 1024x768 screen resolutions.
Version    : 1.0
Released   : 20090906

-->

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

		

<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<hr />
			<!-- end #logo -->
			<div id="content">
				<div class="post">
					<?php
$date=date('y-m-d');
?>
					<h2 class="title">POST JOB</a></h2>
					<p class="meta">JOB SPECIFICATION</p>
					<div class="entry">
					<form action="process_postjob.php" method="post">
						TITLE<br> <input type="text" name="title" style="width:200px;" required >
						
						</SELECT>
								
							<br><BR> WORKING HOURS <BR> <INPUT TYPE = "TEXT"name="hours" style="width:200px;" required>
<br><br>
CATEGORY<br> <select id="cat" name="cat" style="width:200px;" required>
<?php
            
            $mysqlserver="localhost";
            $mysqlusername="jobscope";
            $mysqlpassword="riddhi";
            $link=mysql_connect(localhost, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
            
            $dbname = 'jobscope';
            mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
            
            $cdquery="SELECT cat_nm FROM categories";
            $cdresult=mysql_query($cdquery) or die ("Query to get data from Category failed: ".mysql_error());
echo"<option selected=true disabled=disabled>---Select Category---</option>";
            
            while ($cdrow=mysql_fetch_array($cdresult)) {
            $cdTitle=$cdrow["cat_nm"];
                echo "<option>
                    $cdTitle
                </option>";
            
            }
                
            ?>
    
        </select>

							<BR><BR> SALARY<BR><INPUT TYPE ="TEXT" name="salary" style="width:200px;" required>
							<BR><BR> EXPERIENCE <BR> <INPUT TYPE ="TEXT" name="experience" style="width:200px;" required>
							<BR><BR>DESCRIPTION<BR> <TEXTAREA name="disc" style="width:200px;"required></TEXTAREA >
							<BR><BR>CITY<BR><INPUT TYPE="TEXT" name="city" style="width:200px;"required>
							<BR><BR>QUALIFICATIONS<BR><INPUT TYPE="TEXT" name="qualify" style="width:200px;" required>
							<BR><BR>KEYWORDS<BR><INPUT TYPE="TEXT" name="keywords" style="width:200px;" required>
							<BR><BR>JOB DATE<BR><INPUT TYPE="text" value="<?php echo $date ?>" name="j_date" style="width:200px;" required>

							<center><br><br> <input type="submit" value="submit"></center>
					</form>

					</div>
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
