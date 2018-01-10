<?php session_start();
if(!isset($_SESSION['employee']))
				{
					header('Location: index.php');
    exit;
				}

$link=mysql_connect("localhost","jobscope","riddhi")or die("can not connect");
mysql_select_db("jobscope",$link) or die("can not select database");

$q="select * from jobs where j_active=1 order by j_id desc ";
$res=mysql_query($q,$link) or die ("can not select database");
$sempid=$_SESSION['eeid'];

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
					
					
					<div class="entry">
						
					</div>
				</div>
				<div class="rsearch"><h2> YOUR PAST SEARCHES:</h2>


					<?php
						$link=mysql_connect("localhost","jobscope","riddhi")or die("can not connect");
						mysql_select_db ("jobscope",$link) or die("can not select database");
						$q="SELECT j_id,j_title from jobs where j_id IN (Select j_id from searches where ee_id ='$sempid')";
						$res=mysql_query($q,$link) or die("cant connect");
						
						if (mysql_num_rows($res) > 0)
						{
							echo"<div class=CSSTableGenerator1 style=width:500px;height:30px>";
echo"<table border=1>";
						while($row=mysql_fetch_assoc($res))
						{
							
							echo '<tr > <td><li><a href="job_details.php?id='.$row['j_id'].'">'.$row['j_title'].'</a></li> </td></tr>';
						}
						echo"</table></div>";
						}
				
						else
							echo "<center><b>You do not have any passed search history</b></center>";
						
						mysql_close($link);
					?>






                </div>
<br><br><br><br><br><br>

<hr><br><br><br><br><br><br><br><br><br>
					<div class="rrecommend"><h2>RECOMMENDED JOBS FOR YOU</h2>
					<hr>
					<?php
						$link=mysql_connect("localhost","jobscope","riddhi")or die("can not connect");
						mysql_select_db ("jobscope",$link) or die("can not select database");
						
						
	/**************************************************************************************************************************************/					

						//No of unique employees
						$sql = "select COUNT(DISTINCT ee_id) as NOR from searches ";
						$sql1 = mysql_query($sql,$link) or die("cant connect");
						$data=mysql_fetch_assoc($sql1);
						$noofusers = $data['NOR'];
						
						
						//echo "No of users is $noofusers";
						
						$recom="";
						
						
	/**************************************************************************************************************************************/					
						//Jobs searched by  current user
						$q="SELECT distinct(j_id) from searches where  ee_id ='$sempid'";
						$res=mysql_query($q,$link) or die("cant connect");
						
						
						$userpages=array();   //Pages searched by user
						while($row=mysql_fetch_assoc($res))
						{
						$userpages[]=$row['j_id'];
						}
						//echo "Unique pages searched by user";
						//print_r($userpages);
						
						
						
	/************************************************************************************************************************************/					
						//Users from where to compare for recommendation
						$allusers = "SELECT DISTINCT(ee_id)  from searches  WHERE ee_id <>'$sempid'";
						$allusers1 = mysql_query($allusers,$link) or die("cant connect");
						
						 $distinctusers=array(); // All distinct users
						while($row=mysql_fetch_assoc($allusers1))
						{
						$distinctusers[]=$row['ee_id'];
						}
						
						//echo "Distinct users";
						//print_r($distinctusers);
						
						
						
						$largestratio=0;
			$temporary=array();
			
			
	/*************************************************************************************************************************************/		
			// Store other user's pages in temporary array
			for($i=0; $i<count($distinctusers); $i++)
			{
				
				$pages="SELECT distinct(j_id) from searches where  ee_id ='$distinctusers[$i]'";
				$pages1 = mysql_query($pages,$link) or die("cant connect");
				
				unset($temporary);
				while($row=mysql_fetch_assoc($pages1))
						{
						$temporary[]=$row['j_id'];
						}
						
			    $totusers =count($userpages); //No of pages user has searched
				
				$tempcount=count($temporary);   //No of pages of compared user
				$totalcount=$totusers+$tempcount;
				$common=array_intersect($userpages,$temporary); //Common pages 
				$noofcommon=count($common);//No of common users
				
				$ratio =$noofcommon/$totalcount;     //Compute common ratio . No of common pages/Total no of pages of both users
				
				if($largestratio< $ratio)    //Compare with all remaining users. 
				{
					$largestratio= $ratio;
					$recom=$distinctusers[$i];//Store user which has highest common ratio
			
				}
		/*
				echo "<br>Total users $totusers <br>";
				//var_dump($tempcount);
			echo "Temp count $tempcount<br>";
			echo "Total count $totalcount<br>";
			echo "Common pages <br>";
			print_r($common);
			echo "No of common $noofcommon<br>";
			echo "ratio is $ratio <br>";
			echo "Largest ratio $largestratio <br>";
			echo "Recommended user $recom <br>";
			*/
			
			
			}
			
	/***************************************************************************************************************************************/		
			//Store recommeneded user's pages not common with current user
			if ($recom<>'')
			
			{	
			$recomarray=array();
			$recpages="SELECT distinct(j_id) from searches where  ee_id ='$recom'";
				$recpages1 = mysql_query($recpages,$link) or die("cant connect");
				
				
				while($row=mysql_fetch_assoc($recpages1))
						{
						$recomarray[]=$row['j_id'];
						}
						
					$recomdiffpages =array_diff($recomarray,$userpages);
					
				
						
			     
				 $finalrecomdarray= array_filter($recomdiffpages);
				 $finalrecomdarray=array_slice($recomdiffpages,0);
				
				//print_r($finalrecomdarray) ;
				 
	/*************************************************************************************************************************************/			 
				 //Display recommended pages by recommended user
				 for($k=0; $k<count($finalrecomdarray);$k++)
				 {
					$disrecpages="SELECT j_id,j_title from jobs where  j_id ='$finalrecomdarray[$k]'";
					
				$disrecpages1 = mysql_query($disrecpages,$link) or die("cant connect");
				
				if (mysql_num_rows($disrecpages1) > 0)
				{
						
							echo"<div class=CSSTableGenerator1 style=width:500px;height:30px>";
							echo"<table border=1>";
				
								while($row=mysql_fetch_assoc($disrecpages1))
								{
									echo '<tr><td><li><a href="job_details.php?id='.$row['j_id'].'">'.$row['j_title'].'</a></li></td></tr>';
								}
							echo"</table></div>";
				}
				
				 }
				
			}	 
	/************************************************************************************************************************************/			 
			
	//Display message if searches not sufficient 		
				
else
echo"<center><b>You Need to peform a few searches to start getting Recommendations</b></center>";	
						
						
						mysql_close($link);
					?>
					
					
			</div>		
		
<hr>		
		<br><br><br><br><br>
		
					
<div class="rlike"><h2>SUGGESTED JOBS BASED ON YOUR PROFILE</h2>


<?php
						$link=mysql_connect("localhost","jobscope","riddhi")or die("can not connect");
						mysql_select_db ("jobscope",$link) or die("can not select database");
						$q="(SELECT ee_annualsalary,ee_current_location,ee_qualification from employees where ee_id ='$sempid')";
						$res=mysql_query($q,$link) or die("cant connect1");
						while($row=mysql_fetch_assoc($res))
						{
							
							//$eesal=$row['ee_annualsalary'];
							$eeloc=$row['ee_current_location'];
							$eequal=$row['ee_qualification'];
							
						}
						
							$q1="SELECT j_id,j_title from jobs where  j_city LIKE '%$eeloc%' AND j_qualifications LIKE '%$eequal%' ";
						$res1=mysql_query($q1,$link) or die("cant connect2");
							
							
							//echo $q1;
							
							
							if (mysql_num_rows($res1) > 0)
						{
							echo"<div class=CSSTableGenerator1 style=width:500px;height:30px>";
							echo"<table border=1>";
							
						while($row=mysql_fetch_assoc($res1))
						{
							echo '<tr><td><li><a href="job_details.php?id='.$row['j_id'].'">'.$row['j_title'].'</a></li></td></tr>';
						}
						echo"</table></div>";
						}
						else
							echo "<center><b>We could not find any matches.</b></center>";
						
						mysql_close($link);
					?>


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
