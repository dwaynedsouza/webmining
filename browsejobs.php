<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<?php session_start();


	
$con=mysqli_connect("localhost","jobscope","riddhi","jobscope");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
  $rowsPerPage = 5;

// by default we show first page
$pageNum = 1;
// if $_GET['page'] defined, use it as page number
if(isset($_GET['page']))
{
    $pageNum = $_GET['page'];
}
// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

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
				<h2 class="title"><center><b>BROWSE JOBS</b></center></a></h2>
					
					
					<div class="entry">
						
					</div>
				</div>
<div id="b_jobs">
<?php
  $result = mysqli_query($con,"SELECT j_id,j_title,j_date,j_discription FROM jobs LIMIT $offset, $rowsPerPage ");

  while($row = mysqli_fetch_array($result))
  {
	 echo" <div class=demotable style=width:600px;height:150px; >
                <table >
                    <tr>";
             //  echo         "<td> Job Id:" . $row['j_id'] ."</td>";
                 echo       "<td colspan=2>" . $row['j_title'] ."</td>";
           echo         "</tr>";
                  echo"<tr>";
                       echo" <td colspan=2 > Description:". $row['j_discription'] ."</td>";
                        
                    echo"</tr>
                    <tr>";
                     echo"   <td >Job Created:" . $row['j_date'] . "</td>";
                      echo '<td > <li><a href="job_details.php?id='.$row['j_id'].'">Click here to know more</a></li> </td>';
                        
                  echo" </tr>";
                    
               echo" </table>";
           
            
		echo"</div>";
  }
  $query   = "SELECT COUNT(j_id) AS numrows FROM jobs";
$result  = mysqli_query($con,$query) or die('Error, query failed');
$row     = mysqli_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);
// print the link to access each page
$self = $_SERVER['PHP_SELF'];
/*$nav  = '';

for($page = 1; $page <= $maxPage; $page++)
{
   if ($page == $pageNum)
   {
      $nav .= " $page "; // no need to create a link to current page
   }
   else
   {
      $nav .= " <a href=\"$self?page=$page\">$page</a> ";
   } 
}
*/
  // creating previous and next link
// plus the link to go straight to
// the first and last page
if ($pageNum > 1)
{
   $page  = $pageNum - 1;
   $prev  = " <a href=\"$self?page=$page\">[Prev]</a> ";

   $first = " <a href=\"$self?page=1\">[First Page]</a> ";
} 
else
{
   $prev  = '&nbsp;'; // we're on page one, don't print previous link
   $first = '&nbsp;'; // nor the first page link
}
if ($pageNum < $maxPage)
{
   $page = $pageNum + 1;
   $next = " <a href=\"$self?page=$page\">[Next]</a> ";

   $last = " <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
} 
else
{
   $next = '&nbsp;'; // we're on the last page, don't print next link
   $last = '&nbsp;'; // nor the last page link
}
// print the navigation link
echo $first ."&nbsp;". $prev . "&nbsp;".
" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Showing page $pageNum of $maxPage pages &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " . $next . $last;
// and close the database connection
//include '../library/closedb.php';
// ... and we're done!

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