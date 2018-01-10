<?php session_start();
	if(empty($_GET))
	{
		header("location:index.php");
	
	}
	$link=mysql_connect("localhost","jobscope","riddhi")or die("can not connect");
	mysql_select_db("jobscope",$link) or die("can not select database");
	$q="insert into applicants (a_uid,a_jid)values(".$_SESSION['eeid'].",".$_GET['jid'].")";

$result =mysql_query($q,$link);


if($result)
{
echo "Thankyou for Applying";

}
else
{
echo "Error. Please Try Again Later";

}

	header("location:thankapply.php");
	
?>