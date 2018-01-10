<?php session_start();

$pgid=$_GET['id'];

if(!isset($_SESSION['employee'])){ 
    header("Location: job_details.php?id=$pgid");
}
	$link=mysql_connect("localhost","jobscope","riddhi") or die("cant connect");
	mysql_select_db("jobscope",$link) or die("cant select db");
	
	$j_id=$_GET['id'];
$ee_id=$_SESSION['eeid'];

		
	$q = "select * from jobs where j_id =".$_GET['id'];
	
	$res = mysql_query($q,$link) or die("Wrong Query");
	
	$row = mysql_fetch_assoc($res);
	
	$rat="SELECT * FROM rating WHERE j_id ='$j_id' AND  ee_id ='$ee_id' ";
	$rat1 = mysql_query($rat,$link);
	if( mysql_num_rows($rat1) > 0) 
	{
		$row1 = mysql_fetch_assoc($rat1);
		
		
	}
	


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


<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function highlightStar(obj,id) {
	removeHighlight(id);		
	$('.demo-table li').each(function(index) {
		$(this).addClass('highlight');
		if(index == $('.demo-table li').index(obj)) {
			return false;	
		}
	});
}

function removeHighlight(id) {
	$('.demo-table li').removeClass('selected');
	$('.demo-table li').removeClass('highlight');
}

function addRating(obj,id) {
	$('.demo-table li').each(function(index) {
		$(this).addClass('selected');
		$('#rating').val((index+1));
		if(index == $('.demo-table li').index(obj)) {
			return false;	
		}
	});
	$.ajax({
	url: "add_rating.php",
	data:'id='+id+'&rating='+$('#rating').val(),
	type: "POST"
	});
}

function resetRating(id) {
	if($('#rating').val() != 0) {
		$('.demo-table  li').each(function(index) {
			$(this).addClass('selected');
			if((index+1) == $(' #rating').val()) {
				return false;	
			}
		});
	}
} </script>
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
				
				<p>
				
<?php
$link=mysql_connect("localhost","jobscope","riddhi") or die("cant connect");
	mysql_select_db("jobscope",$link) or die("cant select db");
	
	
	
						
	
	$itemID=$_GET['id'];
$userID=$_SESSION['eeid'];
	


function predict($userID, $itemID) {
    $link=mysql_connect("localhost","jobscope","riddhi") or die("cant connect");
	mysql_select_db("jobscope",$link) or die("cant select db");
	
	
   
    $denom = 0.0; //denominator
    $numer = 0.0; //numerator    
    $k = $itemID;    
    $sql = "SELECT r.j_id, r.rating 
    FROM rating r WHERE r.ee_id=$userID AND r.j_id <> $itemID";
    $db_result = mysql_query($sql, $link);        
    //for all items the user has rated
    while ($row = mysql_fetch_assoc($db_result))  {
        $j = $row["j_id"];
        $ratingValue = $row["rating"];        
        //get the number of times k and j have both been rated by the same user
        $sql2 = "SELECT d.count, d.sum FROM dev d WHERE itemID1=$k AND itemID2=$j";
        $count_result = mysql_query($sql2, $link);        
        //skip the calculation if it isn't found
        if(mysql_num_rows($count_result) > 0)  {
            $count = mysql_result($count_result, 0, "count");
            $sum = mysql_result($count_result, 0, "sum");            
            //calculate the average
            $average = $sum / $count;            
            //increment denominator by count
            $denom += $count;            
            //increment the numerator
            $numer += $count * ($average + $ratingValue);
        }        
    }    
    if ($denom == 0)
        return 0;
    else
        return ($numer / $denom);
}


$collab=predict($userID,$itemID);
/*
echo   $itemID;
echo  $collab;
*/
			
			if($collab>3)
				echo "<b><marquee><h2>You may find this job useful</h2></marquee></b>";



?>
</p>
</div>
				

					
					<h2 class="title"><center><?php echo $row['j_title']; ?></center></a></h2>
					<p class="meta"></p>
					
					
						<table width="100%" border="0" class=demo-table>
						
						<tr>
						<td valign="top">

							

						<?php
						
						echo '
								<tr><td><b>Salary:</b></td><td>'.$row['j_salary'].'</td></tr>
								<tr><td><b>Hours:</b></td><td>'.$row['j_hours'].'</td></tr>
								<tr><td><b>Experience:</b></td><td>'.$row['j_experience'].'</td></tr>
								<tr><td><b>City:</b></td><td>'.$row['j_city'].'</td></tr>
								<tr><td><b>Description:</b></td><td>'.$row['j_discription'].'</td></tr>		
								<tr><td><b>Qualifications:</b></td><td>'.$row['j_qualifications'].'</td></tr>
								<tr><td><b>Keywords:</b></td><td>'.$row['keywords'].'</td></tr>
								'; ?>
				
						<tr><td>	<b>Rate This Job</b></td><td><input type="hidden" name="rating" id="rating" value="<?php echo $row1["rating"]; ?>" />
<ul onMouseOut="resetRating(<?php echo $row["j_id"]; ?>);">
  <?php
  for($i=1;$i<=5;$i++) {
  $selected = "";
  if(!empty($row1["rating"]) && $i<=$row1["rating"]) {
	$selected = "selected";
  }
  ?>
  
  <li class='<?php echo $selected; ?>' onmouseover="highlightStar(this,<?php echo $row["j_id"]; ?>);" onmouseout="removeHighlight(<?php echo $row["j_id"]; ?>);" onClick="addRating(this,<?php echo $row["j_id"]; ?>);">&#9733;</li>  
  <?php }  ?>
</ul>
  </td></tr>
						
				
				

</td>
</tr>

<!--/tbody-->

		<?php
	
				if(isset($_SESSION['status']) && $_SESSION['cat']=="employee")
				{
					echo'<tr><td colspan="2"><center><a href="process_apply.php?jid='.$row['j_id'].'"> Apply </center></td></tr></a>';
				}
	
		?>
								
  	
						</table>
					
					
						
					
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
