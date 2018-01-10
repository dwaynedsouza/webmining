
<ul>
		<li><a href="index.php" class="first">Home</a></li>
<?php
if(!isset($_SESSION['employer']))
{
echo '<li><a href="browsejobs.php" >Browse Jobs</a></li>';
}
?>
	
		<?php
	
				if(!isset($_SESSION['employee']) && !isset($_SESSION['employer']))
				{
					echo '<li><a href="employeeregister.php">Employee Register</a></li>';
				}
	
		?>
		
				
		<?php
	
				if(!isset($_SESSION['employer'])&& !isset($_SESSION['employee']))
				{
					echo '<li><a href="employerregister.php">Employer Register</a></li>';
				}
	
		?>
			            
				<li><a href="contact.php">Contact</a></li>

				
		<?php
				if(isset($_SESSION['employer']))
				{
					echo '<li><a href="postjob.php">Postjob</a></li>';
				}
	
		?>	
		
		<?php

				if(isset($_SESSION['employee']))
				{
					echo '<li><a href="membwes.php"> Your Job Portal</a></li>';
				}
	
		?>		
	
<?php

				if(isset($_SESSION['employer']))
				{
					echo '<li><a href="manage.php">Managejob</a></li>';
				}
	
		?>

	

		
		<?php
	
				if(isset($_SESSION['status'])&& $_SESSION['unm']=='admin')
				{
					echo '<li><a href="admin/index.php">Admin</a></li>';
				}
	
		?>

		
		<?php
	
				if(isset($_SESSION['status']))
				{
					echo '<li><a href="process_logout.php">Logout</a></li>';
				}
	
				?>
</ul>
		