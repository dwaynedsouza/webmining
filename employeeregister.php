<?php session_start();
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
<script type="text/javascript">
function updateTextInput(val){
	document.getElementById('cas').value=val;
}
</script>
<?php
include("includes/head.inc.php");
?>
<script type="text/javascript" src="jquery-1.2.6.min.js"></script>
<SCRIPT type="text/javascript">
<!--

 
pic1 = new Image(16, 16);
pic1.src="loader.gif";
 
$(document).ready(function(){
 
$("#username").change(function() {
 
var usr = $("#username").val();
 
if(usr.length >= 6)
{
$("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking availability...');
 
    $.ajax({ 
    type: "POST", 
    url: "check.php", 
    data: "username="+ usr, 
    success: function(msg){ 
    
   $("#status").ajaxComplete(function(event, request, settings){
 
    if(msg == 'OK')
    {
        $("#username").removeClass('object_error'); // if necessary
        $("#username").addClass("object_ok");
        $(this).html('&nbsp;<img src="tick.gif" align="absmiddle">');
    } 
    else 
    { 
        $("#username").removeClass('object_ok'); // if necessary
        $("#username").addClass("object_error");
        $(this).html(msg);
    } 
    
   });
 
 }
    
  });
 
}
else
    {
    $("#status").html('<font color="red">' +
'The username should have at least <strong>4</strong> characters.</font>');
    $("#username").removeClass('object_ok'); // if necessary
    $("#username").addClass("object_error");
    }
 
});
 
});
 
//-->
 
</SCRIPT>
</head>
<body>
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

	</div>
<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<hr />
			<!-- end #logo -->
			<div id="content">
				<div class="post">
					
					<h2 class="title">REGISTER</a></h2>
					<p class="meta">Please fill up the form</p>
					<div class="entry">
						<form action="process_employee_register.php" method="post" enctype="multipart/form-data">
							 USER NAME <br> <input type="text" id="username" name="username" style="width:230px;"  required pattern="[a-zA-Z0-9]+" required oninvalid="this.setCustomValidity('UserName should include alphanumeric characters')" placeholder="eg:Ram12">
<div id="status"></div>
							 <br><br> FULL NAME <br> <input type="text" name="nm1" style="width:230px;"  required pattern="[a-zA-Z]+" required oninvalid="this.setCustomValidity('Name should only include alphabets')" placeholder="eg:Ram"/>
							<br><br> PASSWORD<br><input type="password" name="pwd" minlength=6 required>
							<BR><BR>GENDER <BR> <INPUT TYPE = "RADIO" VALUE="MALE" name="gender" required>MALE<INPUT TYPE = "RADIO" VALUE="female"name="gender" required >FEMALE
							<br><BR> EMAIL <BR> <INPUT TYPE = "email" name="email" style="width:200px;" required>
							<BR><BR> ADDRESS <BR> <TEXTAREA name="addr" style="width:200px;" required></TEXTAREA>
							<BR><BR> PHONE NO. <BR> <INPUT TYPE = "TEXT" name="ph" style="width:200px;" placeholder="Optional">
							<BR> <BR>MOBILE NO.<BR> <INPUT TYPE = "TEXT" name="mobile" style="width:200px;" required>
							<br><br>CURRENT LOCATION <BR><INPUT TYPE="TEXT" name="cl" style="width:200px;"required>
							<BR><BR>SALARY EXPECTING(PER ANNUM)<BR><INPUT TYPE="range" name="rangeInput"  min="50000" max="1000000" step="1000" onchange="updateTextInput(this.value);"/>
							<input type="text" name="cas" id="cas" value="" disabled>
							
							
							
							<BR><BR>QUALIFICATION<BR><INPUT TYPE = "TEXT" name="quali" style="width:200px;" required>
							<BR><BR>KEY SKILLS<BR> <TEXTAREA name="keywords" style="width:200px;"required> </TEXTAREA>
							<br><br>RESUME<br><input type="file" name="resume" style="width:200px;">
							<center><br><br> <input type="submit" value="Submit"></center>					
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
